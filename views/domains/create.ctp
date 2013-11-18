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
				</div>
			</div>
		</div>
	</div>
 </div>

<div class="row-fluid">
	<div class="domains form span8 offset2">	
		<?php echo $this->Form->create('Domain',array(		
						'action'=>'add','class'=>'form-horizontal',
						'inputDefaults' => array('label'=>array('class'=>'control-label'),'div'=>array('class'=>'control-group')
					)));?>
		<fieldset>
			<legend><center><?php echo __('Add Domain').' for <br/>'. $forms['Form']['title']; ?></center></legend>
			<?php echo $this->Form->input('Form.id',array('type'=>'text','between'=>'<div class="controls">','after'=>'</div>'));?>
			<?php echo $this->Form->input('name',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('description',array('placeholder'=>'','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		</fieldset>
		<div class="control-group">
			<div class="controls">
			<?php echo $this->Form->button('Save',array('type'=>'button','class'=>'btn btn-primary fb-create-save-button'));?>
			<?php echo $this->Form->button('Cancel',array('type'=>'button','class'=>'btn'));?>
			</div>
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>

<!--Action & Notification Modal-->
<?php echo $this->Form->create('Question',array('parent-model'=>'Domain'));?>
<div id="Modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-text="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-text="true">×</button>
		<h3 id="myModalLabel">Modal</h3>
	</div>
	<div class="modal-body">
		<?php echo $this->Form->input('Form.id',array('id'=>'FormId','label'=>'Form Id','type'=>'hidden','class'=>'span11'));?>
		<?php echo $this->Form->input('Domain.id',array('id'=>'DomainId','label'=>'Domain Id','type'=>'hidden','class'=>'span11'));?>

		<div class="well" id="Notification">
		
		</div>
	</div>
	
	<div class="modal-footer">
		<div class="btn-group">
			<button class="btn fb-goto-worksheet-button" type="button">Go To Worksheet</button>
			<button class="btn" data-dismiss="modal" aria-text="true">Exit</button>
		</div>
	</div>
</div>
<?php echo $this->Form->end();?>
<!--End-->

<!--FORMACTION-->
<?php echo $this->Form->create('Form',array('id'=>'FormAction'));?>
	<? echo $this->Form->input('Form.id',array('id'=>'FormId','type'=>'hidden'));?>
	<? echo $this->Form->input('object_id',array('id'=>'ObjectId','type'=>'hidden'));?>
<?php echo $this->Form->end();?>


<?php 
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>