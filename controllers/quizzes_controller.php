<?php
class QuizzesController extends AppController {

	var $name = 'Quizzes';
	var $uses = array('Quiz','Form');

	function index() {
		if ($this->Rest->isActive()) {	
			$curr_data = $this->api($_GET);
			$this->set('data',$curr_data);
		}
		else if($this->RequestHandler->isAjax()){	
			$data = $this->Quiz->find('all');
			echo json_encode($data);
			exit;
		}else{
			$this->Quiz->recursive = 0;
			$this->set('quizzes', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid quiz', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('quiz', $this->Quiz->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			foreach($this->data['QuizDetail'] as $key => $detail){
				if($detail['option_type']=='checkbox' || $detail['option_type']=='radio'){
					if(!isset($detail['option_id'])){
							unset($this->data['QuizDetail'][$key]);
					}
				}else{
					if(empty($detail['answer'])){
						$this->data['QuizDetail'][$key]['answer']='No Answer';
					}
				}
			}

			$this->Quiz->create();
			$this->data['Key']['status'] = '1';
			if ($this->Quiz->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Form successfully submitted.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign'/></i></a> Form could not be submitted. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid quiz', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Quiz->save($this->data)) {
				$this->Session->setFlash(__('The quiz has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quiz could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Quiz->read(null, $id);
		}
		$forms = $this->Quiz->Form->find('list');
		$keys = $this->Quiz->Key->find('list');
		$this->set(compact('forms', 'keys'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for quiz', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Quiz->delete($id)) {
			$this->Session->setFlash(__('Quiz deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Quiz was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function form(){
		if (isset($this->data['Form']['id'])) {
			$form_id = $this->data['Form']['id'];
			
			$this->Form->recursive = 3;
			$form = $this->Form->read(null, $form_id);

			foreach($form['FormDomain'] as $domain){
				foreach($form['Question'] as $question){
					if($domain['domain_id'] == $question['domain_id']){
						$form['DomainQuestion'][$question['Domain']['name']][$question['text']] = $question;
					}
				}
			}
		
			$key = $this->data['Form']['object_id'];
			$this->set(compact('form','key'));
		}else{
			$this->redirect(array('action'=>'../forms/login'));
		}
	}
	
	function result(){
		if(isset($this->data['Quiz']['form_id']) && isset($this->data['Quiz']['examinee'])) {
			$form_id = $this->data['Quiz']['form_id'];
			$examinee = $this->data['Quiz']['examinee'];

			$result = $this->Quiz->find('first',array('recursive'=>3,'conditions'=>array('Quiz.form_id'=>$form_id,'Quiz.examinee'=>$examinee )));

			
			$this->set(compact('result'));
		}else{
			$this->redirect(array('action'=>'index'));
		}
	}
	
	protected function api($params){
		$schema = $this->Quiz->schema();
		$conditions = array();
		$fields = array();
		$group = array('Quiz.form_id','Quiz.examinee');
		$type = 'all';
		$page = 1;
		$limit = $this->Rest->limit;
		foreach($params as $key => $val){
			switch($key){
				case 'fields':
					foreach(explode(',',$val) as $f){
						if(isset($schema[$f])){
							array_push($fields,'Quiz.'.$f);
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
						$conditions['Quiz.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->Quiz->recursive = 1;
		$config =  array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id');
		$data = $this->Quiz->find($type,$config);
		$data['count']=count($data);
		return $data;
	}
	
}
