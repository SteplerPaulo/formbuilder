<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name keyHeaders">
							
							 <?php echo $this->Html->link( 'Key Headers',
														array('action' => 'index')
													);  ?>							</div>
						</div>
					</div>
					<div class="span3">
					<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-list-alt icon-white')).
														$this->Html->tag('span', ' Key List', array('class' => 'action-label')),
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
<div class="span6 offset3">

	<?php echo $this->Form->create('KeyHeader',array(
													'action'=>'add',
													'class'=>'form-horizontal',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>
		<fieldset>
			<legend><?php __('Generate Key(s)'); ?></legend>
				<?php echo $this->Form->input('form_id',array('options'=>$forms,'empty'=>'Select','required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span12'));?>
				<span style="display:none" id="EvaluateeInputWrapper">
				<?php echo $this->Form->input('evaluatee_id',array('options'=>$evaluatees,'empty'=>'Select','required'=>'required','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span12'));?>
				</span>
				<?php echo $this->Form->input('intent_key_count',array('required'=>'required','maxlength'=>2,'between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span12 numeric'));?>
		</fieldset>

		<div class="control-group">
			<div class="controls pull-right">
			<?php echo $this->Form->button('Go',array('type'=>'button','id'=>'GoEncryptButton','class'=>'btn btn-primary'));?>
			</div>
		</div>
		<hr/>
		<table class="table table-bordered " id="GeneratedKeyTable">
			<thead>
				<th class="w10"></th>
				<th class="w40"><a>Key</a></th>
				<th class="w10"></th>
				<th class="w40"><a>Key</a></th>
			</thead>
			<tbody>
			
			</tbody>
			<tfoot>
				<td colspan="4"></td>
			</tfoot>
		</table>
		<div class="pull-right">
			<?php echo $this->Form->button('Save',array('type'=>'button','class'=>'btn btn-primary','id'=>'Submit'));?>
			<?php echo $this->Form->button('Cancel',array('type'=>'reset','class'=>'btn'));?>
		</div>
		<div id="Notification">
			
		</div>

	<?php echo $this->Form->end();?>
	</div>
</div>

<?php 
	echo $this->Html->script(array('formbuilder/formkey'),array('inline'=>false));
?>