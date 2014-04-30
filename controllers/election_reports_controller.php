<?php
class ElectionReportsController extends AppController {

	var $name = 'ElectionReports';
	var $uses = array('ElectionReport','Form');
	var $helpers = array('Access');


	function index() {
		if ($this->Rest->isActive()) {	
			$curr_data = $this->api($_GET);
			$this->set('data',$curr_data);
		}
		else if($this->RequestHandler->isAjax()){	
			$data = $this->ElectionReport->find('all');
			echo json_encode($data);
			exit;
		}else{
			$this->ElectionReport->recursive = 0;
			$this->set('electionReports', $this->paginate());
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid election report', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('electionReport', $this->ElectionReport->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			foreach($this->data['ElectionReportDetail'] as $key => $detail){
				if($detail['option_type']=='checkbox' || $detail['option_type']=='radio'){
					if(!isset($detail['option_id'])){
						unset($this->data['ElectionReportDetail'][$key]);
					}
				}else{
					if(empty($detail['answer'])){
						$this->data['ElectionReportDetail'][$key]['answer']='No Answer';
					}
				}
			}

			$this->ElectionReport->create();
			$this->data['Key']['status'] = '1';
			if ($this->ElectionReport->saveAll($this->data)) {
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
					$response['msg'] = "<a><i class='icon-warning-sign'/></i></a> Form could not be submitted. Please, try again.";
					$response['data'] = $this->data;
					echo json_encode($response);
					exit();
				}
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid election report', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ElectionReport->save($this->data)) {
				$this->Session->setFlash(__('The election report has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The election report could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ElectionReport->read(null, $id);
		}
		$forms = $this->ElectionReport->Form->find('list');
		$this->set(compact('forms'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for election report', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ElectionReport->delete($id)) {
			$this->Session->setFlash(__('Election report deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Election report was not deleted', true));
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
		if(isset($this->data['ElectionReport']['form_id'])) {
			$form_id = $this->data['ElectionReport']['form_id'];
			
			$result = $this->ElectionReport->result($form_id);
		
	

			$votes = array();
			foreach($result['Return'] as $return){
				$votes[$return['options']['id']]=$return['options']['value'];
			}
			
			$this->set(compact('result','votes'));
		}else{
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function dave_result(){
		$this->data['ElectionReport']['form_id']=3;
		if(isset($this->data['ElectionReport']['form_id'])) {
			$form_id = $this->data['ElectionReport']['form_id'];

			$result = $this->ElectionReport->result($form_id);
			$this->set(compact('result'));
		}else{
			$this->redirect(array('action'=>'index'));
		}
	}
	
	protected function api($params){
		$schema = $this->ElectionReport->schema();
		$conditions = array();
		$fields = array();
		$group = array('ElectionReport.form_id');
		$type = 'all';
		$page = 1;
		$limit = $this->Rest->limit;
		foreach($params as $key => $val){
			switch($key){
				case 'fields':
					foreach(explode(',',$val) as $f){
						if(isset($schema[$f])){
							array_push($fields,'ElectionReport.'.$f);
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
						$conditions['ElectionReport.'.$key.' LIKE']=$val;
					}else if($key!='url'){
						return $this->Rest->abort(array('status' => '404', 'error' => 'Invalid keyword '.$key.' supplied'));
					}	
				break;
			}
		}
		$this->ElectionReport->recursive = 1;
		$config =  array('conditions'=>$conditions,'group'=>$group,'fields'=>$fields,'offset'=>($page-1)*$limit,'limit'=>$limit,'orderBy ASC'=>'id');
		$data = $this->ElectionReport->find($type,$config);
		$data['count']=count($data);
		return $data;
	}
	
}
