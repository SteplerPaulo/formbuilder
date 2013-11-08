<?php
/* QuestionOption Fixture generated on: 2013-11-06 13:01:26 : 1383714086 */
class QuestionOptionFixture extends CakeTestFixture {
	var $name = 'QuestionOption';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'question_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'option_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'question_id' => 1,
			'option_id' => 1
		),
	);
}
