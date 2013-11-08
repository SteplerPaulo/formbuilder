<?php
class FormTypesController extends AppController {

	var $name = 'FormTypes';

	function index() {
		$this->FormType->recursive = 0;
		$this->set('formTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid form type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('formType', $this->FormType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FormType->create();
			if ($this->FormType->save($this->data)) {
				$this->Session->setFlash(__('The form type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid form type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FormType->save($this->data)) {
				$this->Session->setFlash(__('The form type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FormType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for form type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FormType->delete($id)) {
			$this->Session->setFlash(__('Form type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Form type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
