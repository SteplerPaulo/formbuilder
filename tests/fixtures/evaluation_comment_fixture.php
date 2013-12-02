<?php
/* EvaluationComment Fixture generated on: 2013-11-22 16:08:31 : 1385107711 */
class EvaluationCommentFixture extends CakeTestFixture {
	var $name = 'EvaluationComment';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'evaluation_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'comment_type_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'comment' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'id' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'evaluation_id' => 1,
			'comment_type_id' => 1,
			'comment' => 'Lorem ipsum dolor sit amet'
		),
	);
}
