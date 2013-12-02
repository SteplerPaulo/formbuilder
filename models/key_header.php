<?php
class KeyHeader extends AppModel {
	var $name = 'KeyHeader';
	var $useDbConfig = 'evaluation';
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

}