<?php
/* FormDomain Test cases generated on: 2013-11-08 11:02:31 : 1383879751*/
App::import('Model', 'FormDomain');

class FormDomainTestCase extends CakeTestCase {
	var $fixtures = array('app.form_domain', 'app.form', 'app.form_type', 'app.question', 'app.domain', 'app.option_type', 'app.question_option', 'app.option');

	function startTest() {
		$this->FormDomain =& ClassRegistry::init('FormDomain');
	}

	function endTest() {
		unset($this->FormDomain);
		ClassRegistry::flush();
	}

}
