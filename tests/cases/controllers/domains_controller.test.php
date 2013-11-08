<?php
/* Domains Test cases generated on: 2013-11-04 17:29:30 : 1383557370*/
App::import('Controller', 'Domains');

class TestDomainsController extends DomainsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DomainsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.domain', 'app.question', 'app.questioner', 'app.question_choice');

	function startTest() {
		$this->Domains =& new TestDomainsController();
		$this->Domains->constructClasses();
	}

	function endTest() {
		unset($this->Domains);
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
