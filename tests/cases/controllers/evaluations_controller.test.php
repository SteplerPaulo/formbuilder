<?php
/* Evaluations Test cases generated on: 2013-11-22 16:12:53 : 1385107973*/
App::import('Controller', 'Evaluations');

class TestEvaluationsController extends EvaluationsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EvaluationsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.evaluation', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option', 'app.evaluation_detail');

	function startTest() {
		$this->Evaluations =& new TestEvaluationsController();
		$this->Evaluations->constructClasses();
	}

	function endTest() {
		unset($this->Evaluations);
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
