<?php
/* OptionType Test cases generated on: 2013-11-08 10:34:50 : 1383878090*/
App::import('Model', 'OptionType');

class OptionTypeTestCase extends CakeTestCase {
	function startTest() {
		$this->OptionType =& ClassRegistry::init('OptionType');
	}

	function endTest() {
		unset($this->OptionType);
		ClassRegistry::flush();
	}

}
