<?php
/* Domain Test cases generated on: 2013-11-04 17:27:18 : 1383557238*/
App::import('Model', 'Domain');

class DomainTestCase extends CakeTestCase {
	var $fixtures = array('app.domain', 'app.question');

	function startTest() {
		$this->Domain =& ClassRegistry::init('Domain');
	}

	function endTest() {
		unset($this->Domain);
		ClassRegistry::flush();
	}

}
