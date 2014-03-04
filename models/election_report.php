<?php
class ElectionReport extends AppModel {
	var $name = 'ElectionReport';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Form' => array(
			'className' => 'Form',
			'foreignKey' => 'form_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ElectionReportDetail' => array(
			'className' => 'ElectionReportDetail',
			'foreignKey' => 'election_report_id',
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
	
	public function result($form_id){
		$return =  $this->query( 
			"SELECT 
			  `questions`.`id`,
			  `questions`.`text`,
			  `options`.`id`,
			  `options`.`text`,
			  `options`.`value`,
			  SUM(`options`.`value`) AS vote_count
			FROM
			  `formbuilder_c`.`election_reports` 
			  INNER JOIN `formbuilder_c`.`election_report_details` 
				ON (
				  `election_reports`.`id` = `election_report_details`.`election_report_id`
				) 
			  INNER JOIN `formbuilder_c`.`forms` 
				ON (
				  `election_reports`.`form_id` = `forms`.`id`
				) 
			  INNER JOIN `formbuilder_c`.`questions` 
				ON (
				  `election_report_details`.`question_id` = `questions`.`id`
				) 
			  INNER JOIN `formbuilder_c`.`options` 
				ON (
				  `election_report_details`.`option_id` = `options`.`id`
				) 
			GROUP BY `questions`.`id`,`options`.`id`
			"
		);
		
		$ballot =  $this->query( 
			"SELECT
				`forms`.`title`
				, `options`.`id`
				,`options`.`text`
				, `questions`.`id`
				, `questions`.`text`
			FROM
				`formbuilder_c`.`options`
				INNER JOIN `formbuilder_c`.`question_options` 
					ON (`options`.`id` = `question_options`.`option_id`)
				INNER JOIN `formbuilder_c`.`questions` 
					ON (`question_options`.`question_id` = `questions`.`id`)
				INNER JOIN `formbuilder_c`.`forms` 
					ON (`questions`.`form_id` = `forms`.`id`)
			WHERE (`forms`.`id` = '$form_id')
			"
		);
		
		$option_count =  $this->query( 
			"SELECT 
			  `questions`.`id`,
			  `questions`.`text`, 
			  COUNT(`questions`.`id`) AS option_count
			FROM
			  `options` 
			  INNER JOIN `question_options` 
				ON (
				  `options`.`id` = `question_options`.`option_id`
				) 
			  INNER JOIN `questions` 
				ON (
				  `question_options`.`question_id` = `questions`.`id`
				) 
			  INNER JOIN `forms` 
				ON (
				  `questions`.`form_id` = `forms`.`id`
				) 
			WHERE (`forms`.`id` = '3')
			GROUP BY `questions`.`id`
			"
		);

		return array('Return'=>$return,'Ballot'=>$ballot,'OptionCount'=>$option_count);
	}
}
