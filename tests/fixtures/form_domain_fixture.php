<?php
/* FormDomain Fixture generated on: 2013-11-08 11:02:31 : 1383879751 */
class FormDomainFixture extends CakeTestFixture {
	var $name = 'FormDomain';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'form_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'domain_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'form_id' => 1,
			'domain_id' => 1
		),
	);
}
