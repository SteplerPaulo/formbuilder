<?php
/* QuizDetail Test cases generated on: 2014-01-20 14:19:18 : 1390198758*/
App::import('Model', 'QuizDetail');

class QuizDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.quiz_detail', 'app.quiz', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option', 'app.key', 'app.key_header', 'app.evaluation', 'app.evaluation_detail');

	function startTest() {
		$this->QuizDetail =& ClassRegistry::init('QuizDetail');
	}

	function endTest() {
		unset($this->QuizDetail);
		ClassRegistry::flush();
	}

}
