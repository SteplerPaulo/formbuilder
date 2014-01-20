<?php
/* QuizDetails Test cases generated on: 2014-01-08 11:20:42 : 1389151242*/
App::import('Controller', 'QuizDetails');

class TestQuizDetailsController extends QuizDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class QuizDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.quiz_detail', 'app.evaluation', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option', 'app.key', 'app.key_header', 'app.evaluation_detail');

	function startTest() {
		$this->QuizDetails =& new TestQuizDetailsController();
		$this->QuizDetails->constructClasses();
	}

	function endTest() {
		unset($this->QuizDetails);
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
