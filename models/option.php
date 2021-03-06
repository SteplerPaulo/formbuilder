<?php
class Option extends AppModel {
	var $name = 'Option';
	var $virtualFields = array('remarks'=>"CASE is_correct
									WHEN '1' THEN 'Correct'
									WHEN '0' THEN 'Incorrect'
								END ");
	
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Question' => array(
			'className' => 'Question',
			'joinTable' => 'question_options',
			'foreignKey' => 'option_id',
			'associationForeignKey' => 'question_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
