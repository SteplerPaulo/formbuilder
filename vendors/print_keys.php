<?php
App::import('Vendor','formsheet');
class KeysForm extends Formsheet{
	protected static $_width = 11.5;
	protected static $_height = 8.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_allot_subjects = 15;
	function KeysForm(){
		$this->showLines = !true;
		$this->FPDF(KeysForm::$_orient, KeysForm::$_unit,array(KeysForm::$_width,KeysForm::$_height));
		$this->createSheet();
	}
	protected function section($metrics){
		$this->createGrid($metrics['base_x'] ,$metrics['base_y'],$metrics['width'],$metrics['height'],$metrics['rows'],$metrics['cols']);
		$this->SetDrawColor(0);
		if(isset($metrics['border'])){
			$this->Rect($metrics['base_x'],$metrics['base_y'],$metrics['width'],$metrics['height']);
		}
	}
	function keys($data){
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0.25,
			'height'=> 1,
			'width'=> 8.5,
			'cols'=> 45,
			'rows'=> 6,
		);
		$this->section($metrics);	
		$this->GRID['font_size']=9;
		$line1=5;
		$line2=6;
		$line3=7;
		$x=1;
		$gridBox=0;
		$date = new DateTime($data['KeyHeader']['created']);
		$date = date_format($date, 'm/d/Y H:i:s');
		
		$this->leftText(1,1,'Form : '.$data['Form']['title'],'','');
		$this->leftText(1,2,'Date Created : '.$date,'','');
		$this->drawLine(4,'h',array(1,43));
	
		foreach($data['Key'] as $key){
			$this->leftText($x,$line1,'Key: '.$key['value'],'');
			$this->leftText($x,$line2,'Status: '. $key['status_str'],'');
			$this->drawLine($line3,'h',array($x,8.6));
			
			$x+=8.6;
			$gridBox+=8.6;
			if($gridBox==43){
				$line1+=3;
				$line2+=3;
				$line3+=3;
				$x=1;
				$gridBox=0;
			}
		}
		
	}
}
?>