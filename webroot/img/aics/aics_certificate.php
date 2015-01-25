<?php
App::import('Vendor','formsheet');

class CFH extends Formsheet{
	protected static $_width = 8.5;
	protected static $_height = 11.5;
	protected static $_unit = 'in';
	protected static $_orient = 'P';
	protected static $_allot_subjects = 15;
	
	function CFH(){
		$this->showLines = !true;
		$this->FPDF(CFH::$_orient, CFH::$_unit,array(CFH::$_width,CFH::$_height));
		$this->createSheet();
	}
	
	protected function section($metrics){
		$this->createGrid($metrics['base_x'] ,$metrics['base_y'],$metrics['width'],$metrics['height'],$metrics['rows'],$metrics['cols']);
		$this->SetDrawColor(0);
		if(isset($metrics['border'])){
			$this->Rect($metrics['base_x'],$metrics['base_y'],$metrics['width'],$metrics['height']);
		}
	}
	
	//Horizontal Divider
	function divider(){
		$metrics = array(
			'base_x'=> 0,
			'base_y'=> 0,
			'height'=> 11.5,
			'width'=> 8.5,
			'cols'=> 34,
			'rows'=> 45,
		);
		$this->section($metrics);	
		$this->GRID['font_size']=9;

		$this->drawLine(22.5,'h');
	}
	
	function body($y){
		$metrics = array(
			'base_x'=> 0.25,
			'base_y'=> 0.25+$y,
			'height'=> 5.25,
			'width'=> 8,
			'cols'=> 34,
			'rows'=> 23,
		);
		$this->section($metrics);	
		$this->GRID['font_size']=9;

		//BackGround 
		$this->DrawImage(0,5.5,8,4,'../webroot/img/aics/background.jpg');
		//$this->DrawImage(0,0,8,5.25,'../webroot/img/aics/background.jpg');
		
		//Logo
		$this->DrawImage(15.4,0,0.75,0.75,'../webroot/img/aics/logo.jpg');
		
		//Vertical Divider
		//$this->drawLine(17,'v');
		
		$y=4;
		$this->centerText(0,$y,'ANTIPOLO IMMACULATE CONCEPTION SCHOOL',$metrics['cols'],'b');
		$this->drawLine($y+0.25,'h',array(10.65,12.6));
		
		$y++;
		$this->centerText(0,$y,'an Academic Institution Committed to Service',$metrics['cols'],'');
		
		$y+=2;
		$this->GRID['font_size']=11;
		$this->SetFont('Times','BIU');
		$this->centerText(0,$y++,'CERTIFICATE OF RECOGNITION',$metrics['cols'],'b');
		
		$this->GRID['font_size']=9;
		$this->centerText(0,$y,'awarded to',$metrics['cols'],'');
		
		//Student Name
		$y+=2;
		$this->GRID['font_size']=20;
		$this->AddFont('HARNGTON','','HARNGTON.php');
		$this->centerText(0,$y,'Jeide Lyn S. Mariano',$metrics['cols'],'','HARNGTON');
		
		//Recognition
		$y+=1.5;
		$this->GRID['font_size']=13;
		$this->centerText(0,$y++,'Top 4  - Grade 7',$metrics['cols'],'b');
		
		//Date
		$this->GRID['font_size']=11;
		$this->centerText(0,$y,'FIRST GRADING PERIOD, Academic Year 2014 - 2015',$metrics['cols'],'');
		$y+=1.5;
		$this->centerText(0,$y++,'Given this 4th  day of October 2014.',$metrics['cols'],'');
		
		$this->GRID['font_size']=9;
		//Adviser
		$y = 18;
		$this->SetFont('Courier','',6);
		$this->centerText(0,$y,'Mrs. Abigail SJ. Hilario',$metrics['cols']/2,'','Times');
		$this->drawLine($y+0.25,'h',array(5,7));
		$y++;
		$this->centerText(0,$y++,'Class Adviser',$metrics['cols']/2,'');
		
		//Principal
		$y = 18;
		$this->centerText(17,$y,'Ms. Susan V. Zapanta',$metrics['cols']/2,'');
		$this->drawLine($y+0.25,'h',array(22,7));
		$y++;
		$this->centerText(17,$y++,'High School Principal',$metrics['cols']/2,'');
		
		//Director
		$y = 21;
		$this->centerText(0,$y,'Mrs. Lolita L. Mendoza',$metrics['cols'],'');
		$this->drawLine($y+0.25,'h',array(13.5,7));
		$y++;
		$this->centerText(0,$y++,'Director',$metrics['cols'],'');

		//Box
		//$this->drawBox(0,0,$metrics['cols'],$metrics['rows']);
	}
}
?>