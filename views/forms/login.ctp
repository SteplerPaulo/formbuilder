<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name evaluations">
							<?php echo $this->Html->link( 'Form',
														'javascript:void()'
													);  ?>							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 </div>

<div class="row-fluid">
<div class="evaluations form span6 offset3">
	<?php echo $this->Form->create('Form',array(	
													'action'=>'login',
													'id'=>'FormLogin',
													'class'=>'form-horizontal',
																		'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																									'div'=>array('class'=>'control-group')
																								)
																		)
												);?>
		<fieldset>
			<legend><?php __('Log In'); ?></legend>
			<?php echo $this->Form->input('key',array('required'=>'required','placeholder'=>'INSERT VALID KEY','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		</fieldset>
		<div class="control-group">
			<div class="controls">
			<?php echo $this->Form->button('Log In',array('type'=>'button','class'=>'btn btn-primary','Id'=>'LogInButton'));?>
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
	echo $this->Html->script(array('formbuilder/formlogin'),array('inline'=>false));
?>