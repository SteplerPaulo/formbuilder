<?php
class EvaluationsController extends AppController {

	var $name = 'Evaluations';
	var $uses = array('Evaluation','Key','Form');

	function index() {
		if ($this->Rest->isActive()) {	
			$curr_data = $this->api($_GET);
			$this->set('data',$curr_data);
		}
		else if($this->RequestHandler->isAjax()){	
			$data = $this->Evaluation->find('all');
			echo json_encode($data);
			exit;
		}else{
			$this->Evaluation->recursive = 0;
			$this->set('evaluations', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid evaluation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('evaluation', $this->Evaluation->read(null, $id));
	}

	function add() {
		
		foreach($this->data['EvaluationDetail'] as $key => $detail){
			if($detail['option_type']=='checkbox' || $detail['option_type']=='radio'){
				if(!isset($detail['option_id'])){
						unset($this->data['EvaluationDetail'][$key]);
				}
			}else{
				if(empty($detail['answer'])){
					$this->data['EvaluationDetail'][$key]['answer']='No Answer';
					$this->data['EvaluationDetail'][$key]['option_id']='0';
				}
			}
		}

		if (!empty($this->data)) {
			$this->Evaluation->create();
			if ($this->Evaluation->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Evaluation has been saved.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Evaluation could not be saved. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid evaluation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Evaluation->save($this->data)) {
				$this->Session->setFlash(__('The evaluation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Evaluation->read(null, $id);
		}
		$forms = $this->Evaluation->Form->find('list');
		$this->set(compact('forms'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for evaluation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Evaluation->delete($id)) {
			$this->Session->setFlash(__('Evaluation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Evaluation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function login() {
		if ($this->RequestHandler->isAjax()) {
			$key_value = $this->data['Evaluation']['key'];
			
			$result = $this->Key->find('first',array('conditions'=>array('Key.value'=>$key_value)));
			
			$startTime =  date('h:i A');
			echo json_encode(array('data'=>$result,'StartTime'=>$startTime));
			exit;
		}
	}
	
	function form(){
		if (isset($this->data['Form']['id'])) {
			$form_id = $this->data['Form']['id'];
			
			$this->Form->recursive = 3;
			$data = $this->Form->read(null, $form_id);

			foreach($data['FormDomain'] as $domain){
				foreach($data['Question'] as $question){
					if($domain['domain_id'] == $question['domain_id']){
						$data['DomainQuestion'][$question['Domain']['name']][$question['text']] = $question;
					}
				}
			}
		
			$this->set('form', $data);
		}else{
			$this->redirect(array('action'=>'login'));
		}
	}
	
	protected function api($params){
		$schema = $this->Evaluation->schema();
		$conditions = array();
		$fields = array();
		$group = array();
		$type = 'all';
		$page = 1;
		$limit = $this->Rest->limit;
		foreach($params as $key => $val){
			switch($key){
				case 'fields':
					foreach(explode(',',$val) as $f){
						if(isset($schema[$f])){
							array_push($fields,'Evaluation.'.$f);
						}else{
							return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid field '.$f.' supplied'));
						}
					}
				break;
				
				case 'page':
					$page = $val;
				break;
				case 'limit':
					$limit = $val;
				break;
				default:
					if(isset($schema[$key])){
						$conditions['Evaluation.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->Evaluation->recursive = 1;
		return $this->Evaluation->find($type,array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id'));
	}
}

