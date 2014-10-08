<?php
class FormsController extends AppController {

	var $name = 'Forms';
	var $helpers = array('Access');
	var $uses = array('Form','Question','Key');

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
	
	function sortable_worksheet() {
		if (!empty($this->data['Form']['id'])) {
			$form_id = $this->data['Form']['id'];
			$this->Form->recursive = 3;
			$data = $this->Form->read(null, $form_id);
			if(isset($data['FormDomain'])){
				foreach($data['FormDomain'] as $domain){
					foreach($data['Question'] as $question){
						if($domain['domain_id'] == $question['domain_id']){
							$data['DomainQuestion'][$question['Domain']['name']][$question['text']] = $question;
						}
					}
				}
			}
			$this->set('form', $data);
		}else{
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function worksheet() {
		if (!empty($this->data['Form']['id'])) {
			$form_id = $this->data['Form']['id'];
			$this->Form->recursive = 3;

			$data = $this->Form->read(null, $form_id);
			
			//pr($data);exit;
			
			unset($data['FormType']['Form']);
			
			if(isset($data['FormDomain'])){
				foreach($data['FormDomain'] as $domain){
					foreach($data['Question'] as $question){
						if($domain['domain_id'] == $question['domain_id']){
							$data['DomainQuestion'][$question['Domain']['name']][$question['text']] = $question;
						}
					}
				}
			}		

			$this->set('form', $data);
		}else{
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function create(){
		$formTypes = $this->Form->FormType->find('list');
		$this->set(compact('formTypes'));
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
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Form could not be saved. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}
		}else{
			$this->redirect(array('action' => 'create'));
		}
	}

	function edit() {
		$id = $this->data['Form']['object_id'];
		$form_id = $this->data['Form']['id'];

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid form', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data['Form']['title'])) {
			if ($this->Form->save($this->data)) {
				$this->Session->setFlash(__('The form has been saved', true));
			} else {
				$this->Session->setFlash(__('The form could not be saved. Please, try again.', true));
			}
		}
		
		$this->data = $this->Form->read(null, $form_id);
		$form_types = $this->Form->FormType->find('list',array('fields'=>array('FormType.id','FormType.name')));
		$this->set(compact('form_types','form_id','id'));
	}

	function delete() {
		if(isset($this->data['Form']['object_id'])) {
		
			$id = $this->data['Form']['object_id'];
			if ($this->Form->delete($id,true)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Form deleted.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}else{
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Form not deleted. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}
		}else{
			$this->redirect(array('action'=>'../forms'));
		}
	}
	
	function login() {
		if ($this->RequestHandler->isAjax()) {
			$key_value = $this->data['Form']['key'];
			
			$result = $this->Key->find('first',array('recursive'=>2,'conditions'=>array('Key.value'=>$key_value)));
		
			$startTime =  date('h:i A');
			echo json_encode(array('data'=>$result,'StartTime'=>$startTime));
			exit;
		}
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
