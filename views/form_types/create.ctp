<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name formTypes">
							
							 <?php echo $this->Html->link( 'Form Types',
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

<div class="row-fluid">
	<div class="formTypes form span6 offset3">
	<?php echo $this->Form->create('FormType',array(	
												'action'=>'add',
												'class'=>'form-horizontal',
														'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																					'div'=>array('class'=>'control-group')
																				)
														)
												);?>
		<fieldset>
			<legend><?php __('Add Form Type'); ?></legend>
			<?php echo $this->Form->input('name',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('description',array('placeholder'=>'','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
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
<?php echo $this->Form->create('Form',array('action'=>'create','parent-model'=>'FormType'));?>
<div id="Modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Modal</h3>
	</div>
	<div class="modal-body">
		<div class="well" id="Notification">
		
		</div>
	</div>
	<div class="modal-footer">
		<div class="btn-group">
			<button class="btn" type="submit">Create Form</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Back</button>
		</div>
	</div>
</div>
<?php echo $this->Form->end();?>
<!--End-->
<?php 
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>