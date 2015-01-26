<?php
class SchoolYearsController extends AppController {

	var $name = 'SchoolYears';

	function index() {
		$this->SchoolYear->recursive = 0;
		$this->set('schoolYears', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid school year', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('schoolYear', $this->SchoolYear->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SchoolYear->create();
			if ($this->SchoolYear->save($this->data)) {
				$this->Session->setFlash(__('The school year has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school year could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid school year', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SchoolYear->save($this->data)) {
				$this->Session->setFlash(__('The school year has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school year could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SchoolYear->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for school year', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SchoolYear->delete($id)) {
			$this->Session->setFlash(__('School year deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('School year was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
