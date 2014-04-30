<?php
class QuizDetailsController extends AppController {

	var $name = 'QuizDetails';
	var $helpers = array('Access');

	function index() {
		$this->QuizDetail->recursive = 0;
		$this->set('quizDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid quiz detail', true), array('action' => 'index'));
		}
		$this->set('quizDetail', $this->QuizDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->QuizDetail->create();
			if ($this->QuizDetail->save($this->data)) {
				$this->flash(__('Quizdetail saved.', true), array('action' => 'index'));
			} else {
			}
		}
		$evaluations = $this->QuizDetail->Evaluation->find('list');
		$questions = $this->QuizDetail->Question->find('list');
		$options = $this->QuizDetail->Option->find('list');
		$this->set(compact('evaluations', 'questions', 'options'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid quiz detail', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->QuizDetail->save($this->data)) {
				$this->flash(__('The quiz detail has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->QuizDetail->read(null, $id);
		}
		$evaluations = $this->QuizDetail->Evaluation->find('list');
		$questions = $this->QuizDetail->Question->find('list');
		$options = $this->QuizDetail->Option->find('list');
		$this->set(compact('evaluations', 'questions', 'options'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid quiz detail', true)), array('action' => 'index'));
		}
		if ($this->QuizDetail->delete($id)) {
			$this->flash(__('Quiz detail deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Quiz detail was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
