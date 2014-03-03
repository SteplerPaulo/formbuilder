<?php
/* ElectionReportDetail Test cases generated on: 2014-01-22 09:45:26 : 1390355126*/
App::import('Model', 'ElectionReportDetail');

class ElectionReportDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.election_report_detail', 'app.election_report', 'app.form', 'app.form_type', 'app.form_domain', 'app.domain', 'app.question', 'app.option_type', 'app.question_option', 'app.option');

	function startTest() {
		$this->ElectionReportDetail =& ClassRegistry::init('ElectionReportDetail');
	}

	function endTest() {
		unset($this->ElectionReportDetail);
		ClassRegistry::flush();
	}

}
