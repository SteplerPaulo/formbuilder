<?php
/* QuestionOption Test cases generated on: 2013-11-06 13:01:27 : 1383714087*/
App::import('Model', 'QuestionOption');

class QuestionOptionTestCase extends CakeTestCase {
	var $fixtures = array('app.question_option', 'app.question', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.option');

	function startTest() {
		$this->QuestionOption =& ClassRegistry::init('QuestionOption');
	}

	function endTest() {
		unset($this->QuestionOption);
		ClassRegistry::flush();
	}

}
