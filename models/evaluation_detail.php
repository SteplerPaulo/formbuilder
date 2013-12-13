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
	
	public function getWeightedMean($form_id,$evaluatee){
		return $this->query("SELECT 
								text,
								ROUND(SUM(mul) / SUM(frequency),2) AS weighted_mean
								FROM
								  (SELECT 
									`evaluation_details`.`question_id`,
									`evaluations`.`form_id`,
									`questions`.`text`,
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
								  WHERE `options`.`value` > 0 
								  AND `evaluations`.`form_id`= '$form_id'
								  AND `evaluations`.`evaluatee`= '$evaluatee'
								  GROUP BY 
									`evaluation_details`.`question_id`,
									`evaluation_details`.`option_id`) AS Question 
								GROUP BY Question.question_id "
			);
	}

	public function getFrequency($form_id,$evaluatee){
		$conditions = array('Option.value >'=>0,'Evaluation.form_id'=>$form_id,'Evaluation.evaluatee'=>$evaluatee);
		
		$fields = array('EvaluationDetail.question_id','COUNT(*) as frequency','Option.value','COUNT(*) * Option.value as weight','Question.text');
		$group =array('EvaluationDetail.question_id','EvaluationDetail.option_id');
	
		return $this->find('all',compact('conditions','fields','group'));
	}
	
	public function respondent_count($form_id,$evaluatee){
		return $this->query("SELECT
			COUNT(*) AS respondent_count
		FROM
			`formbuilder`.`evaluations`
		WHERE `evaluations`.`form_id`='2' AND `evaluations`.`evaluatee`='Ms. Unknown'"
		);
	}
}
