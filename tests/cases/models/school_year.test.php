<?php
/* SchoolYear Test cases generated on: 2015-01-26 03:22:56 : 1422238976*/
App::import('Model', 'SchoolYear');

class SchoolYearTestCase extends CakeTestCase {
	var $fixtures = array('app.school_year');

	function startTest() {
		$this->SchoolYear =& ClassRegistry::init('SchoolYear');
	}

	function endTest() {
		unset($this->SchoolYear);
		ClassRegistry::flush();
	}

}
