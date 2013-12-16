<?php
class Key extends AppModel {
	var $name = 'Key';			
	var $virtualFields = array('status_str'=>"CASE status
										WHEN '0' THEN 'Active'
										WHEN '1' THEN 'Used'
									END ");
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'KeyHeader' => array(
			'className' => 'KeyHeader',
			'foreignKey' => 'key_header_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Evaluation' => array(
			'className' => 'Evaluation',
			'foreignKey' => 'key_id',
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
