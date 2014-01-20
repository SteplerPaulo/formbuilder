<?php
/* Quiz Test cases generated on: 2014-01-20 14:19:09 : 1390198749*/
App::import('Model', 'Quiz');

class QuizTestCase extends CakeTestCase {
	var $fixtures = array('app.quiz', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option', 'app.key', 'app.key_header', 'app.evaluation', 'app.evaluation_detail', 'app.quiz_detail');

	function startTest() {
		$this->Quiz =& ClassRegistry::init('Quiz');
	}

	function endTest() {
		unset($this->Quiz);
		ClassRegistry::flush();
	}

}
