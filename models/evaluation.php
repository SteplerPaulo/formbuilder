<?php
class Evaluation extends AppModel {
	var $name = 'Evaluation';
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
		),
		'Evaluatee' => array(
			'className' => 'Evaluatee',
			'foreignKey' => 'evaluatee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SchoolYear' => array(
			'className' => 'SchoolYear',
			'foreignKey' => 'school_year_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Period' => array(
			'className' => 'Period',
			'foreignKey' => 'period_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'EvaluationDetail' => array(
			'className' => 'EvaluationDetail',
			'foreignKey' => 'evaluation_id',
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
