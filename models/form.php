<?php
class Form extends AppModel {
	var $name = 'Form';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'FormType' => array(
			'className' => 'FormType',
			'foreignKey' => 'form_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'FormDomain' => array(
			'className' => 'FormDomain',
			'foreignKey' => 'form_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'FormDomain.index_order,FormDomain.id ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'form_id',
			'dependent' => true,
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
