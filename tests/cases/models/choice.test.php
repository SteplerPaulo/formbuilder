<?php
/* Choice Test cases generated on: 2013-11-04 17:27:02 : 1383557222*/
App::import('Model', 'Choice');

class ChoiceTestCase extends CakeTestCase {
	var $fixtures = array('app.choice', 'app.question', 'app.question_choice');

	function startTest() {
		$this->Choice =& ClassRegistry::init('Choice');
	}

	function endTest() {
		unset($this->Choice);
		ClassRegistry::flush();
	}

}
