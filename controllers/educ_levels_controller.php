<?php
class EducLevelsController extends AppController {

	var $name = 'EducLevels';

	function index() {
		$this->EducLevel->recursive = 0;
		$this->set('educLevels', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid educ level', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('educLevel', $this->EducLevel->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EducLevel->create();
			if ($this->EducLevel->save($this->data)) {
				$this->Session->setFlash(__('The educ level has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The educ level could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid educ level', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EducLevel->save($this->data)) {
				$this->Session->setFlash(__('The educ level has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The educ level could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EducLevel->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for educ level', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EducLevel->delete($id)) {
			$this->Session->setFlash(__('Educ level deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Educ level was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
