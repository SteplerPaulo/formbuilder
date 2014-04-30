<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name issueOuts">
									 <?php echo $this->Html->link( 'User Account',
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
		<div class="users form span8 offset2">
			<?php echo $this->Form->create('User',array(
					'action'=>'account_setting',
					'class'=>'form-horizontal',
					'inputDefaults' => array('label'=>array('class'=>'control-label'),'div'=>array('class'=>'control-group')
				)));?>
			<fieldset>
				<legend><?php __('Edit Account'); ?></legend>
				
				
				<?php
					echo $this->Form->input('id',array('value'=>$data['User']['id'],'between'=>'<div class="controls">','after'=>'</div>'));
					echo $this->Form->input('username',array('value'=>$data['User']['username'],'between'=>'<div class="controls">','after'=>'</div>'));
					echo $this->Form->input('current_password',array('type'=>'password','required'=>'required','value'=>false,'between'=>'<div class="controls">','after'=>'</div>'));
				?>
				<hr/>
				
				<div class="control-group">
					<label for="ChangePassword" class="control-label">Change Password</label>
					<div class="controls">
						<input type="checkbox" id="ChangePassword"> 
					</div>
				</div>
				<div id="NewPasswordWrapper">
					<?php
						echo $this->Form->input('new_password',array('disabled'=>'disabled','value'=>false,'type'=>'password','between'=>'<div class="controls">','after'=>'</div>'));
						echo $this->Form->input('re-type_new_password',array('disabled'=>'disabled','value'=>false,'type'=>'password','between'=>'<div class="controls">','after'=>'</div>'));
					?>
				</div>
				<hr/>
				
				<div class="control-group">
					<label for="ChangeInfo" class="control-label">Change Info</label>
					<div class="controls">
						<input type="checkbox" id="ChangeInfo"> 
					</div>
				</div>
				<div id="InfoWrapper">
					<?php
						echo $this->Form->input('last_name',array('value'=>$data['User']['last_name'],'disabled'=>'disabled','required'=>'required','between'=>'<div class="controls">','after'=>'</div>'));
						echo $this->Form->input('first_name',array('value'=>$data['User']['first_name'],'disabled'=>'disabled','required'=>'required','between'=>'<div class="controls">','after'=>'</div>'));
						echo $this->Form->input('middle_name',array('value'=>$data['User']['middle_name'],'disabled'=>'disabled','between'=>'<div class="controls">','after'=>'</div>'));
					?>	
				</div>
			</fieldset>
			<div class="control-group">
				<div class="controls">
					<?php echo $this->Form->button('Submit', array('type'=>'button','id'=>'SubmitButton','class'=>'btn btn-primary','disabled'=>'disabled'));?>
					<?php echo $this->Form->button('Reset',array('type'=>'reset','id'=>'ResetButton','class'=>'btn'));?>
					<?php echo $this->Form->end();?>
				</div>
			</div>
			<span id="Notify" class="hide"></span>
			<div id="LoginUser" class="hide"><?php echo $access->getmy('username');?></div>
			<br/><br/><br/>
		</div>
	</div>
</div>

<?php
	echo $this->Html->script(array('biz/account_setting'),array('inline'=>false));
?>