<?php
/* EvaluationDetails Test cases generated on: 2013-11-22 16:12:39 : 1385107959*/
App::import('Controller', 'EvaluationDetails');

class TestEvaluationDetailsController extends EvaluationDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EvaluationDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.evaluation_detail', 'app.evaluation', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option');

	function startTest() {
		$this->EvaluationDetails =& new TestEvaluationDetailsController();
		$this->EvaluationDetails->constructClasses();
	}

	function endTest() {
		unset($this->EvaluationDetails);
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
