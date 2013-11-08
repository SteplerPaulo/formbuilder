<?php
/* Question Test cases generated on: 2013-11-08 10:33:09 : 1383877989*/
App::import('Model', 'Question');

class QuestionTestCase extends CakeTestCase {
	var $fixtures = array('app.question', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.option_type', 'app.question_option', 'app.option');

	function startTest() {
		$this->Question =& ClassRegistry::init('Question');
	}

	function endTest() {
		unset($this->Question);
		ClassRegistry::flush();
	}

}
