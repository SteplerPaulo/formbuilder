<?php
/* Evaluation Fixture generated on: 2013-11-22 16:12:10 : 1385107930 */
class EvaluationFixture extends CakeTestFixture {
	var $name = 'Evaluation';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'form_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'evaluatee' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'evaluator' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'create' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'form_id' => 1,
			'evaluatee' => 'Lorem ipsum dolor sit amet',
			'evaluator' => 'Lorem ipsum dolor sit amet',
			'create' => '2013-11-22 16:12:10'
		),
	);
}
