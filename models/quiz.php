<?php
class Quiz extends AppModel {
	var $name = 'Quiz';
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
		)
	);

	var $hasMany = array(
		'QuizDetail' => array(
			'className' => 'QuizDetail',
			'foreignKey' => 'quiz_id',
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

	public function result($form_id,$examinee){
		return $this->query( 
			"SELECT
				`forms`.`title`
				, `forms`.`description`
				, `form_types`.`name`
				, `domains`.`id`
				, `domains`.`name`
				,`quizzes`.`id`
				, `quizzes`.`examinee`
				, `quizzes`.`created`
				, `quizzes`.`form_id`
				, `quiz_details`.`answer`
				, `questions`.`text`
				, `options`.`value`
				, `options`.`is_correct`
				, `options`.`text`
				, `correct_answer`.`text`
				, `correct_answer`.`is_correct`
				, `correct_answer`.`value`
				,IF (`options`.`is_correct`= 1, 'Correct', 'Incorrect') AS result
			FROM
				`formbuilder_c`.`quizzes`
				INNER JOIN `formbuilder_c`.`quiz_details` 
					ON (`quizzes`.`id` = `quiz_details`.`quiz_id`)
				INNER JOIN `formbuilder_c`.`options` 
					ON (`quiz_details`.`option_id` = `options`.`id`)
				INNER JOIN `formbuilder_c`.`questions` 
					ON (`quiz_details`.`question_id` = `questions`.`id`)
				INNER JOIN `formbuilder_c`.`forms` 
					ON (`forms`.`id` = `quizzes`.`form_id`)
				INNER JOIN `formbuilder_c`.`form_types` 
					ON (`forms`.`form_type_id` = `form_types`.`id`)
				INNER JOIN `formbuilder_c`.`form_domains` 
					ON (`form_domains`.`form_id` = `forms`.`id`)
				INNER JOIN `formbuilder_c`.`domains` 
					ON (`form_domains`.`domain_id` = `domains`.`id`)
				, `formbuilder_c`.`questions` AS `questions_1` 
				INNER JOIN `formbuilder_c`.`question_options` 
					ON (`questions_1`.`id` = `question_options`.`question_id`)
				INNER JOIN `formbuilder_c`.`options` AS `correct_answer` 
					ON (`correct_answer`.`id` = `question_options`.`option_id`)
			WHERE (`quizzes`.`examinee` = '$examinee'
				AND `quizzes`.`form_id` = '$form_id'
				AND `correct_answer`.`is_correct` = '1')GROUP BY `questions`.`id`"
		);
    }

}
