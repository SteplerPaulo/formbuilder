<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name forms">
							
							 <?php echo $this->Html->link( 'Forms',
														array('action' => 'index')
													);  ?>							</div>
						</div>
					</div>
					<div class="btn-group span3">
						<button class="btn fb-goto-worksheet-button">
							<i class="icon-circle-arrow-left"></i> Go Back To Worksheet
						</button>
					</div>
					<!--
					<div class="btn-group span3">
						<a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-circle-arrow-down"></i><span class="action-label">More Action</span>	
						</a>
						<ul class="dropdown-menu">
							<li>
								&nbsp;<i class="icon-plus-sign"></i><b> ADD</b>
								&nbsp;<a action="/formbuilder/form_types/create" class="fb-more-action"> Form Type</a>
							</li>
						</ul>
					</div>
					-->
				</div>
			</div>
		</div>
	</div>
 </div>

<div class="row-fluid">
	<div class="forms form span6 offset3"><br/>
	<?php echo $this->Form->create('Form',array(
												'class'=>'form-horizontal',
																		'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																									'div'=>array('class'=>'control-group')
																								)
																		)
												);?>
		<fieldset>
			<legend><?php __('Edit Form'); ?></legend>
			<?php echo $this->Form->input('id',array('type'=>'hidden','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('title',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('description',array('between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('form_type_id',array('options'=>$form_types,'between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		</fieldset>
		<div class="control-group">
			<div class="controls">
			<?php echo $this->Form->button('Save',array('type'=>'button','class'=>'btn btn-primary fb-edit-save-button'));?>
			<?php echo $this->Form->button('Cancel',array('type'=>'reset','class'=>'btn'));?>
			</div>
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>


<!--FORMACTION-->
<?php echo $this->Form->create('Form',array('id'=>'FormAction'));?>
	<? echo $this->Form->input('Form.id',array('id'=>'FormId','type'=>'hidden'));?>
	<? echo $this->Form->input('object_id',array('id'=>'ObjectId','type'=>'hidden'));?>
<?php echo $this->Form->end();?>

<?php 
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>