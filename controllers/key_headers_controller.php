<?php
class KeyHeadersController extends AppController {

	var $name = 'KeyHeaders';

	function index() {
		if ($this->Rest->isActive()) {	
			$curr_data = $this->api($_GET);
			foreach($curr_data as $key=>$val){
				$curr_data[$key]['Key']['count'] = count($val['Key']);
			}
			$this->set('data',$curr_data);
			
		}else if($this->RequestHandler->isAjax()){	
			$curr_data = $this->KeyHeader->find('all');
			
			foreach($curr_data as $key=>$val){
				$curr_data[$key]['Key']['count'] = count($val['Key']);
			}
			echo json_encode($data);
			exit;
		}else{
			$this->KeyHeader->recursive = 0;
			$this->set('keyHeaders', $this->paginate());
		}
	}

	function view() {
		if (isset($this->data['KeyHeader']['id']) ) {
			$id = $this->data['KeyHeader']['id'];
			$this->KeyHeader->recursive = 3;
			$data = $this->KeyHeader->read(null, $id);
			$this->set('keyHeader', $data);
		}else{
			$this->redirect(array('action'=>'index'));
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->KeyHeader->create();
			if ($this->KeyHeader->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> Key(s) has been saved.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> Key(s) could not be saved. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}
		}else{
			$this->redirect(array('action' => 'create'));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid key header', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->KeyHeader->save($this->data)) {
				$this->Session->setFlash(__('The key header has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The key header could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->KeyHeader->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for key header', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->KeyHeader->delete($id)) {
			$this->Session->setFlash(__('Key header deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Key header was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function generate_keys(){
		
		$this->set('forms', $this->KeyHeader->Form->find('list'));
	}
	
	function login_key_encryption(){
		$no_of_requested_key = $this->data['no_of_requested_key'];
		if ($this->RequestHandler->isAjax()) {
			$loginKey = array();
	
			for($ctr=0;$ctr<$no_of_requested_key;$ctr++){
				do{
					do{
						$key = substr(md5(microtime() +rand()),0,11);
					}while(in_array($key,$loginKey));
					$hasDuplicate = $this->KeyHeader->Key->find('count',array('conditions'=>array('Key.value'=>$loginKey)));
				}while($hasDuplicate);
				array_push($loginKey,$key); 
			}
		}
		echo json_encode($loginKey);
		exit;
	}
	
	function print_keys() {
		if (isset($this->data['KeyHeader']['id']) || empty($this->data['KeyHeader']['id']) ) {
			$id = $this->data['KeyHeader']['id'];
			$this->KeyHeader->recursive = 1;
			$data = $this->KeyHeader->read(null, $id);
			$this->set(compact('data'));
			$this->layout='pdf';
			$this->render();
		}else{
			$this->redirect(array('action'=>'index'));
		}
	}

	protected function api($params){
		$schema = $this->KeyHeader->schema();
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
							array_push($fields,'KeyHeader.'.$f);
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
						$conditions['KeyHeader.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->KeyHeader->recursive = 1;
		return $this->KeyHeader->find($type,array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id'));
	}
	
}

