<?php
/* Questions Test cases generated on: 2013-11-04 17:19:09 : 1383556749*/
App::import('Controller', 'Questions');

class TestQuestionsController extends QuestionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class QuestionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.question', 'app.questioner', 'app.domain', 'app.question_choice');

	function startTest() {
		$this->Questions =& new TestQuestionsController();
		$this->Questions->constructClasses();
	}

	function endTest() {
		unset($this->Questions);
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
