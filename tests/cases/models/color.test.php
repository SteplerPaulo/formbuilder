<?php
/* Color Test cases generated on: 2013-10-01 16:28:06 : 1380616086*/
App::import('Model', 'Color');

class ColorTestCase extends CakeTestCase {
	var $fixtures = array('app.color');

	function startTest() {
		$this->Color =& ClassRegistry::init('Color');
	}

	function endTest() {
		unset($this->Color);
		ClassRegistry::flush();
	}

}
