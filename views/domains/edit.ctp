<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name domains">
							
							 <?php echo $this->Html->link( 'Domains',
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
			<div class="span6 text-right">
				 <input class="span6 m-t-5 p" type="text" placeholder="Search">
			</div>
		</div>
	</div>
 </div>

<div class="row-fluid">
<div class="domains form span6 offset3">

<?php echo $this->Form->create('Domain',array(	'class'=>'form-horizontal',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>
	<fieldset>
		<legend><?php __('Edit Domain'); ?></legend>
		<?php echo $this->Form->input('id',array('placeholder'=>'Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('name',array('placeholder'=>'Name','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('description',array('placeholder'=>'Description','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
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
	<? echo $this->Form->input('Form.id',array('id'=>'FormId','value'=>$form_id,'type'=>'hidden'));?>
	<? echo $this->Form->input('object_id',array('id'=>'ObjectId','value'=>$id,'type'=>'hidden'));?>
<?php echo $this->Form->end();?>

<?php 
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>