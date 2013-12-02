<?php
class KeysController extends AppController {

	var $name = 'Keys';

	function index() {
		$this->Key->recursive = 0;
		$this->set('keys', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid key', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('key', $this->Key->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Key->create();
			if ($this->Key->save($this->data)) {
				$this->Session->setFlash(__('The key has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The key could not be saved. Please, try again.', true));
			}
		}
		$keyHeaders = $this->Key->KeyHeader->find('list');
		$this->set(compact('keyHeaders'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid key', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Key->save($this->data)) {
				$this->Session->setFlash(__('The key has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The key could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Key->read(null, $id);
		}
		$keyHeaders = $this->Key->KeyHeader->find('list');
		$this->set(compact('keyHeaders'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for key', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Key->delete($id)) {
			$this->Session->setFlash(__('Key deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Key was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
