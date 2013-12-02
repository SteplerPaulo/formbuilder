<?php
/* Key Fixture generated on: 2013-11-25 10:46:33 : 1385347593 */
class KeyFixture extends CakeTestFixture {
	var $name = 'Key';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'key_header_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'value' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 11, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'status' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'key_header_id' => 1,
			'value' => 'Lorem ips',
			'status' => 1
		),
	);
}
