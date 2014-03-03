<?php
class ElectionReportDetail extends AppModel {
	var $name = 'ElectionReportDetail';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ElectionReport' => array(
			'className' => 'ElectionReport',
			'foreignKey' => 'election_report_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
