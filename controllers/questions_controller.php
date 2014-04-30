<?php
class QuestionsController extends AppController {
	var $name = 'Questions';
	var $helpers = array('Access');
	var $uses = array('Question','FormDomain');

	function index() {
		if ($this->Rest->isActive()) {	
			$data = $this->api($_GET);
			foreach($data as $key=>$val){
				$data[$key]['QuestionCount']['count'] = count($val['Question']);	
			}
			$this->set('data',$data);
		}
		else if($this->RequestHandler->isAjax()){	
			$data = $this->Question->find('all');

			echo json_encode($data);
			exit;
		}else{
			$this->redirect(array('action' => '../forms'));
		
			$this->Question->recursive = 0;
			$this->set('questions', $this->paginate());
		}	
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid question', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('question', $this->Question->read(null, $id));
	}

	function create(){
	

		$form_id = $this->data['Form']['id'];
		if(!empty($form_id)){
			$forms = $this->Question->Form->find('first',array('conditions'=>array('Form.id'=>$form_id)));
			$option_types = $this->Question->OptionType->find('list',array('fields'=>array('OptionType.id','OptionType.description')));								
			

			//Domain List
			if(isset($this->data['Form']['object_id'])){						
				$domains = $this->Question->Domain->find('list',array(
									'conditions'=>array('Domain.id'=>$this->data['Form']['object_id'])
								));	
			
			}else{
				$domains = $this->FormDomain->find('list',array(
										'recursive'=>1,
										'conditions'=>array('FormDomain.form_id'=>$form_id),
										'fields'=>array('Domain.id','Domain.name')
									));
			}
					
			$this->set(compact('forms','domains','option_types'));
		}else{
			$this->redirect(array('action' => '../forms/index'));
		}
	}
	
	function add() {
		if (!empty($this->data)) {			
			$this->Question->create();
			if ($this->Question->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Question has been saved.";
					
					$response['data'] = $this->data;
					$response['data']['Form']['id'] = $this->data['Question']['form_id'];
					$response['data']['Question']['id'] = $this->Question->id;
					
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The question has been saved', true));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> The question could not be saved. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
					$this->Session->setFlash(__('Question could not be saved. Please, try again.', true));
				}
			}
		}
	}
	
	function edit() {
		$id = $this->data['Form']['object_id'];
		$form_id = $this->data['Form']['id'];
		
		if (!$id && empty($this->data)) {
			$this->redirect(array('action' => '../forms'));
		}
		if (!empty($this->data['Question'])) {
			if ($this->Question->saveAll($this->data)) {
				$this->Session->setFlash(__('The question has been saved', true));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.', true));
			}
		}
		
		
			
		$domains = $this->FormDomain->find('list',array(
										'recursive'=>1,
										'conditions'=>array('FormDomain.form_id'=>$form_id),
										'fields'=>array('Domain.id','Domain.name')
									));
		
		$this->data = $this->Question->read(null, $id);
		$forms = $this->Question->Form->find('list');
		$option_types = $this->Question->OptionType->find('list',array('fields'=>array('OptionType.id','OptionType.description')));								
		
		$this->set(compact('forms','domains','id','form_id','option_types'));
	}

	function delete() {
		
		$id = $this->data['Form']['object_id'];
		
		if(isset($id)) {
			if ($this->Question->delete($id,true)) {
			
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Question and its element deleted.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}else{
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Question not deleted. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}
		}else{
			$this->redirect(array('action'=>'../forms'));
		}
	}
	
	protected function api($params){
		$schema = $this->Question->schema();
		$conditions = array();
		$fields = array();
		$group = array();
		$type = 'all';
		$page = 1;
		$limit = $this->Rest->limit;
		foreach($params as $key => $val){
			switch($key){
				case 'fields':
					foreach(explode(',',$val) as $f){
						
						if(isset($schema[$f])){
							array_push($fields,'Question.'.$f);
						}else{
							return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid field '.$f.' supplied'));
						}
					}
				break;
				case 'group':
					foreach(explode(',',$val) as $f){
						if(isset($schema[$f])){
							array_push($group,'Question.'.$f);
							if(count($fields)==0){
								foreach($schema as $sk=>$sv){
									array_push($fields,'Question.'.$sk);									
								}
							}
							if(!in_array('GROUP_CONCAT(Question.id) as ids',$fields)){
								array_push($fields,'GROUP_CONCAT(Question.id) as ids');
							}
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
						$conditions['Question.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		

		$this->Question->recursive = 1;
		return $this->Question->find($type,array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit));
	}
	
}
