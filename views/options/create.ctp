<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name options">
							<?php echo $this->Html->link( 'Options',
														array('action' => 'index')
													);  ?>							
							</div>
						</div>
					</div>
					<div class="btn-group span3">
						<a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown" href="#">
							<i class=" icon-th-list"></i><span class="action-label">LINKS</span>	
						</a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link(__('Questions', true), array('controller' => 'questions', 'action' => 'index')); ?> </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
 </div>

<div class="row-fluid">
	<div class="options form span8 offset2">
	<?php echo $this->Form->input('Question.id',array('value'=>$question['Question']['id'],'type'=>'hidden','label'=>'Question Id'));?>
			
	<?php echo $this->Form->create('Option',array(	'action'=>'add',
													'class'=>'form-horizontal',
														'inputDefaults' => array( 	
															'label'=>array(
																'class'=>'control-label'),
																'div'=>array('class'=>'control-group')
															)
												)
											);?>
		<fieldset>
			<legend><center><?php echo __('Add Option').' for <br/>'. $question['Question']['text']; ?></center></legend>

			<?php echo $this->Form->input('Question',array('options'=>$question_list,'between'=>'<div class="controls">','after'=>'</div>'));?>
			<?php echo $this->Form->input('text',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('value',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('is_correct',array('placeholder'=>'','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
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
<?php echo $this->Form->create('Form',array('action'=>'view','parent-model'=>'Option','target'=>'_blank'));?>
<div id="Modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Notification</h3>
	</div>
	<div class="modal-body">
		<?php echo $this->Form->input('Form.id',array('id'=>'FormId','label'=>'Form Id','type'=>'hidden','class'=>'span11'));?>
		<?php echo $this->Form->input('Option.id',array('id'=>'OptionId','label'=>'Option Id','type'=>'hidden','class'=>'span11'));?>

		<div class="well" id="Notification"></div>
		<div class="well"><a><i class='icon-info-sign'></i></a> Instruction here...</div>
	</div>
	<div class="modal-footer">
		<div class="btn-group">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Create Another Option</button>
			<button class="btn" type="submit"> Preview Form</button>
		</div>
	</div>
</div>
<?php echo $this->Form->end();?>

<?php
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>