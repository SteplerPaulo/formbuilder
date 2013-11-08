<?php
/* Color Fixture generated on: 2013-10-01 16:28:06 : 1380616086 */
class ColorFixture extends CakeTestFixture {
	var $name = 'Color';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'r' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 3),
		'g' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 3),
		'b' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 3),
		'hex' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor ',
			'r' => 1,
			'g' => 1,
			'b' => 1,
			'hex' => 'Lorem ipsum dolor '
		),
	);
}
