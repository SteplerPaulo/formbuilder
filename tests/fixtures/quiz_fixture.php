<?php
/* Quiz Fixture generated on: 2014-01-08 11:17:28 : 1389151048 */
class QuizFixture extends CakeTestFixture {
	var $name = 'Quiz';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'form_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'key_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'evaluatee' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'evaluator' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'form_id' => 1,
			'key_id' => 1,
			'evaluatee' => 'Lorem ipsum dolor sit amet',
			'evaluator' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-01-08 11:17:28'
		),
	);
}
