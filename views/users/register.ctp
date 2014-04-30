<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name issueOuts">
									 <?php echo $this->Html->link( 'Issue Outs',
															'javascript:void()'
														);  ?>								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="span3 pull-right">
				 <div id="simple-root"></div> 
				<?php echo $access->isLoggedIn() ? '<button class="btn pull-right">'.$this->Html->link( $this->Html->tag('span', 'Logout'),'/users/logout',array('escape' => false)).'</button>' : '<button class="btn pull-right">'.$this->Html->link( $this->Html->tag('span', 'Login'),'/users/login',array('escape' => false)).'</button>'; ?>
			</div>
		</div>
	</div>
 </div>
<div class="sub-content-container">
	<div class="w90 center">
		<div class="users form span8 offset2">
			<?php echo $this->Form->create('User',array(
					'action'=>'register','class'=>'form-horizontal',
					'inputDefaults' => array('label'=>array('class'=>'control-label'),'div'=>array('class'=>'control-group')
				)));?>
			<fieldset>
				<legend><?php __('Sign Up'); ?></legend>
					<?php
						echo $this->Form->input('username',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>'));
						echo $this->Form->input('password',array('required'=>'required','value'=>false,'between'=>'<div class="controls">','after'=>'</div>'));
						echo $this->Form->input('confirm_password',array('required'=>'required','value'=>false,'type'=>'password','between'=>'<div class="controls">','after'=>'</div>'));
					?>
					<hr/>
					<?php
						echo $this->Form->input('last_name',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>'));
						echo $this->Form->input('first_name',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>'));
						echo $this->Form->input('middle_name',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>'));
					?>	
			</fieldset>	
			<div class="control-group">
				<div class="controls">
					<?php echo $this->Form->submit(__('Submit', true), array('id'=>'SubmitButton','class'=>'btn'));?>
					<?php echo $this->Form->end();?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	echo $this->Html->script(array('biz/register'),array('inline'=>false));
?>