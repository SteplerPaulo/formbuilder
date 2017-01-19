
<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name periods">
									 <?php echo $this->Html->link( 'Periods',
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
													);  ?>					</div>
					
				</div>
			</div>
			<div class="span3 pull-right">
				 <div id="simple-root"></div> 
			</div>
		</div>
	</div>
 </div>
<div class="sub-content-container">
	<div class="row-fluid">
		<div class="w90 center">
				<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable" id="PeriodTable" model="Period">
			<thead>
				<tr>
																											<th class="w10 text-center"><a >Name</a></th>
																						<th class="w10 text-center"><a >Period Alias</a></th>
																						<th class="w10 text-center"><a >Type</a></th>
																																						<th class="actions w5"><a >Actions</a></th>
				</tr>
			</thead>
			<tbody>
				<tr>
		<td><span data-field='Period.name'></span></td>
		<td><span data-field='Period.period_alias'></span></td>
		<td><span data-field='Period.type'></span></td>
		<td class="actions">
					<div class="btn-group">
						<div class="btn-group btn-center">
							<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
							<ul class="dropdown-menu">
									
											 <li><a href="#intent-modal" data-toggle="modal"  class="action-view view-evaluations"><i class="icon-eye-open"></i> Evaluations</a></li>
																	 
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
</div>

<?php echo $this->Form->create('Period',array('name'=>'modalForm','action'=>'add','class'=>'form-horizontal', 'model'=> 'periods', 'canvas'=>'#PeriodCanvasForm',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>

<div id="intent-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="intent-label" aria-hidden="true">
  <div class="modal-header">
     <h3 id="intent-label"><span class="intent-text">Create </span><span class="intent-object">Period</span></h3>
  </div>
  <div class="modal-body">
  

<div class="row-fluid">
<div class="periods form span12">

		<?php echo $this->Form->input('id',array('placeholder'=>'Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('name',array('placeholder'=>'Name','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('period_alias',array('placeholder'=>'Period Alias','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('type',array('placeholder'=>'Type','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed RECORD tablesorter canvasTable" id="EvaluationTable" model="Evaluation">
				<caption class="caption-bordered">Evaluations</caption>
				<thead>
				<tr>
						<th><?php __('Form Id'); ?></th>
		<th><?php __('Key Id'); ?></th>
		<th><?php __('Evaluatee Id'); ?></th>
		<th><?php __('Evaluator'); ?></th>
		<th><?php __('Evaluator Type Id'); ?></th>
		<th><?php __('School Year Id'); ?></th>
		<th><?php __('Period Id'); ?></th>
					<th class="actions">Actions</th>
				</tr>
				</thead>
				<tbody class="hide">
					<tr>
								<td><span data-field='Evaluation.form_id'></span></td>
		<td><span data-field='Evaluation.key_id'></span></td>
		<td><span data-field='Evaluation.evaluatee_id'></span></td>
		<td><span data-field='Evaluation.evaluator'></span></td>
		<td><span data-field='Evaluation.evaluator_type_id'></span></td>
		<td><span data-field='Evaluation.school_year_id'></span></td>
		<td><span data-field='Evaluation.period_id'></span></td>
						<td>
						<div class="btn-group">
							<div class="btn-group btn-center">
								<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
								<ul class="dropdown-menu">
									  <li><a  href="#evaluations-modal" data-toggle="modal" data-dismiss="modal" class="action-add"><i class="icon-plus"></i> Add</a></li>
									 <li><a  href="#evaluations-modal" data-toggle="modal" data-dismiss="modal" class="action-edit"><i class="icon-edit"></i> Edit</a></li>
									 <li><a href="#" class="action-delete"><i class="icon-remove"></i> Delete</a></li>
								</ul>
							</div>
						</div>
						</td>
					</tr>
				</tbody>
					
				<tfoot>
					<tr class="no-details">
						<td colspan="9">
							<div class="well text-center">
								<button class="btn  btn-medium"  id="add-evaluations" href="#evaluations-modal" data-toggle="modal" data-dismiss="modal"><i class="icon-plus"></i> Evaluations</button>
								<div class="muted">No Evaluations found, click to add.</div>
							</div>
						</td>
					</tr>
				</tfoot>
			</table>
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
<?php echo $this->Form->create('Period',array('action'=>'index',
															'class'=>'canvasForm',
															'id'=>'PeriodCanvasForm',
															'model'=> 'Period',
															'canvas'=>'#PeriodTable'
														)
											);?>
<?php echo $this->Form->end();?>

	<?php echo $this->Form->create('Evaluation',array('name'=>'EvaluationModal','action'=>'add','class'=>'form-horizontal', 'model'=> 'evaluations', 'canvas'=>'#EvaluationCanvasForm',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>

		<div id="evaluations-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="intent-label" aria-hidden="true">
			<div class="modal-header">
				<h3 id="intent-label"><span class="intent-text">Create </span><span class="intent-object">Evaluation</span></h3>
			</div>
			<div class="modal-body">
  
				<div class="row-fluid">
					<div class="evaluations form span12">
					
							<?php echo $this->Form->input('id',array('placeholder'=>'Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('form_id',array('placeholder'=>'Form Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('key_id',array('placeholder'=>'Key Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('evaluatee_id',array('placeholder'=>'Evaluatee Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('evaluator',array('placeholder'=>'Evaluator','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('evaluator_type_id',array('placeholder'=>'Evaluator Type Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('school_year_id',array('placeholder'=>'School Year Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('period_id',array('placeholder'=>'Period Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
					</div>		
				</div>
			</div>
			 <div class="modal-footer">
				<button class="btn btn-primary intent-save" type="submit">Save</button>
				<button class="btn intent-cancel" data-dismiss="modal" aria-hidden="true" type="submit">Cancel</button>
			 </div>
		</div>
<?php echo $this->Form->end();?>
<?php echo $this->Form->create('Evaluation',array('action'=>'index',
															'class'=>'canvasForm',
															'id'=>'EvaluationCanvasForm',
															'model'=> 'Evaluation',
															'canvas'=>'#EvaluationTable'
														)
											);?>
<?php $this->Form->input('period_id',array('type'=>'hidden','value'=>null,'role'=>'foreign-key')); ?>
<?php echo $this->Form->end();?>

<?php echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));?>