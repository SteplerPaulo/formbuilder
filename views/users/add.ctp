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
					<div class="span3">
					<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate' ,'id'=>'intent-create')
													);  ?>					
					</div>
				</div>
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
				<legend><?php __('Add User'); ?></legend>
					<?php
						echo $this->Form->input('username',array('between'=>'<div class="controls">','after'=>'</div>'));
						echo $this->Form->input('password',array('between'=>'<div class="controls">','after'=>'</div>'));

					?>
			</fieldset>
					
					
			<div class="control-group">
				<div class="controls">
					<?php echo $this->Form->submit(__('Submit', true), array('class'=>'btn'));?>
					<?php echo $this->Form->end();?>
				</div>
			</div>
		
		</div>
		<div class="actions pull-right">
			<?php echo $this->Html->link(__('List Users', true), array('action' => 'index'),array('class'=>'btn'));?>
		</div>
	</div>
</div>
