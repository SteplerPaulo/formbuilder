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
													);  ?>							
							</div>
						</div>
					</div>
					<div class="span3">
						<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-list-alt icon-white')).
														$this->Html->tag('span', 'Form List', array('class' => 'action-label')),
														array('action' => 'index'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate')
													);  ?>					</div>
					<div class="btn-group span3">
						<a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-circle-arrow-down"></i><span class="action-label">More Action</span>	
						</a>
						<ul class="dropdown-menu">
							<li>
								<i class="icon-plus-sign"></i><b> ADD</b>
								<a action="/formbuilder/form_types/create" class="fb-more-action"> Form Type</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
 </div>

<div class="row-fluid">
	<div class="forms form span6 offset3">
	<?php echo $this->Form->create('Form',array(	
										'action'=>'add',
										'class'=>'form-horizontal',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>
		<fieldset>
			<legend><?php __('Add Form'); ?></legend>
			<?php echo $this->Form->input('title',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('description',array('between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('form_type_id',array('between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
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
<?php echo $this->Form->create('Domain',array('action'=>'create','parent-model'=>'Form'));?>
<div id="Modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Modal</h3>
	</div>
	<div class="modal-body">
		<?php echo $this->Form->input('Form.id',array('id'=>'FormId','label'=>'Form Id','type'=>'hidden','class'=>'span11'));?>
		
		<div class="well" id="Notification"></div>
		<div class="well"><a><i class='icon-info-sign'></i></a> Instruction here...</div>
	</div>
	
	<div class="modal-footer">
		<div class="btn-group">
			<button class="btn" type="submit">Create Form's Domain</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Create Another Form</button>
		</div>
	</div>
</div>
<?php echo $this->Form->end();?>
<!--End-->
<?php 
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>