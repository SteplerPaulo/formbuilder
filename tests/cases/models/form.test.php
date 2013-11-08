<?php
/* Form Test cases generated on: 2013-11-05 16:16:39 : 1383639399*/
App::import('Model', 'Form');

class FormTestCase extends CakeTestCase {
	var $fixtures = array('app.form', 'app.form_type', 'app.form_domain', 'app.question', 'app.domain', 'app.question_option');

	function startTest() {
		$this->Form =& ClassRegistry::init('Form');
	}

	function endTest() {
		unset($this->Form);
		ClassRegistry::flush();
	}

}
