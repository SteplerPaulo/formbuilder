<?php
class DomainsController extends AppController {

	var $name = 'Domains';

	function index() {
		if ($this->Rest->isActive()) {	
			$data = $this->api($_GET);
			$this->set('data',$data);
		}
		else if($this->RequestHandler->isAjax()){	
			$data = $this->Domain->find('all');
			echo json_encode($data);
			exit;
		}else{
			$this->redirect(array('action' => '../forms'));
			
			$this->Domain->recursive = 0;
			$this->set('domains', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid domain', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('domain', $this->Domain->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Domain->create();
			if ($this->Domain->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Domain has been saved.";
					$response['data'] = $this->data;
					$response['data']['Domain']['id'] = $this->Domain->id;
					echo json_encode($response);
					exit();
				}else{ 
					$this->Session->setFlash(__('Domain has been saved', true));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Domain could not be saved. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}else{
					$this->Session->setFlash(__('Domain could not be saved. Please, try again.', true));
				}
			}
		}else{
			$this->redirect(array('action' => 'index'));
		}
	
		
		$forms = $this->Domain->Form->find('first',array('conditions'=>array('Form.id'=>$this->data['Form']['id'])));
		$this->set(compact('forms'));
	}
	
	function create(){
		$form_id = $this->data['Form']['id'];
		if(!empty($form_id)){
			$forms = $this->Domain->FormDomain->find('first',array('conditions'=>array('Form.id' => $form_id)));
			$this->set(compact('forms'));
		}else{
			$this->redirect(array('action' => '../forms/index'));
		}
	}

	function edit() {
		$id = $this->data['Form']['object_id'];
		$form_id = $this->data['Form']['id'];
	
	
		if (!$id && empty($this->data)) {
			$this->redirect(array('action' => '../forms'));
		}
		if (!empty($this->data['Domain'])) {
			if ($this->Domain->save($this->data)) {
				$this->Session->setFlash(__('The domain has been saved', true));
			} else {
				$this->Session->setFlash(__('The domain could not be saved. Please, try again.', true));
			}
		}
		
		$this->data = $this->Domain->read(null, $id);
		$forms = $this->Domain->Form->find('list');
		$this->set(compact('forms','id','form_id'));
	}

	function delete() {
		$id = $this->data['Form']['object_id'];
		
		if(isset($id)) {
			if ($this->Domain->delete($id,true)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Domain and its element deleted.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}else{
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Domain not deleted. Please, try again.";
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
		$schema = $this->Domain->schema();
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
							array_push($fields,'Domain.'.$f);
						}else{
							return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid field '.$f.' supplied'));
						}
					}
				break;
				case 'group':
					foreach(explode(',',$val) as $f){
						if(isset($schema[$f])){
							array_push($group,'Domain.'.$f);
							if(count($fields)==0){
								foreach($schema as $sk=>$sv){
									array_push($fields,'Domain.'.$sk);									
								}
							}
							if(!in_array('GROUP_CONCAT(Domain.id) as ids',$fields)){
								array_push($fields,'GROUP_CONCAT(Domain.id) as ids');
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
						$conditions['Domain.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->Domain->recursive = 1;
		return $this->Domain->find($type,array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id'));
	}
	
}
