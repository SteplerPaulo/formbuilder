<?php
class EvaluationDetail extends AppModel {
	var $name = 'EvaluationDetail';
	
	//var $virtualFields = array('weight'=>'COUNT(*) * Option.value');  

	var $belongsTo = array(
		'Evaluation' => array(
			'className' => 'Evaluation',
			'foreignKey' => 'evaluation_id',
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
	
	public function getWeightedMean($form_id,$evaluatee_id,$school_year_id,$period_id,$educ_level_id){
		//pr($period_id);exit;
		return $this->query("SELECT 
								text,
								ROUND(SUM(mul) / SUM(frequency),2) AS weighted_mean,
								domain_name,
								domain_id
								FROM
								  (SELECT 
									`evaluation_details`.`question_id`,
									`evaluations`.`form_id`,
									`questions`.`text`,
									`domains`.`name` AS domain_name,
									`domains`.`id` AS domain_id,
									COUNT(evaluations.`id`) AS frequency,
									COUNT(`evaluation_details`.`option_id`) * `options`.`value` AS mul 
								  FROM
									`evaluation_details` 
									INNER JOIN `options` 
									  ON (
										`evaluation_details`.`option_id` = `options`.`id`
									  ) 
									INNER JOIN `evaluations` 
									  ON (
										`evaluations`.`id` = `evaluation_details`.`evaluation_id`
									  ) 
									INNER JOIN `questions` 
									  ON (
										`questions`.`id` = `evaluation_details`.`question_id`
									  ) 
									INNER JOIN `domains` 
									  ON (
										`domains`.`id` = `questions`.`domain_id`
									  ) 
								  WHERE `evaluations`.`form_id`= '$form_id'
								  AND `evaluations`.`evaluatee_id`= '$evaluatee_id'
								  AND `evaluations`.`school_year_id`= '$school_year_id'
								  AND (`evaluations`.`period_id` = @period_id OR @period_id IS NULL)
								  AND (`evaluations`.`educ_level_id` = @educ_level_id OR @educ_level_id IS NULL)
								  GROUP BY 
									`evaluation_details`.`question_id`,
									`evaluation_details`.`option_id`) AS Question 
								GROUP BY Question.question_id "
			);
	}

	public function getFrequency($form_id,$evaluatee_id,$school_year_id,$period_id,$educ_level_id){
		$conditions = array('Evaluation.form_id'=>$form_id,
							'Evaluation.evaluatee_id'=>$evaluatee_id,
							'Evaluation.school_year_id'=>$school_year_id,
							array('OR' => array(
								array('Evaluation.period_id' => $period_id),
								array('Evaluation.period_id'=> Null)
							)),
							array('OR' => array(
								array('Evaluation.educ_level_id' => $educ_level_id),
								array('Evaluation.educ_level_id'=> Null)
							)));
			
		
		$fields = array('EvaluationDetail.question_id','COUNT(*) as frequency','Option.value','COUNT(*) * Option.value as weight','Question.text');
		$group =array('EvaluationDetail.question_id','EvaluationDetail.option_id');
	
		return $this->find('all',compact('conditions','fields','group'));
	}
	
	public function respondent_count($form_id,$evaluatee_id,$school_year_id,$period_id,$educ_level_id){
		return $this->query("SELECT
			COUNT(*) AS respondent_count
		FROM
			`evaluations`
		WHERE `evaluations`.`form_id`='$form_id'
			AND `evaluations`.`evaluatee_id`='$evaluatee_id'
			AND `evaluations`.`school_year_id`='$school_year_id'
			AND (`evaluations`.`period_id` = @period_id OR @period_id IS NULL)
			AND (`evaluations`.`educ_level_id` = @educ_level_id OR @educ_level_id IS NULL)
		
		"
		);
	}

	public function getMean($form_id,$evaluatee_id,$school_year_id,$period_id,$educ_level_id){
		return $this->query("SELECT 
								  SUM(wgt_mean) / COUNT(question_id) AS mean 
								FROM
								  (SELECT 
									question_id,
									SUM(mul) / SUM(frequency) AS wgt_mean 
								  FROM
									(SELECT 
									  `evaluation_details`.`question_id`,
									  COUNT(evaluations.`id`) AS frequency,
									  COUNT(
										`evaluation_details`.`option_id`
									  ) * `options`.`value` AS mul 
									FROM
									  `evaluation_details` 
									  INNER JOIN `options` 
										ON (
										  `evaluation_details`.`option_id` = `options`.`id`
										) 
									  INNER JOIN `evaluations` 
										ON (
										  `evaluations`.`id` = `evaluation_details`.`evaluation_id`
										) 
									WHERE `options`.`value` > 0 
											AND `evaluations`.`form_id`= '$form_id'
											AND `evaluations`.`evaluatee_id`= '$evaluatee_id'
											AND `evaluations`.`school_year_id`= '$school_year_id'
											AND (`evaluations`.`period_id` = @period_id OR @period_id IS NULL)
											AND (`evaluations`.`educ_level_id` = @educ_level_id OR @educ_level_id IS NULL)
									GROUP BY 
									  `evaluation_details`.`question_id`,
									  `evaluation_details`.`option_id`) AS f_tbl 
								  GROUP BY f_tbl.question_id) AS w_tbl ");
	}
	
}
