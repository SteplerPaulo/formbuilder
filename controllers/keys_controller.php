<?php
class KeysController extends AppController {
	var $name = 'Keys';

	function index() {
		if ($this->Rest->isActive()) {	
			$data = $this->api($_GET);
			$this->set('data',$data);
		}
		else if($this->RequestHandler->isAjax()){	
			$data = $this->Key->find('all');
			echo json_encode($data);
			exit;
		}else{
			$this->Key->recursive = 0;
			$this->set('keys', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid key', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('key', $this->Key->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Key->create();
			if ($this->Key->save($this->data)) {
				$this->Session->setFlash(__('The key has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The key could not be saved. Please, try again.', true));
			}
		}
		$keyHeaders = $this->Key->KeyHeader->find('list');
		$this->set(compact('keyHeaders'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid key', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Key->save($this->data)) {
				$this->Session->setFlash(__('The key has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The key could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Key->read(null, $id);
		}
		$keyHeaders = $this->Key->KeyHeader->find('list');
		$this->set(compact('keyHeaders'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for key', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Key->delete($id)) {
			$this->Session->setFlash(__('Key deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Key was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	protected function api($params){
		$schema = $this->Key->schema();
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
							array_push($fields,'Key.'.$f);
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
						$conditions['Key.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->Key->recursive = 1;
		return $this->Key->find($type,array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id'));
	}
	
}