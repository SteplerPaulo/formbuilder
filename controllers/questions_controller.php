<?php
class QuestionsController extends AppController {
	var $name = 'Questions';
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

	function add() {
		if (!empty($this->data)) {
			$this->Question->create();
			if ($this->Question->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = '<img src="/lib/img/icons/tick.png" />&nbsp;Question has been saved.';
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('The question has been saved', true));
					$this->redirect(array('action' => 'index'));
				}
				$this->redirect(array('action' => '../options/add'));
				
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<img src='/lib/img/icons/exclamation.png'/>&nbsp; The question could not be saved. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
					$this->Session->setFlash(__('Question could not be saved. Please, try again.', true));
				}
			}
		}
	}
	
	function create(){
		$form_id = $this->data['Form']['id'];
		if(!empty($form_id)){
			$forms = $this->Question->Form->find('first',array(
												'conditions'=>array('Form.id'=>$form_id)	
											));
												
			$domains = $this->FormDomain->find('list',array(
										'recursive'=>1,
										'conditions'=>array('FormDomain.form_id'=>$form_id),
										'fields'=>array('Domain.id','Domain.name')
									));
			$option_types = $this->Question->OptionType->find('list',array('fields'=>array('OptionType.id','OptionType.description')));
			$this->set(compact('forms','domains','option_types'));
		}else{
			$this->redirect(array('action' => '../forms/index'));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid question', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Question->save($this->data)) {
				$this->Session->setFlash(__('The question has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Question->read(null, $id);
		}
		$forms = $this->Question->Form->find('list');
		$this->set(compact('forms'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for question', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Question->delete($id)) {
			$this->Session->setFlash(__('Question deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Question was not deleted', true));
		$this->redirect(array('action' => 'index'));
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
