<?php
/* ElectionReports Test cases generated on: 2014-01-22 10:13:53 : 1390356833*/
App::import('Controller', 'ElectionReports');

class TestElectionReportsController extends ElectionReportsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ElectionReportsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.election_report', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option', 'app.election_report_detail');

	function startTest() {
		$this->ElectionReports =& new TestElectionReportsController();
		$this->ElectionReports->constructClasses();
	}

	function endTest() {
		unset($this->ElectionReports);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
