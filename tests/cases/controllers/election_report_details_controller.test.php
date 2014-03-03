<?php
/* ElectionReportDetails Test cases generated on: 2014-01-22 09:45:34 : 1390355134*/
App::import('Controller', 'ElectionReportDetails');

class TestElectionReportDetailsController extends ElectionReportDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ElectionReportDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.election_report_detail', 'app.election_report', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option');

	function startTest() {
		$this->ElectionReportDetails =& new TestElectionReportDetailsController();
		$this->ElectionReportDetails->constructClasses();
	}

	function endTest() {
		unset($this->ElectionReportDetails);
		ClassRegistry::flush();
	}

}
