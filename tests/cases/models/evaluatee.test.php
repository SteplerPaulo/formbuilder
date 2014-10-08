<?php
/* Evaluatee Test cases generated on: 2014-10-08 05:22:44 : 1412738564*/
App::import('Model', 'Evaluatee');

class EvaluateeTestCase extends CakeTestCase {
	var $fixtures = array('app.evaluatee');

	function startTest() {
		$this->Evaluatee =& ClassRegistry::init('Evaluatee');
	}

	function endTest() {
		unset($this->Evaluatee);
		ClassRegistry::flush();
	}

}
