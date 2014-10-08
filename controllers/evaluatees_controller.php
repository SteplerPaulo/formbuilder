<?php
class EvaluateesController extends AppController {

	var $name = 'Evaluatees';
	var $helpers = array('Access');

	function index() {
		if ($this->Rest->isActive()) {	
			$curr_data = $this->api($_GET);
			$this->set('data',$curr_data);
			
		}else if($this->RequestHandler->isAjax()){	
			$data = $this->Evaluatee->find('all');
			echo json_encode($data);
			exit;
		}else{
			$this->Evaluatee->recursive = 0;
			$this->set('evaluatees', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid evaluatee', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('evaluatee', $this->Evaluatee->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Evaluatee->create();
			if ($this->Evaluatee->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> The evaluatee has been saved.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> The evaluatee could not be saved. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid evaluatee', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Evaluatee->save($this->data)) {
				$this->Session->setFlash(__('The evaluatee has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluatee could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Evaluatee->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for evaluatee', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Evaluatee->delete($id)) {
			$this->Session->setFlash(__('Evaluatee deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Evaluatee was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	protected function api($params){
		$schema = $this->Evaluatee->schema();
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
							array_push($fields,'Evaluatee.'.$f);
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
						$conditions['Evaluatee.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->Evaluatee->recursive = 1;
		$config =  array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id');
		$data = $this->Evaluatee->find($type,$config);
		$data['count']=count($data);
		return $data;
	}
}
