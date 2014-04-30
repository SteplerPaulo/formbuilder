<?php
class EvaluationDetailsController extends AppController {

	var $name = 'EvaluationDetails';
	var $helpers = array('Access');

	function index() {
		$this->EvaluationDetail->recursive = 0;
		$this->set('evaluationDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid evaluation detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('evaluationDetail', $this->EvaluationDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EvaluationDetail->create();
			if ($this->EvaluationDetail->save($this->data)) {
				$this->Session->setFlash(__('The evaluation detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluation detail could not be saved. Please, try again.', true));
			}
		}
		$evaluations = $this->EvaluationDetail->Evaluation->find('list');
		$questions = $this->EvaluationDetail->Question->find('list');
		$options = $this->EvaluationDetail->Option->find('list');
		$this->set(compact('evaluations', 'questions', 'options'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid evaluation detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EvaluationDetail->save($this->data)) {
				$this->Session->setFlash(__('The evaluation detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluation detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EvaluationDetail->read(null, $id);
		}
		$evaluations = $this->EvaluationDetail->Evaluation->find('list');
		$questions = $this->EvaluationDetail->Question->find('list');
		$options = $this->EvaluationDetail->Option->find('list');
		$this->set(compact('evaluations', 'questions', 'options'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for evaluation detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EvaluationDetail->delete($id)) {
			$this->Session->setFlash(__('Evaluation detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Evaluation detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
