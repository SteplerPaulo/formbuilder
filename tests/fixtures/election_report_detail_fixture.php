<?php
/* ElectionReportDetail Fixture generated on: 2014-01-22 09:45:26 : 1390355126 */
class ElectionReportDetailFixture extends CakeTestFixture {
	var $name = 'ElectionReportDetail';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'election_report_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'question_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'option_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'election_report_id' => 1,
			'question_id' => 1,
			'option_id' => 1
		),
	);
}
