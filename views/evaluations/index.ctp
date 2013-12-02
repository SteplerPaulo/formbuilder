
<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name evaluations">
									 <?php echo $this->Html->link( 'Evaluations',
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
				<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable" id="EvaluationTable" model="Evaluation">
			<thead>
				<tr>
																											<th class="w10 text-center"><a >Form Id</a></th>
																						<th class="w10 text-center"><a >Evaluatee</a></th>
																						<th class="w10 text-center"><a >Evaluator</a></th>
																						<th class="w10 text-center"><a >Create</a></th>
																<th class="actions w5"><a >Actions</a></th>
				</tr>
			</thead>
			<tbody>
				<tr>
		<td>
			<span data-field='Form.title'></span></td>
		<td><span data-field='Evaluation.evaluatee'></span></td>
		<td><span data-field='Evaluation.evaluator'></span></td>
		<td><span data-field='Evaluation.create'></span></td>
		<td class="actions">
					<div class="btn-group">
						<div class="btn-group btn-center">
							<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
							<ul class="dropdown-menu">
									
											 <li><a href="#intent-modal" data-toggle="modal"  class="action-view view-forms"><i class="icon-eye-open"></i> Forms</a></li>
											
											 <li><a href="#intent-modal" data-toggle="modal"  class="action-view view-evaluation_details"><i class="icon-eye-open"></i> Evaluation Details</a></li>
																	 
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

<?php echo $this->Form->create('Evaluation',array('name'=>'modalForm','action'=>'add','class'=>'form-horizontal', 'model'=> 'evaluations', 'canvas'=>'#EvaluationCanvasForm',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>

<div id="intent-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="intent-label" aria-hidden="true">
  <div class="modal-header">
     <h3 id="intent-label"><span class="intent-text">Create </span><span class="intent-object">Evaluation</span></h3>
  </div>
  <div class="modal-body">
  

<div class="row-fluid">
<div class="evaluations form span12">

		<?php echo $this->Form->input('id',array('placeholder'=>'Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('form_id',array('placeholder'=>'Form Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('evaluatee',array('placeholder'=>'Evaluatee','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('evaluator',array('placeholder'=>'Evaluator','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('create',array('placeholder'=>'Create','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
			<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed RECORD tablesorter canvasTable" id="EvaluationDetailTable" model="EvaluationDetail">
				<caption class="caption-bordered">Evaluation Details</caption>
				<thead>
				<tr>
						<th><?php __('Evaluation Id'); ?></th>
		<th><?php __('Question Id'); ?></th>
		<th><?php __('Option Id'); ?></th>
					<th class="actions">Actions</th>
				</tr>
				</thead>
				<tbody class="hide">
					<tr>
								<td><span data-field='EvaluationDetail.evaluation_id'></span></td>
		<td><span data-field='EvaluationDetail.question_id'></span></td>
		<td><span data-field='EvaluationDetail.option_id'></span></td>
						<td>
						<div class="btn-group">
							<div class="btn-group btn-center">
								<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
								<ul class="dropdown-menu">
									  <li><a  href="#evaluation-details-modal" data-toggle="modal" data-dismiss="modal" class="action-add"><i class="icon-plus"></i> Add</a></li>
									 <li><a  href="#evaluation-details-modal" data-toggle="modal" data-dismiss="modal" class="action-edit"><i class="icon-edit"></i> Edit</a></li>
									 <li><a href="#" class="action-delete"><i class="icon-remove"></i> Delete</a></li>
								</ul>
							</div>
						</div>
						</td>
					</tr>
				</tbody>
					
				<tfoot>
					<tr class="no-details">
						<td colspan="4">
							<div class="well text-center">
								<button class="btn  btn-medium"  id="add-evaluation-details" href="#evaluation-details-modal" data-toggle="modal" data-dismiss="modal"><i class="icon-plus"></i> Evaluation Details</button>
								<div class="muted">No Evaluation Details found, click to add.</div>
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
<?php echo $this->Form->create('Evaluation',array('action'=>'index',
															'class'=>'canvasForm',
															'id'=>'EvaluationCanvasForm',
															'model'=> 'Evaluation',
															'canvas'=>'#EvaluationTable'
														)
											);?>
<?php echo $this->Form->end();?>

	<?php echo $this->Form->create('EvaluationDetail',array('name'=>'EvaluationDetailModal','action'=>'add','class'=>'form-horizontal', 'model'=> 'evaluationDetails', 'canvas'=>'#EvaluationDetailCanvasForm',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>

		<div id="evaluation-details-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="intent-label" aria-hidden="true">
			<div class="modal-header">
				<h3 id="intent-label"><span class="intent-text">Create </span><span class="intent-object">EvaluationDetail</span></h3>
			</div>
			<div class="modal-body">
  
				<div class="row-fluid">
					<div class="evaluationDetails form span12">
					
							<?php echo $this->Form->input('id',array('placeholder'=>'Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('evaluation_id',array('placeholder'=>'Evaluation Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('question_id',array('placeholder'=>'Question Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
		<?php echo $this->Form->input('option_id',array('placeholder'=>'Option Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
					</div>		
				</div>
			</div>
			 <div class="modal-footer">
				<button class="btn btn-primary intent-save" type="submit">Save</button>
				<button class="btn intent-cancel" data-dismiss="modal" aria-hidden="true" type="submit">Cancel</button>
			 </div>
		</div>
<?php echo $this->Form->end();?>
<?php echo $this->Form->create('EvaluationDetail',array('action'=>'index',
															'class'=>'canvasForm',
															'id'=>'EvaluationDetailCanvasForm',
															'model'=> 'EvaluationDetail',
															'canvas'=>'#EvaluationDetailTable'
														)
											);?>
<?php $this->Form->input('evaluation_id',array('type'=>'hidden','value'=>null,'role'=>'foreign-key')); ?>
<?php echo $this->Form->end();?>

<?php echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));?>