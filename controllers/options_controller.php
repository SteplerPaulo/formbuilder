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
		//pr($this->data);exit;
	
		if (!empty($this->data)) {
			$this->Option->create();
			if ($this->Option->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/lib/img/icons/tick.png" />&nbsp;Option has been saved.';
					$response['data'] = $this->data;
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
					$response['msg'] = "<img src='/lib/img/icons/exclamation.png'/>&nbsp; Option could not be saved. Please, try again.";
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
		$question_id = 103;//$this->data['Question']['id'];
		$question = $this->Option->Question->find('first',array('conditions'=>array('Question.id'=>$question_id)));
		
		//pr($question);exit;
		$this->set(compact('question'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid option', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Option->save($this->data)) {
				$this->Session->setFlash(__('The option has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The option could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Option->read(null, $id);
		}
		$questions = $this->Option->Question->find('list');
		$this->set(compact('questions'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for option', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Option->delete($id)) {
			$this->Session->setFlash(__('Option deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Option was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
