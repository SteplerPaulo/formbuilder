<?php
/* VendorDetail Fixture generated on: 2013-09-23 05:49:33 : 1379915373 */
class VendorDetailFixture extends CakeTestFixture {
	var $name = 'VendorDetail';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 8, 'key' => 'primary'),
		'vendor_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 8),
		'tin_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'landline' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mobile' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'address' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'vendor_id' => 1,
			'tin_number' => 'Lorem ipsum dolor sit amet',
			'landline' => 'Lorem ipsum d',
			'mobile' => 'Lorem ipsum d',
			'address' => 'Lorem ipsum dolor sit amet'
		),
	);
}
