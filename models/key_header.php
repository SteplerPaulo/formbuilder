<?php
class KeyHeader extends AppModel {
	var $name = 'KeyHeader';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Key' => array(
			'className' => 'Key',
			'foreignKey' => 'key_header_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	var $belongsTo = array(
		'Form' => array(
			'className' => 'Form',
			'foreignKey' => 'form_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Evaluatee' => array(
			'className' => 'Evaluatee',
			'foreignKey' => 'evaluatee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
