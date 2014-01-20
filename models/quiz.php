<?php
class Quiz extends AppModel {
	var $name = 'Quiz';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Form' => array(
			'className' => 'Form',
			'foreignKey' => 'form_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Key' => array(
			'className' => 'Key',
			'foreignKey' => 'key_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
