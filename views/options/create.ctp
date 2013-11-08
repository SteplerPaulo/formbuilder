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
													);  ?>							</div>
						</div>
					</div>
					<div class="btn-group span3">
					  <a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown" href="#">
						<i class=" icon-th-list"></i><span class="action-label">LINKS</span>	
					  </a>
					  <ul class="dropdown-menu">
						<!-- dropdown menu links -->
								<li><?php echo $this->Html->link(__('Questions', true), array('controller' => 'questions', 'action' => 'index')); ?> </li>
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
		<legend><center><?php echo __('Add Option').' for <br/>'. $question['Question']['content']; ?></center></legend>

		<?php echo $this->Form->input('Question',array('value'=>$question['Question']['id'],'type'=>'text','between'=>'<div class="controls">','after'=>'</div>'));?>
	
		<?php echo $this->Form->input('text',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('value',array('required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('is_correct',array('placeholder'=>'','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
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