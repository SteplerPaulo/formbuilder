<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span3 module">
						<div class="module-wrap">
							<div class="module-name options">
							<?php echo $this->Html->link( 'Options',
														array('action' => 'index')
													);  ?>							
							</div>
						</div>
					</div>
					<div class="btn-group span5">
						<button class="btn fb-goto-worksheet-button">
							<i class="icon-circle-arrow-left"></i> Go Back To Worksheet
						</button>
					</div>
					<div class="btn-group span4">
						<a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cog"></i> <span class="action-label">Option Setting</span>	
						</a>
						<ul class="dropdown-menu">
							<li>
								<a class="fb-option-setting" action="/formbuilder/options/create" option-cog="exclusive" > Exclusive Type</a>
								<a class="fb-option-setting" action="/formbuilder/options/create" option-cog="multiple"> Shared Type</a>
							</li>
						</ul>
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
	<div class="options form span8 offset2">
	<?php echo $this->Form->input('Question.id',array('value'=>$q['Question']['id'],'type'=>'hidden','label'=>'Question Id'));?>
			
	<?php echo $this->Form->create('Option',array(	'action'=>'add',
													'class'=>'form-horizontal',
														'inputDefaults' => array( 	
															'label'=>array(
																'class'=>'control-label'),
																'div'=>array('class'=>'control-group')
															)
										));?>								
		<fieldset>
			<legend><?php echo __('Add Option'); ?></legend>
			
			
			<?php 
				if(isset($questions)){
					echo $this->Form->input('Question',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>','class'=>'span11'));
				}else{
					echo $this->Form->input('Question',array('value'=>$q['Question']['id'],'type'=>'hidden','between'=>'<div class="controls">','after'=>'</div>','class'=>'span11'));
					echo $this->Form->input('Question.text',array('value'=>$q['Question']['text'],'readonly'=>'readonly','between'=>'<div class="controls">','after'=>'</div>','class'=>'span11'));
				}
			?>
			
			
			<?php echo $this->Form->input('text',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('value',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11 numeric'));?>
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

		<div class="well" id="Notification">
		
		</div>
	</div>
	<div class="modal-footer">
		<div class="btn-group">
			<button class="btn fb-goto-worksheet-button" type="button">Go to Worksheet</button>
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
	<?php echo $this->Form->input('option_cog',array('id'=>'OptionCog','type'=>'hidden'));?>
<?php echo $this->Form->end();?>


<?php
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>