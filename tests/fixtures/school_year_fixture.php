<?php
/* SchoolYear Fixture generated on: 2015-01-26 03:22:56 : 1422238976 */
class SchoolYearFixture extends CakeTestFixture {
	var $name = 'SchoolYear';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 9, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'is_default' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem i',
			'is_default' => 1
		),
	);
}
