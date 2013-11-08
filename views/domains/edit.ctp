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
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate')
													);  ?>					</div>
					<div class="btn-group span3">
					  <a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown" href="#">
						<i class=" icon-th-list"></i><span class="action-label">LINKS</span>	
					  </a>
					  <ul class="dropdown-menu">
						<!-- dropdown menu links -->
								<li><?php echo $this->Html->link(__('Forms', true), array('controller' => 'forms', 'action' => 'index')); ?> </li>
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
		<?php echo $this->Form->input('Form',array('placeholder'=>'Form','between'=>'<div class="controls">','after'=>'</div>'));?>
	</fieldset>
	<div class="control-group">
		<div class="controls">
		<?php echo $this->Form->button('Save',array('type'=>'submit','class'=>'btn btn-primary'));?>
		<?php echo $this->Form->button('Cancel',array('type'=>'reset','class'=>'btn'));?>
		</div>
	</div>
	<?php echo $this->Form->end();?>
</div>
</div>