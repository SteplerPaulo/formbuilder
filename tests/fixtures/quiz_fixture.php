<?php
/* Quiz Fixture generated on: 2014-01-20 14:19:09 : 1390198749 */
class QuizFixture extends CakeTestFixture {
	var $name = 'Quiz';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'form_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'key_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'examinee' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'form_id' => 1,
			'key_id' => 1,
			'examinee' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-01-20 14:19:09'
		),
	);
}
