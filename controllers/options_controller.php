<?php
class OptionsController extends AppController {

	var $name = 'Options';
	var $helpers = array('Access');
	var $uses = array('Option','QuestionOption');

	function index() {
		if ($this->Rest->isActive()) {	
			$data = $this->api($_GET);

			$this->set('data',$data);
		}
		else if($this->RequestHandler->isAjax()){	
			$data = $this->Option->find('all');

			echo json_encode($data);
			exit;
		}else{
			$this->redirect(array('action' => '../forms'));
			//$this->Option->recursive = 0;
			//$this->set('options', $this->paginate());
		}	
	
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid option', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('option', $this->Option->read(null, $id));
	}

	function create(){

		if(isset($this->data['Form']['object_id'])){
				
			$q = $this->Option->Question->find('first',array(
										'conditions'=>array(
											'Question.id'=>$this->data['Form']['object_id']),
										'fields'=>array(
											'Question.id','Question.text'
											)
										));
										
			
				
			if(isset($this->data['Form']['option_cog']) && $this->data['Form']['option_cog'] =="multiple"){
			
				$questions = $this->Option->Question->find('list',array(
										'recursive'=>0,
										'conditions'=>array(
											'Question.form_id'=>$this->data['Form']['id']),
										'fields'=>array(
											'Question.id','Question.text'
											)
										));			
				//pr($question_list);exit;
				
				$this->set(compact('questions','q'));
			}else{
				
				$this->set(compact('q'));
			}
			
		}else{
			$this->redirect(array('action' => '../forms'));
		}

	}

	function add() {
		if (!empty($this->data)) {
			$this->Option->create();
			if ($this->Option->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Option has been saved.";
					$response['data'] = $this->data;
					$response['data']['Option']['id'] = $this->Option->id;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('Option has been saved', true));
				}
				
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Option could not be saved. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
					$this->Session->setFlash(__('Option could not be saved. Please, try again.', true));
				}
			}
		}else{
			$this->redirect(array('action' => '../forms'));
		}
	
		$questions = $this->Option->Question->find('list',array('fields'=>array('Question.id','Question.text')));
		$this->set(compact('questions'));
	}
	
	function edit() {
		$id = $this->data['Form']['object_id'];
		$form_id = $this->data['Form']['id'];
		
		
	
		if (!$id && empty($this->data)) {
			$this->redirect(array('action' => '../forms'));
		}
		
		if (!empty($this->data['Option'])) {
			if ($this->Option->save($this->data)) {
				$this->Session->setFlash(__('The option has been saved', true));
			} else {
				$this->Session->setFlash(__('The option could not be saved. Please, try again.', true));
			}
		}
		
		$this->data = $this->Option->read(null, $id);
		$questions = $this->Option->Question->find('list',array(
										'recursive'=>0,
										'conditions'=>array(
											'Question.form_id'=>$form_id),
										'fields'=>array(
											'Question.id','Question.text'
											)
										));	
		$this->set(compact('questions','id','form_id'));
	}

	function delete() {
		$id = $this->data['Form']['object_id'];
		//pr($this->data);exit;
		
		if(isset($id)) {
			if($this->data['Form']['delete_type'] == 'all'){
				if ($this->Option->delete($id)) {
					if($this->RequestHandler->isAjax()){
						$response['status'] = 1;
						$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Option deleted.";
						$response['data'] = $this->data;
						echo json_encode($response);
						exit();
					}
				}else{
					if($this->RequestHandler->isAjax()){
						$response['status'] = -1;
						$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Option not deleted. Please, try again.";
						$response['data'] = $this->data;
						echo json_encode($response);
						exit();
					}
				}
			}
			if($this->data['Form']['delete_type'] == 'one'){
				$id = $this->data['Form']['question_option_id'];
			
				if ($this->QuestionOption->delete($id)) {
					if($this->RequestHandler->isAjax()){
						$response['status'] = 1;
						$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Option deleted.";
						$response['data'] = $this->data;
						echo json_encode($response);
						exit();
					}
				}else{
					if($this->RequestHandler->isAjax()){
						$response['status'] = -1;
						$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Option not deleted. Please, try again.";
						$response['data'] = $this->data;
						echo json_encode($response);
						exit();
					}
				}
			}
		}else{
			$this->redirect(array('action'=>'../forms'));
		}
	}
	
	protected function api($params){
		$schema = $this->Option->schema();
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
							array_push($fields,'Option.'.$f);
						}else{
							return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid field '.$f.' supplied'));
						}
					}
				break;
				case 'group':
					foreach(explode(',',$val) as $f){
						if(isset($schema[$f])){
							array_push($group,'Option.'.$f);
							if(count($fields)==0){
								foreach($schema as $sk=>$sv){
									array_push($fields,'Option.'.$sk);									
								}
							}
							if(!in_array('GROUP_CONCAT(Option.id) as ids',$fields)){
								array_push($fields,'GROUP_CONCAT(Option.id) as ids');
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
						$conditions['Option.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		

		$this->Option->recursive = 1;
		return $this->Option->find($type,array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit));
	}
	
}
