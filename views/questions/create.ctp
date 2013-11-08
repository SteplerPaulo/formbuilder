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
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate')
													);  ?>					</div>
					<div class="btn-group span3">
					  <a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown" href="#">
						<i class=" icon-th-list"></i><span class="action-label">LINKS</span>	
					  </a>
					  <ul class="dropdown-menu">
						<li><?php echo $this->Html->link(__('Forms', true), array('controller' => 'forms', 'action' => 'index')); ?> </li>
						<li><?php echo $this->Html->link(__('Question Options', true), array('controller' => 'question_options', 'action' => 'index')); ?> </li>
					  </ul>
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
<div class="questions form span8 offset2">
	<?php echo $this->Form->input('Form.id',array('type'=>'hidden','label'=>'Form Id'));?>
		
	<?php echo $this->Form->create('Question',array('action'=>'add',
													'class'=>'form-horizontal',
													'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
													)
											);?>
	
	<fieldset>
		<legend><center><?php echo __('Add Question').' for <br/>'. $forms['Form']['title'].'<br/> Form' ?></center></legend>

		<?php echo $this->Form->input('form_id',array('value'=>$forms['Form']['id'],'type'=>'text','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('domain_id',array('placeholder'=>'','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('content',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('option_type_id',array('options'=>$option_types,'between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
	</fieldset>
	<div class="control-group">
		<div class="controls">
		<?php echo $this->Form->button('Save',array('type'=>'button','class'=>'btn btn-primary form-builder-save'));?>
		<?php echo $this->Form->button('Cancel',array('type'=>'reset','class'=>'btn'));?>
				
		<div class="notif" style="display:none"></div>

		</div>
	</div>
	
	<?php echo $this->Form->end();?>
</div>
</div>

 


<?php
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>