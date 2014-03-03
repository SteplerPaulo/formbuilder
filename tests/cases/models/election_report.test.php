<?php
/* ElectionReport Test cases generated on: 2014-01-22 09:44:49 : 1390355089*/
App::import('Model', 'ElectionReport');

class ElectionReportTestCase extends CakeTestCase {
	var $fixtures = array('app.election_report', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option', 'app.election_report_detail');

	function startTest() {
		$this->ElectionReport =& ClassRegistry::init('ElectionReport');
	}

	function endTest() {
		unset($this->ElectionReport);
		ClassRegistry::flush();
	}

}
