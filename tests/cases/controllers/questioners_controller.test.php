<?php
/* Questioners Test cases generated on: 2013-11-04 17:29:43 : 1383557383*/
App::import('Controller', 'Questioners');

class TestQuestionersController extends QuestionersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class QuestionersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.questioner', 'app.question', 'app.domain', 'app.question_choice');

	function startTest() {
		$this->Questioners =& new TestQuestionersController();
		$this->Questioners->constructClasses();
	}

	function endTest() {
		unset($this->Questioners);
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
