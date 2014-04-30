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
		<div class="span3 pull-right">
			<div id="simple-root"></div> 
			<div class="btn-group pull-right">
				<?php echo $access->isLoggedIn() ? '<button class="btn" disabled="disabled"><i class="icon-user"></i> '.ucfirst($access->getmy('username')).'</button>': ''; ?>
				<?php echo $access->isLoggedIn() ? '<button class="btn">'.$this->Html->link( $this->Html->tag('span', 'Logout'),'/users/logout',array('escape' => false)).'</button>' : '<button class="btn">'.$this->Html->link( $this->Html->tag('span', 'Login'),'/users/login',array('escape' => false)).'</button>'; ?>
			</div>
		</div>
	</div>
 </div>

<div class="row-fluid">
	<div class="forms form span6 offset3">
	<?php echo $this->Form->create('Form',array(	'class'=>'form-horizontal',
																		'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																									'div'=>array('class'=>'control-group')
																								)
																		)
												);?>
		<fieldset>
			<legend><?php __('Add Form'); ?></legend>
			<?php echo $this->Form->input('title',array('placeholder'=>'','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('description',array('placeholder'=>'','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<?php echo $this->Form->input('form_type_id',array('placeholder'=>'','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
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
<!--FORMACTION-->
<?php echo $this->Form->create('FormAction',array('id'=>'FormAction'));?>
<?php echo $this->Form->end();?>

<?php 
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>