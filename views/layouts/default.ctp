<!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php __('FBM'); ?>
			<?php echo $title_for_layout; ?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
  
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css(array('bootstrap','pccr','simple','template','jquery_ui'));
			echo $this->Html->css(array('font-awesome'));
			echo $this->Html->css(array('media-query'));
			echo '<!--[if IE 7]>';
			echo $this->Html->css(array('font-awesome-ie7.min'));
			echo '<![endif]-->';
			echo $this->Html->css(array('profile/banner','profile/home','profile/submodule','profile/navigation','profile/modal','profile/form-canvas','profile/pagination'));
			echo $this->Html->css(array('card/info_card','effects/index'));
			echo $this->Html->css(array('ss/ssMetrics','ss/ssInterface','effects/animate'));
			echo $this->Html->css(array('joyride/joyride-2.0.3'));
			echo $this->Html->css(array('dataTable'));
			echo $this->Html->script(array('jquery','jquery.dataTables'));
			echo $this->Html->css(array('advancedTable'));
		?>
		
		<style>
			textarea { resize: none; }
		</style>
	</head>

	<body class="paper" server-date="<?php echo date('m-d-Y h:i:s');  ?>" server-year="<?php echo date('Y'); ?>" >
		<!--Side Navigation-->
		<nav class="main-nav animate" id="main-nav">
			<?php 
			if($access->isLoggedIn()):
				echo $this->Html->link( $this->Html->tag('img', '', array('style'=>'width:40px;height:40px','class' => 'media-object','alt'=>'','src'=>(!empty($user['Document']['id']))?'/bookstore/users/download/'.$user['Document']['id']:'/bookstore/img/200x250.gif')).' '.
										$this->Html->tag('span', $access->getmy('username'), array('class' => 'module-label')),
										array('controller'=>'users','plugin'=>null,'action'=>'view'), array('escape' => false)
										);  
			 endif;
			?>
		
			 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-home')).' '.
											$this->Html->tag('span', 'Home', array('class' => 'module-label')),
											array('controller'=>'pages','plugin'=>null,'action'=>'home'), array('escape' => false)
											);  ?>
			<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-th-large')).' '.
											$this->Html->tag('span', 'Apps', array('class' => 'module-label')),
											array('controller'=>'pages','plugin'=>null,'action'=>'apps'), array('escape' => false)
											);  ?>
			<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-wrench')).' '.
								$this->Html->tag('span', 'Access Control', array('class' => 'module-label')),
								array('controller'=>'pages','plugin'=>null,'action'=>'access_control'), array('escape' => false)
								);  ?>
			<?php echo ($this->Access->check('User','create','read','update','delete'))? $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-user')).' '.
											$this->Html->tag('span', 'Users', array('class' => 'module-label')),
											array('controller'=>'users','plugin'=>null,'action'=>'index'), array('escape' => false)
											):''; ?>	
											
			<?php echo ($this->Access->isLoggedIn())? $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-cog')).' '.
											$this->Html->tag('span', 'Account Setting', array('class' => 'module-label')),
											array('controller'=>'users','plugin'=>null,'action'=>'account_setting'), array('escape' => false)
											):''; ?>	
		</nav>
		<div class="page-wrap animate">
			<!--HEADER-->
			<div class="header-container">
				<header class="main-header animate">
					<a href="#main-nav" class="open-menu " ><i class=" icon-reorder "></i></a>
					<a href="#" class="close-menu "><i class="icon-reorder"></i></a>
					<span class="simpilified-solution-header-inner ">Form Builder Module</span>
					<div class="window-min-width"/><!--Get Window Width-->
				</header>	
			</div>
			<!--CONTENT-->
			<div class="content">  
				<div class="content-background"></div>
				<?php echo $content_for_layout; ?>
				
				<?php
					echo $this->Html->script(array('bootstrap','jqueryForm', 'jquery_ui','navigation','intents','utils/money' ));
					echo $this->Html->script(array('joyride/jquery.joyride-2.0.3'));
					echo $this->Html->script(array('ui/uiInputNumeric','utils/server','ui/uiDatePicker'));
					echo $this->Html->script(array('media-query'));
					echo $this->Html->script(array('utils/advancedtable'));
					echo $scripts_for_layout;
					// echo $this->Html->script('simplyconnect',array('id'=>'smplycnnct')); 
				?>
				</div>
			</div>
		</div>
	</body>
</html>