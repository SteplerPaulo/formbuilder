<?php
/* EvaluatorTypes Test cases generated on: 2014-10-08 07:22:46 : 1412745766*/
App::import('Controller', 'EvaluatorTypes');

class TestEvaluatorTypesController extends EvaluatorTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EvaluatorTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.evaluator_type');

	function startTest() {
		$this->EvaluatorTypes =& new TestEvaluatorTypesController();
		$this->EvaluatorTypes->constructClasses();
	}

	function endTest() {
		unset($this->EvaluatorTypes);
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
