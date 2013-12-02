<?php
/* EvaluationDetail Test cases generated on: 2013-11-22 16:12:34 : 1385107954*/
App::import('Model', 'EvaluationDetail');

class EvaluationDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.evaluation_detail', 'app.evaluation', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option');

	function startTest() {
		$this->EvaluationDetail =& ClassRegistry::init('EvaluationDetail');
	}

	function endTest() {
		unset($this->EvaluationDetail);
		ClassRegistry::flush();
	}

}
