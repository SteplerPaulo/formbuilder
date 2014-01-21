<?php
class EvaluationsController extends AppController {

	var $name = 'Evaluations';
	var $uses = array('Evaluation','Key','Form','Question');

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
			foreach($this->data['EvaluationDetail'] as $key => $detail){
				if($detail['option_type']=='checkbox' || $detail['option_type']=='radio'){
					if(!isset($detail['option_id'])){
							unset($this->data['EvaluationDetail'][$key]);
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
		if (isset($this->data['Form']['id'])) {
			$form_id = $this->data['Form']['id'];
			
			$this->Form->recursive = 3;
			$form = $this->Form->read(null, $form_id);

			foreach($form['FormDomain'] as $domain){
				foreach($form['Question'] as $question){
					if($domain['domain_id'] == $question['domain_id']){
						$form['DomainQuestion'][$question['Domain']['name']][$question['text']] = $question;
					}
				}
			}
		
			$key = $this->data['Form']['object_id'];
			$this->set(compact('form','key'));
		}else{
			$this->redirect(array('action'=>'../forms/login'));
		}
	}
	
	function result(){
		if (isset($this->data['Evaluation']['form_id']) && isset($this->data['Evaluation']['evaluatee'])) {
			$form_id= $this->data['Evaluation']['form_id'];
			$evaluatee = $this->data['Evaluation']['evaluatee'];
			$form = $this->Form->read(null, $form_id);
			$respondent_count = $this->Evaluation->EvaluationDetail->respondent_count($form_id,$evaluatee);
			$mean = $this->Evaluation->EvaluationDetail-> getMean($form_id,$evaluatee);
			
			//SUMMARY
			$summary = $this->Evaluation->EvaluationDetail->getWeightedMean($form_id,$evaluatee);
			//END
			
			//DIVERGENT QUESTIONS(COMMENT & SUGGESTION)
			$conditions = array('Evaluation.form_id'=>$form_id,'Evaluation.evaluatee'=>$evaluatee,
								'EvaluationDetail.answer Not'=>'Null','Question.option_type_id'=>3
							);
			$fields	= array('Question.id','Question.text','EvaluationDetail.answer',
							'COUNT(EvaluationDetail.id) AS count'
							);
			$divergent_answer = $this->Evaluation->EvaluationDetail->find('all',array('recursive'=>0,
													'conditions'=>$conditions,'fields'=>$fields,
													'group'=>array('EvaluationDetail.answer','EvaluationDetail.question_id')
												));		
			$divergent_question  = array();
			foreach($divergent_answer as $key => $answer){
				$divergent_question[$answer['Question']['text']][$key]= $answer;
			}
			//END
			
			//DISTRIBUTION & SPREAD INDEX
			$frequency = $this->Evaluation->EvaluationDetail-> getFrequency($form_id,$evaluatee);
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
				$index = pow(($weighted_mean-$mean), 2);
				$index_summation += $index;
			}
			$spread_index = round($index_summation/($item_count-1),2);
			//END
			
			$this->set(compact('evaluatee','form','respondent_count','summary','divergent_question','distribution','mean','spread_index'));
		}else{
			$this->redirect(array('action'=>'index'));
		}
	}
	
	protected function api($params){
		$schema = $this->Evaluation->schema();
		$conditions = array();
		$fields = array();
		$group = array('Evaluation.form_id','Evaluation.evaluatee');
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
		$this->Evaluation->recursive = 1;
		$config =  array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id');
		$data = $this->Evaluation->find($type,$config);
		$data['count']=count($data);
		return $data;
	}
	

}

