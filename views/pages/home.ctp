<?php $SCHOOL = array(	'name'=>'Holy Trinity Academy',
						'address'=>'Address',
						'since'=>1937,
				);?>
<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span2 module homepage">
						<div class="module-wrap">
							<div class="module-name ">
									 <?php echo $this->Html->link( 'Home',
															'javascript:void()'
														);  ?>								
							</div>
						</div>
					</div>
					<div class="span3"></div>
				</div>
			</div>
			<div class="span3 pull-right  " id="Login">
				<div id="simple-root"></div> 
			</div>
		</div>
	</div>
	
 </div>

<div class="row-fluid">
	<div class="span4 offset1" id="home-brief">
		<h4 class="text-center lead"><?php echo $SCHOOL['name']; ?></h4>
		<div class="school_logo">
			<?php 
			// echo $this->Html->image('trademarks/school_logo.png?a', array('alt' =>  $SCHOOL['name'])); 
			?>               
		</div>
		<!--<h4 class="text-left">Core Values</h4>
			<p class=" text-left">
			Integrity. Leadership. Excellence. Accountability. Discipline.
			</p>-->
	</div>
	<div class="span6 offset1 " id="register-user">
		<form class="form-horizontal">
			<div class="control-group">
				<div class="controls">
					<h4 class=" text-right lead " id="product">Form Builder</h4>
					<p class="lead  text-right" id="tag-line">....</p>				 
				</div>
			</div>
		</form>
	</div>
</div>
<ol id="joyRideTipContent">
	<li data-id="CreateAccount" data-text="Next"   class="custom">
		<h2>Create an Account</h2>
		<p>Content...</p>
	</li>
	<li data-id="Login" data-text="Next" class="custom">
		<h2>Login</h2>
		<p>Content...</p>
	</li>
</ol>

