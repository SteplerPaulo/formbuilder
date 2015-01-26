<?php
/* Periods Test cases generated on: 2015-01-26 05:33:49 : 1422246829*/
App::import('Controller', 'Periods');

class TestPeriodsController extends PeriodsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PeriodsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.period');

	function startTest() {
		$this->Periods =& new TestPeriodsController();
		$this->Periods->constructClasses();
	}

	function endTest() {
		unset($this->Periods);
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
