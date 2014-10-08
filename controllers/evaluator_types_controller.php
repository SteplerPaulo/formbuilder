<?php
class EvaluatorTypesController extends AppController {

	var $name = 'EvaluatorTypes';
	var $helpers = array('Access');

	function index() {
		if ($this->Rest->isActive()) {	
			$curr_data = $this->api($_GET);
			$this->set('data',$curr_data);
			
		}else if($this->RequestHandler->isAjax()){	
			$data = $this->EvaluatorType->find('all');
			echo json_encode($data);
			exit;
		}else{
			$this->EvaluatorType->recursive = 0;
			$this->set('evaluatorTypes', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid evaluator type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('evaluatorType', $this->EvaluatorType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->EvaluatorType->create();
			if ($this->EvaluatorType->saveAll($this->data)) {
				if($this->RequestHandler->isAjax()){
					$response['status'] = 1;
					$response['msg'] = "<a><i class='icon-ok-sign'/></i></a> The evaluator type has been saved.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			} else {
				if($this->RequestHandler->isAjax()){
					$response['status'] = -1;
					$response['msg'] = "<a><i class='icon-warning-sign' /></i></a> The evaluator type could not be saved. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid evaluator type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->EvaluatorType->save($this->data)) {
				$this->Session->setFlash(__('The evaluator type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluator type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->EvaluatorType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for evaluator type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->EvaluatorType->delete($id)) {
			$this->Session->setFlash(__('Evaluator type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Evaluator type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	protected function api($params){
		$schema = $this->EvaluatorType->schema();
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
							array_push($fields,'EvaluatorType.'.$f);
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
						$conditions['EvaluatorType.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->EvaluatorType->recursive = 1;
		$config =  array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id');
		$data = $this->EvaluatorType->find($type,$config);
		$data['count']=count($data);
		return $data;
	}
}