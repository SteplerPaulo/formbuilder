<?php
class KeyHeadersController extends AppController {

	var $name = 'KeyHeaders';

	function index() {
		$this->KeyHeader->recursive = 0;
		$this->set('keyHeaders', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid key header', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('keyHeader', $this->KeyHeader->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->KeyHeader->create();
			if ($this->KeyHeader->save($this->data)) {
				$this->Session->setFlash(__('The key header has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The key header could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid key header', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->KeyHeader->save($this->data)) {
				$this->Session->setFlash(__('The key header has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The key header could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->KeyHeader->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for key header', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->KeyHeader->delete($id)) {
			$this->Session->setFlash(__('Key header deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Key header was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
