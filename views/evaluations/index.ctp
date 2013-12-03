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
			<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable advancedTable" id="EvaluationTable" model="Evaluation">
				<thead>
					<tr>
						<th class="w35 text-center"><a >Form Title</a></th>
						<th class="w20 text-center"><a >Evaluatee</a></th>
						<th class="w20 text-center"><a >Evaluator</a></th>
						<th class="w20 text-center"><a >Create</a></th>
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
									<ul class="dropdown-menu pull-right">
										<li><a href="#intent-modal" data-toggle="modal"  class="action-view view-forms"><i class="icon-eye-open"></i> Details</a></li>
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

<!-- CANVASFORM -->
<?php echo $this->Form->create('Evaluation',array('action'=>'index.json',
															'class'=>'canvasForm',
															'id'=>'EvaluationCanvasForm',
															'model'=> 'Evaluation',
															'canvas'=>'#EvaluationTable'
														)
											);?>
<?php echo $this->Form->end();?>


<?php echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));?>