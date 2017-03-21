<?php
class EvaluationsController extends AppController {

	var $name = 'Evaluations';
	var $helpers = array('Access');
	var $uses = array('Evaluation','Key','Form','Question','Evaluatee','SchoolYear','Period','EducLevel');
	
	function beforeFilter(){ 
		parent::beforeFilter();
		$this->Auth->userModel = 'User'; 
		$this->Auth->allow(array('form'));	
    } 
	
	function index() {
		if ($this->Rest->isActive()) {
			$curr_data = $this->api($_GET);
			$this->set('data',$curr_data);
		}
		else if($this->RequestHandler->isAjax()){	
			$data = $this->Evaluation->find('all');
			echo json_encode($data);
			exit;
		}else{
			$this->Evaluation->recursive = 0;
			$this->set('evaluations', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid evaluation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('evaluation', $this->Evaluation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$sy = $this->SchoolYear->findByIsDefault(1);
			$this->data['Evaluation']['school_year_id'] = $sy['SchoolYear']['id'];
			
			foreach($this->data['EvaluationDetail'] as $key => $detail){
				if($detail['option_type']=='checkbox' || $detail['option_type']=='radio'){
					if(!isset($detail['option_id'])){
						//unset($this->data['EvaluationDetail'][$key]);\
						$this->data['EvaluationDetail'][$key]['option_id']='1';
	
					}
				}else{
					if(empty($detail['answer'])){
						$this->data['EvaluationDetail'][$key]['answer']='No Answer';
					}
				}
			}
			
			$this->Evaluation->create();
			$this->data['Key']['status'] = '1';
			if ($this->Evaluation->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Form successfully submitted.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Form could not be submitted. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid evaluation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Evaluation->save($this->data)) {
				$this->Session->setFlash(__('The evaluation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Evaluation->read(null, $id);
		}
		$forms = $this->Evaluation->Form->find('list');
		$this->set(compact('forms'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for evaluation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Evaluation->delete($id)) {
			$this->Session->setFlash(__('Evaluation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Evaluation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function form(){
		//$educLevels = $this->EducLevel->find('list');
		//pr($educLevels);exit;
		if (isset($this->data['Form']['id'])) {
			$form_id = $this->data['Form']['id'];
			
			$this->Form->recursive = 3;
			$form = $this->Form->read(null, $form_id);
			$evaluatees = $this->Evaluatee->find('list');
		
			foreach($form['FormDomain'] as $domain){
				foreach($form['Question'] as $question){
					if($domain['domain_id'] == $question['domain_id']){
						$form['DomainQuestion'][$question['Domain']['name']][$question['text']] = $question;
					}
				}
			}
		
			$key = $this->data['Form']['object_id'];
			
			if($this->data['Form']['id'] == 1 || $this->data['Form']['id'] == 10 || $this->data['Form']['id'] == 13 || $this->data['Form']['id'] == 15){
				$periods = $this->Period->find('list',array('conditions'=>array('Period.type'=>2)));
				$educLevels = $this->EducLevel->find('list');
				$this->set(compact('form','key','evaluatees','periods','educLevels'));
			
			}else{
				$this->set(compact('form','key','evaluatees'));
			}
		}else{
			$this->redirect(array('action'=>'../forms/login'));
		}
	}
	
	function result(){
		//pr($this->data);exit;
		if (isset($this->data['Evaluation']['form_id']) && isset($this->data['Evaluation']['evaluatee_id']) && isset($this->data['Evaluation']['school_year_id'])) {
			$form_id= $this->data['Evaluation']['form_id'];
			$evaluatee_id = $this->data['Evaluation']['evaluatee_id'];
			$evalutee =  $this->data['Evaluation']['evaluatee'];
			$school_year_id = $this->data['Evaluation']['school_year_id'];
			$school_year =  $this->data['Evaluation']['school_year'];
			$period_id = $this->data['Evaluation']['period_id'];
			$period = $this->data['Evaluation']['period'];
			$educ_level_id = $this->data['Evaluation']['educ_level_id'];
			$educ_level = $this->data['Evaluation']['educ_level'];
			$form = $this->Form->read(null, $form_id);
			
			$respondent_count = $this->Evaluation->EvaluationDetail->respondent_count($form_id,$evaluatee_id,$school_year_id,$period_id,$educ_level_id);
			//pr($respondent_count);exit;
			$mean = $this->Evaluation->EvaluationDetail-> getMean($form_id,$evaluatee_id,$school_year_id,$period_id,$educ_level_id);
			//pr($mean);exit;
			
			//SUMMARY
			$summary = $this->Evaluation->EvaluationDetail->getWeightedMean($form_id,$evaluatee_id,$school_year_id,$period_id,$educ_level_id);
			//pr($summary);
			//END
			
			//DIVERGENT QUESTIONS(COMMENT & SUGGESTION)
			$conditions = array('Evaluation.form_id'=>$form_id,'Evaluation.evaluatee_id'=>$evaluatee_id,
								'Evaluation.school_year_id'=>$school_year_id,
								'EvaluationDetail.answer Not'=>'Null','Question.option_type_id'=>3,
								array('OR' => array(
									array('Evaluation.period_id' => $period_id),
									array('Evaluation.period_id'=> Null)
								)),
								array('OR' => array(
									array('Evaluation.educ_level_id' => $educ_level_id),
									array('Evaluation.educ_level_id'=> Null)
								)));
			$fields	= array('Question.id','Question.text','EvaluationDetail.answer',
							'COUNT(EvaluationDetail.id) AS count'
							);
			$divergent_answer = $this->Evaluation->EvaluationDetail->find('all',array('recursive'=>0,
													'conditions'=>$conditions,'fields'=>$fields,
													'group'=>array('EvaluationDetail.answer','EvaluationDetail.question_id')
												));		
			//pr($divergent_answer);exit;									
												
			$divergent_question  = array();
			foreach($divergent_answer as $key => $answer){
				$divergent_question[$answer['Question']['text']][$key]= $answer;
			}
			//END
			
			//DISTRIBUTION & SPREAD INDEX
			$frequency = $this->Evaluation->EvaluationDetail-> getFrequency($form_id,$evaluatee_id,$school_year_id,$period_id,$educ_level_id);
			//pr($frequency);exit;
			$distribution = array();
			$index_summation = 0.00;
			$item_count = count($summary);
			$index = 0;
			$mean = round($mean[0][0]['mean'],2);
			foreach($summary as $s){
				foreach($frequency as $k=>$f){
					if($s['Question']['text']==$f['Question']['text']){
						$distribution[$s['Question']['text']]['weighted_mean']=$s['0']['weighted_mean'];
						$distribution[$s['Question']['text']]['domain_id']=$s['Question']['domain_id'];
						$distribution[$s['Question']['text']]['domain_name']=$s['Question']['domain_name'];
						$distribution[$s['Question']['text']][$f['Option']['value']]=$f;
					}
				}
				$weighted_mean = round($s[0]['weighted_mean'],2);
				//pr($weighted_mean);
				$index = pow(($weighted_mean-$mean), 2);
				//pr($weighted_mean-$mean);
				$index_summation += $index;
			}
			//pr($index_summation);
			//pr($item_count);
			$spread_index = ($item_count!=1)?round($index_summation/($item_count-1),2):'1';
			//END
			
			$this->set(compact('evalutee','period','educ_level','school_year','form','respondent_count','summary','divergent_question','distribution','mean','spread_index'));
		}else{
			$this->redirect(array('action'=>'index'));
		}
	}
	
	protected function api($params){
	
		$schema = $this->Evaluation->schema();
		$conditions = array();
		$fields = array();
		$group = array('Evaluation.form_id','Evaluation.evaluatee_id','Evaluation.school_year_id','Evaluation.period_id','Evaluation.educ_level_id');
		$type = 'all';
		$page = 1;
		$limit = $this->Rest->limit;
		
		foreach($params as $key => $val){
			switch($key){
				case 'fields':
					foreach(explode(',',$val) as $f){
						if(isset($schema[$f])){
							array_push($fields,'Evaluation.'.$f);
						}else{
							return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid field '.$f.' supplied'));
						}
					}
				break;
				
				case 'page':
					$page = $val;
				break;
				case 'limit':
					$limit = $val;
				break;
				default:
					if(isset($schema[$key])){
						$conditions['Evaluation.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		

		$this->Evaluation->recursive = 0;
		$config =  array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy DESC'=>'id');
		$data = $this->Evaluation->find($type,$config);

		$result = $this->Evaluation->find('all',array('group'=>$group));
		$data['count'] = count($result);
		return $data;
	}
	
	function test(){
		$group = array('Evaluation.form_id','Evaluation.evaluatee_id','Evaluation.school_year_id','Evaluation.period_id','Evaluation.educ_level_id');
		$this->Evaluation->recursive = 0;
		$result = $this->Evaluation->find('all',array('group'=>$group));
		pr(count($result));
		pr($result);exit;
	}

}
