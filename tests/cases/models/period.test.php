<?php
/* Period Test cases generated on: 2015-01-26 05:33:47 : 1422246827*/
App::import('Model', 'Period');

class PeriodTestCase extends CakeTestCase {
	var $fixtures = array('app.period');

	function startTest() {
		$this->Period =& ClassRegistry::init('Period');
	}

	function endTest() {
		unset($this->Period);
		ClassRegistry::flush();
	}

}
