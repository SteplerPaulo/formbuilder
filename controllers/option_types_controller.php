<?php
class OptionTypesController extends AppController {

	var $name = 'OptionTypes';

	function index() {
		$this->OptionType->recursive = 0;
		$this->set('optionTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid option type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('optionType', $this->OptionType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->OptionType->create();
			if ($this->OptionType->save($this->data)) {
				$this->Session->setFlash(__('The option type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The option type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid option type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OptionType->save($this->data)) {
				$this->Session->setFlash(__('The option type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The option type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OptionType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for option type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OptionType->delete($id)) {
			$this->Session->setFlash(__('Option type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Option type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
