<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name receivingReports">
									 <?php echo $this->Html->link( 'Access Control',
															'javascript:void()'
														);  ?>								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="span3 pull-right">
				<div id="simple-root"></div> 
				<div class="btn-group pull-right">
					<?php echo $access->isLoggedIn() ? '<button class="btn" disabled="disabled"><i class="icon-user"></i> '.ucfirst($access->getmy('username')).'</button>': ''; ?>
					<?php echo $access->isLoggedIn() ? '<button class="btn">'.$this->Html->link( $this->Html->tag('span', 'Logout'),'/users/logout',array('escape' => false)).'</button>' : '<button class="btn">'.$this->Html->link( $this->Html->tag('span', 'Login'),'/users/login',array('escape' => false)).'</button>'; ?>
					<?php echo $access->isLoggedIn() ? '': '<button class="btn">'.$this->Html->link( $this->Html->tag('span', 'Sign Up'),'/users/register',array('escape' => false)).'</button>'; ?>
				</div>
			</div>
		</div>
	</div>
 </div>
<div class="sub-content-container">
	<div class="w90 center">
		<ul class="btn-group">
			<li class="btn">
				<?php echo $this->Html->link('Defining Permission','/users/defining_permission',array('class' => 'button'));?>
			</li>
			<li class="btn">
				<?php echo $this->Html->link('Create Aco', '/users/create_aco',array('class' => 'button'));?>
			</li>
			<li class="btn">
				<?php echo $this->Html->link('Create Aro', '/users/create_aro',array('class' => 'button'));?>
			</li>
			<li class="btn">
				<?php echo $this->Html->link('Assigning Permission','/users/assigning_permission',array('class' => 'button'));?>
			</li>
			<li class="btn">
				<?php echo $this->Html->link('Allow User','/users/allow',array('class' => 'button'));?>
			</li>
			<li class="btn">
				<?php echo $this->Html->link('Sign Up','/users/register',array('class' => 'button'));?>
			</li>		
		</ul>
	</div>
</div>