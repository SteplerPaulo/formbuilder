<?php
/* Evaluatees Test cases generated on: 2014-10-08 05:24:46 : 1412738686*/
App::import('Controller', 'Evaluatees');

class TestEvaluateesController extends EvaluateesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EvaluateesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.evaluatee');

	function startTest() {
		$this->Evaluatees =& new TestEvaluateesController();
		$this->Evaluatees->constructClasses();
	}

	function endTest() {
		unset($this->Evaluatees);
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
