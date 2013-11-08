<?php
class FormsController extends AppController {

	var $name = 'Forms';

	function index() {
		if ($this->Rest->isActive()) {	
			$data = $this->api($_GET);
			foreach($data as $key=>$val){
				$data[$key]['QuestionCount']['count'] = count($val['Question']);	
			}
			$this->set('data',$data);
		}
		else if($this->RequestHandler->isAjax()){	
			$data = $this->Form->find('all');
			
			foreach($data as $key=>$val){
				$data[$key]['QuestionCount']['count'] = count($val['Question']);
			}

			echo json_encode($data);
			exit;
		}else{
			$this->Form->recursive = 0;
			$this->set('forms', $this->paginate());
		}
	}

	function view() {
		$form_id = $this->data['Form']['id'];
		
		$this->Form->recursive = 3;
		$data = $this->Form->read(null, $form_id);
		
		foreach($data['FormDomain'] as $domain){
			foreach($data['Question'] as $question){
				if($domain['domain_id'] == $question['domain_id']){
					$data['DomainQuestion'][$question['Domain']['name']][$question['content']] = $question;
				}
			}
		}
		
		$this->set('form', $data);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Form->create();
			if ($this->Form->save($this->data)) {
				$this->Session->setFlash(__('The form has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form could not be saved. Please, try again.', true));
			}
		}
		$formTypes = $this->Form->FormType->find('list');
		$this->set(compact('formTypes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid form', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Form->save($this->data)) {
				$this->Session->setFlash(__('The form has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Form->read(null, $id);
		}
		$formTypes = $this->Form->FormType->find('list');
		$this->set(compact('formTypes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for form', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Form->delete($id)) {
			$this->Session->setFlash(__('Form deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Form was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function questions_list(){
		$form_id = $this->data['Form']['id'];

		
		$data = $this->Form->Question->find('all',array('conditions'=>array('Form.id'=>$form_id)));
		$this->set('data',$data);
		
	}
	
	protected function api($params){
		$schema = $this->Form->schema();
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
							array_push($fields,'Form.'.$f);
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
						$conditions['Form.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->Form->recursive = 1;
		return $this->Form->find($type,array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id'));
	}
	
}
