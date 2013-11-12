<?php
class OptionsController extends AppController {

	var $name = 'Options';

	function index() {
		$this->Option->recursive = 0;
		$this->set('options', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid option', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('option', $this->Option->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Option->create();
			if ($this->Option->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Option has been saved.";
					$response['data'] = $this->data;
					$response['data']['Option']['id'] = $this->Option->id;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('Option has been saved', true));
					$this->redirect(array('action' => 'index'));
				}
				$this->redirect(array('action' => '../options/add'));
				
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Option could not be saved. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
					$this->Session->setFlash(__('Option could not be saved. Please, try again.', true));
				}
			}
		}else{
			$this->redirect(array('action' => 'index'));
		}
	

		$questions = $this->Option->Question->find('list',array('fields'=>array('Question.id','Question.content')));
		$this->set(compact('questions'));
	}
	
	function create(){
		if(isset($this->data['Question']['id'])){
			$question = $this->Option->Question->find('first',array(
									'conditions'=>array(
										'Question.id'=>$this->data['Question']['id']),
									'fields'=>array(
										'Question.id','Question.text'
										)
									));
						
			$question_list = $this->Option->Question->find('list',array(
									'conditions'=>array(
										'Question.id'=>$this->data['Question']['id']),
									'fields'=>array(
										'Question.id','Question.text'
										)
									));
		}
		$this->set(compact('question','question_list'));
	}

	function edit() {
		$id = $this->data['Form']['object_id'];
		$form_id = $this->data['Form']['id'];
	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid option', true));
			$this->redirect(array('action' => '../forms'));
		}
		
		if (!empty($this->data)) {
			if ($this->Option->save($this->data)) {
				$this->Session->setFlash(__('The option has been saved', true));
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The option could not be saved. Please, try again.', true));
			}
		}
		
		$this->data = $this->Option->read(null, $id);
		$questions = $this->Option->Question->find('list');
		$this->set(compact('questions','id','form_id'));
	}

	function delete() {
		$id = $this->data['Form']['object_id'];
		
		if(isset($id)) {
			if ($this->Option->delete($id)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Option deleted.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}else{
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Option could not be deleted. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}
		}else{
			$this->redirect(array('action'=>'../forms'));
		}
	}
}
