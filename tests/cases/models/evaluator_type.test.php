<?php
/* EvaluatorType Test cases generated on: 2014-10-08 07:22:22 : 1412745742*/
App::import('Model', 'EvaluatorType');

class EvaluatorTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.evaluator_type');

	function startTest() {
		$this->EvaluatorType =& ClassRegistry::init('EvaluatorType');
	}

	function endTest() {
		unset($this->EvaluatorType);
		ClassRegistry::flush();
	}

}
