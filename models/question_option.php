<?php
class QuestionOption extends AppModel {
	var $name = 'QuestionOption';
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Option' => array(
			'className' => 'Option',
			'foreignKey' => 'option_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
