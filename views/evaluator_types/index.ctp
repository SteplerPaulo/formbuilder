<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name evaluatorTypes">
									 <?php echo $this->Html->link( 'Evaluator Types',
															'javascript:void()'
														);  ?>								
							</div>
						</div>
					</div>
					<div class="span3 upAccount">
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-chevron-left')).
													$this->Html->tag('span', 'BACK', array('class' => 'action-label')),
													'/pages/apps',array('escape' => false,'class'=>'btn btn-medium tree-back btn-block animate' ,'id'=>'intent-back')
													); ?> 					
					</div>
					<div class="span3">
					<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate' ,'id'=>'intent-create')
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
<div class="sub-content-container">
	<div class="w90 center">
		<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable" id="EvaluatorTypeTable" model="EvaluatorType">
			<thead>
				<tr>
					<th class="w10 text-center"><a >Name</a></th>
					<th class="w10 text-center"><a >Alias</a></th>
					<th class="w10 text-center"><a >Description</a></th>
					<th class="actions w5"><a >Actions</a></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><span data-field='EvaluatorType.name'></span></td>
					<td><span data-field='EvaluatorType.alias'></span></td>
					<td><span data-field='EvaluatorType.description'></span></td>
					<td class="actions">
						<div class="btn-group">
							<div class="btn-group btn-center">
								<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="#" class="action-delete"><i class="icon-remove"></i> Delete</a></li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<?php echo $this->Form->create('EvaluatorType',array('name'=>'modalForm','action'=>'add','class'=>'form-horizontal', 'model'=> 'evaluatorTypes', 'canvas'=>'#EvaluatorTypeCanvasForm',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>

<div id="intent-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="intent-label" aria-hidden="true">
	<div class="modal-header">
		<h3 id="intent-label"><span class="intent-text">Create </span><span class="intent-object">Evaluator Type</span></h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="evaluatorTypes form span12">
				<?php echo $this->Form->input('id',array('placeholder'=>'Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
				<?php echo $this->Form->input('name',array('placeholder'=>'Name','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
				<?php echo $this->Form->input('alias',array('placeholder'=>'Alias','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
				<?php echo $this->Form->input('description',array('placeholder'=>'Description','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary intent-save" type="submit">Save</button>
		<button class="btn intent-cancel" data-dismiss="modal" aria-hidden="true" type="submit">Cancel</button>
	</div>
</div>
<?php echo $this->Form->end();?>
<!-- CANVASFORM -->
<?php echo $this->Form->create('EvaluatorType',array('action'=>'index',
															'class'=>'canvasForm',
															'id'=>'EvaluatorTypeCanvasForm',
															'model'=> 'EvaluatorType',
															'canvas'=>'#EvaluatorTypeTable'
														)
											);?>
<?php echo $this->Form->end();?>
<?php echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));?>