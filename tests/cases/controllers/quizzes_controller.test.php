<?php
/* Quizzes Test cases generated on: 2014-01-08 11:18:58 : 1389151138*/
App::import('Controller', 'Quizzes');

class TestQuizzesController extends QuizzesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class QuizzesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.quiz', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option', 'app.key', 'app.key_header', 'app.evaluation', 'app.evaluation_detail');

	function startTest() {
		$this->Quizzes =& new TestQuizzesController();
		$this->Quizzes->constructClasses();
	}

	function endTest() {
		unset($this->Quizzes);
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
