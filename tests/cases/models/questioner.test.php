<?php
/* Questioner Test cases generated on: 2013-11-04 17:27:34 : 1383557254*/
App::import('Model', 'Questioner');

class QuestionerTestCase extends CakeTestCase {
	var $fixtures = array('app.questioner', 'app.question');

	function startTest() {
		$this->Questioner =& ClassRegistry::init('Questioner');
	}

	function endTest() {
		unset($this->Questioner);
		ClassRegistry::flush();
	}

}
