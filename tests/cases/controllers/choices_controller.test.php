<?php
/* Choices Test cases generated on: 2013-11-04 17:29:18 : 1383557358*/
App::import('Controller', 'Choices');

class TestChoicesController extends ChoicesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ChoicesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.choice', 'app.question', 'app.questioner', 'app.domain', 'app.question_choice');

	function startTest() {
		$this->Choices =& new TestChoicesController();
		$this->Choices->constructClasses();
	}

	function endTest() {
		unset($this->Choices);
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
