<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name questions">
							
							 <?php echo $this->Html->link( 'Questions',
														array('action' => 'index')
													);  ?>							</div>
						</div>
					</div>
					<div class="span3">
						<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-list-alt icon-white')).
														$this->Html->tag('span', 'Form List', array('class' => 'action-label')),
														array('action' => 'index'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate')
													);  ?>					
					</div>
					<div class="btn-group span3">
						<button class="btn fb-goto-worksheet-button">
							<i class="icon-circle-arrow-left"></i> Go Back To Worksheet
						</button>
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

<div class="row-fluid"><br/>
	<div class="questions form span8 offset2">	
		<?php echo $this->Form->create('Question',array('action'=>'add',
														'class'=>'form-horizontal',
														'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																									'div'=>array('class'=>'control-group')
																								)
														)
												);?>
		
		<fieldset>
			<legend><?php __('Add Question'); ?></legend>
			<?php echo $this->Form->input('form_id',array('type'=>'hidden','value'=>$forms['Form']['id'],'between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('domain_id',array('between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('text',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('option_type_id',array('options'=>$option_types,'between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		</fieldset>
		<div class="control-group">
			<div class="controls">
				<?php echo $this->Form->button('Save',array('type'=>'button','class'=>'btn btn-primary fb-create-save-button'));?>
				<?php echo $this->Form->button('Cancel',array('type'=>'reset','class'=>'btn'));?>
			</div>
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>


<!--Action & Notification Modal-->
<?php echo $this->Form->create('Option',array('action'=>'create','parent-model'=>'Question'));?>
<div id="Modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Notification</h3>
	</div>
	<div class="modal-body">
		<?php echo $this->Form->input('Form.id',array('id'=>'FormId','label'=>'Form Id','type'=>'hidden','class'=>'span11'));?>
		<?php echo $this->Form->input('Question.id',array('id'=>'QuestionId','label'=>'Question Id','type'=>'hidden','class'=>'span11'));?>
		
		<div class="well" id="Notification">
		
		</div>
	</div>
	
	<div class="modal-footer">
		<div class="btn-group">
			<button class="btn fb-goto-worksheet-button" type="button">Go Back to Worksheet</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Back</button>
		</div>
	</div>
</div>
<?php echo $this->Form->end();?>
<!--End-->

<!--FORMACTION-->
<?php echo $this->Form->create('Form',array('id'=>'FormAction'));?>
	<?php echo $this->Form->input('Form.id',array('id'=>'FormId','type'=>'hidden'));?>
	<?php echo $this->Form->input('object_id',array('id'=>'ObjectId','type'=>'hidden'));?>
<?php echo $this->Form->end();?>


<?php 
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>