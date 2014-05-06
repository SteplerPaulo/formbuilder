<?php
class User extends AppModel {
	var $name = 'User';
	
	var $hasOne = array(
		'Document' => array(
			'className' => 'Document',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
