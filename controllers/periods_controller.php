<?php
class PeriodsController extends AppController {

	var $name = 'Periods';

	function index() {
		$this->Period->recursive = 0;
		$this->set('periods', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid period', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('period', $this->Period->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Period->create();
			if ($this->Period->save($this->data)) {
				$this->Session->setFlash(__('The period has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The period could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid period', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Period->save($this->data)) {
				$this->Session->setFlash(__('The period has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The period could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Period->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for period', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Period->delete($id)) {
			$this->Session->setFlash(__('Period deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Period was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
