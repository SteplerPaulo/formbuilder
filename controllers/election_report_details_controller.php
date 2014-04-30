<?php
class ElectionReportDetailsController extends AppController {

	var $name = 'ElectionReportDetails';
	var $helpers = array('Access')

	function index() {
		$this->ElectionReportDetail->recursive = 0;
		$this->set('electionReportDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid election report detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('electionReportDetail', $this->ElectionReportDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ElectionReportDetail->create();
			if ($this->ElectionReportDetail->save($this->data)) {
				$this->Session->setFlash(__('The election report detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The election report detail could not be saved. Please, try again.', true));
			}
		}
		$electionReports = $this->ElectionReportDetail->ElectionReport->find('list');
		$questions = $this->ElectionReportDetail->Question->find('list');
		$options = $this->ElectionReportDetail->Option->find('list');
		$this->set(compact('electionReports', 'questions', 'options'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid election report detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ElectionReportDetail->save($this->data)) {
				$this->Session->setFlash(__('The election report detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The election report detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ElectionReportDetail->read(null, $id);
		}
		$electionReports = $this->ElectionReportDetail->ElectionReport->find('list');
		$questions = $this->ElectionReportDetail->Question->find('list');
		$options = $this->ElectionReportDetail->Option->find('list');
		$this->set(compact('electionReports', 'questions', 'options'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for election report detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ElectionReportDetail->delete($id)) {
			$this->Session->setFlash(__('Election report detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Election report detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
