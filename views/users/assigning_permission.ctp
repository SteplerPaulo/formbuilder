<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name issueOuts">
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
				</div>
			</div>
		</div>
	</div>
 </div>
<div class="sub-content-container">
	<div class="w90 center">	
		<div class="tab-content">
			<div class="users form span8 offset2">
				<?php echo $this->Form->create('User',array(
						'action'=>'assigning_permission',
						'class'=>'form-horizontal',
						'inputDefaults' => array('label'=>array('class'=>'control-label'),'div'=>array('class'=>'control-group')
					)));?>
				<fieldset>
					<legend><?php __('Assigning Permmission'); ?></legend>						
						<?php
							echo $this->Session->flash('auth').'<br>';
							echo $this->Form->input('user_id',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>'));
							echo $this->Form->input('roles',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>'));
						?>
				</fieldset>
						
						
				<div class="control-group">
					<div class="controls">
						<?php echo $this->Form->submit(__('Submit', true), array('class'=>'btn'));?>
						<?php echo $this->Form->end();?>
					</div>
				</div>
			</div>	
		</div>
	</div>	
</div>

