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
					<div class="span3 upAccount">
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-chevron-left')).
													$this->Html->tag('span', 'BACK', array('class' => 'action-label')),
													'/pages/apps',array('escape' => false,'class'=>'btn btn-medium tree-back btn-block animate' ,'id'=>'intent-back')
													); ?> 					
					</div>
				</div>
			</div>
			<div class="btn-group pull-right">
				<?php echo $access->isLoggedIn() ? '': '<button class="btn">'.$this->Html->link( $this->Html->tag('span', 'Sign Up'),'/users/register',array('escape' => false)).'</button>'; ?>
			</div>
		</div>
	</div>
 </div>
<div class="sub-content-container">
	<div class="w90 center">
		<div class="users form span8 offset2">
			<?php echo $this->Form->create('User',array(
					'class'=>'form-horizontal',
					'inputDefaults' => array('label'=>array('class'=>'control-label'),'div'=>array('class'=>'control-group')
				)));?>
			<fieldset>
				<legend><?php __('Login'); ?></legend>						
					<?php
						echo $this->Session->flash('auth').'<br>';
						echo $this->Form->input('username',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>'));
						echo $this->Form->input('password',array('required'=>'required','onkeypress'=>'PasswordCapsLock(event)','between'=>'<div class="controls">','after'=>'</div>'));

					?>
			</fieldset>
					
					
			<div class="control-group">
				<div class="controls">
					<?php echo $this->Form->submit(__('Login', true), array('class'=>'btn'));?>
					<?php echo $this->Form->end();?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	echo $this->Html->script(array('biz/login'),array('inline'=>false));
?>
