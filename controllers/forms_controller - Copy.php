<?php
class FormsController extends AppController {

	var $name = 'Forms';
	var $uses = array('Form','Question');

	function index() {
		if ($this->Rest->isActive()) {	
			$data = $this->api($_GET);
			foreach($data as $key=>$val){
				$data[$key]['QuestionCount']['count'] = count($val['Question']);	
			}
			$this->set('data',$data);
		}
		else if($this->RequestHandler->isAjax()){	
			$data = $this->Form->find('all');
			
			foreach($data as $key=>$val){
				$data[$key]['QuestionCount']['count'] = count($val['Question']);
			}

			echo json_encode($data);
			exit;
		}else{
			$this->Form->recursive = 0;
			$this->set('forms', $this->paginate());
		}
	}

	function view() {
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
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function workplace() {
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
			$this->redirect(array('action'=>'create'));
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->Form->create();
			if ($this->Form->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Form has been saved.";
					$response['data'] = $this->data;
					$response['data']['Form']['id'] = $this->Form->id;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('Form has been saved', true));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Form could not be saved. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
					$this->Session->setFlash(__('Form could not be saved. Please, try again.', true));
				}
			}
		}else{
			$this->redirect(array('action' => 'create'));
		}
	}
	
	function create(){
		$formTypes = $this->Form->FormType->find('list');
		$this->set(compact('formTypes'));
	}
	
	function edit() {
		$id = $this->data['Form']['object_id'];
		$form_id = $this->data['Form']['id'];
	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid form', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Form->save($this->data)) {
				$this->Session->setFlash(__('The form has been saved', true));
			} else {
				$this->Session->setFlash(__('The form could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Form->read(null, $id);
		}
		$form = $this->Form->read(null, $form_id);
		$formTypes = $this->Form->FormType->find('list');
		$this->set(compact('formTypes','form','form_id','id'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for form', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Form->delete($id)) {
			$this->Session->setFlash(__('Form deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Form was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	protected function api($params){
		$schema = $this->Form->schema();
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
							array_push($fields,'Form.'.$f);
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
						$conditions['Form.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->Form->recursive = 1;
		return $this->Form->find($type,array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id'));
	}
	
}
