<?php
/* Key Test cases generated on: 2013-11-25 10:46:33 : 1385347593*/
App::import('Model', 'Key');

class KeyTestCase extends CakeTestCase {
	var $fixtures = array('app.key', 'app.key_header', 'app.evaluation', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option', 'app.evaluation_detail');

	function startTest() {
		$this->Key =& ClassRegistry::init('Key');
	}

	function endTest() {
		unset($this->Key);
		ClassRegistry::flush();
	}

}
