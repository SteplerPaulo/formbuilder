<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name quizzes">
									 <?php echo $this->Html->link( 'Quizzes',
															'javascript:void()'
														);  ?>								
							</div>
						</div>
					</div>
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
			<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable advancedTable" id="QuizTable" model="Quiz">
				<thead>
				<tr>
					<th class="w10 text-center"><a >Form Id</a></th>
					<th class="w10 text-center"><a >Key Id</a></th>
					<th class="w10 text-center"><a >Evaluatee</a></th>
					<th class="w10 text-center"><a >Evaluator</a></th>
					<th class="actions w5"><a >Actions</a></th>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td><span data-field='Form.title'></span></td>
						<td><span data-field='Key.id'></span></td>
						<td><span data-field='Quiz.evaluatee'></span></td>
						<td><span data-field='Quiz.evaluator'></span></td>
						<td class="actions">
							<div class="btn-group">
								<div class="btn-group btn-center">
									<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li><a href="#intent-modal" data-toggle="modal"  class="action-view view-forms"><i class="icon-eye-open"></i> Forms</a></li>
										<li><a href="#intent-modal" data-toggle="modal"  class="action-view view-keys"><i class="icon-eye-open"></i> Keys</a></li>
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

<?php echo $this->Form->create('Quiz',array('name'=>'modalForm','action'=>'add','class'=>'form-horizontal', 'model'=> 'quizzes', 'canvas'=>'#QuizCanvasForm',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>

<div id="intent-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="intent-label" aria-hidden="true">
	<div class="modal-header">
		<h3 id="intent-label"><span class="intent-text">Create </span><span class="intent-object">Quiz</span></h3>
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="quizzes form span12">
				<?php echo $this->Form->input('id',array('placeholder'=>'Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
				<?php echo $this->Form->input('form_id',array('placeholder'=>'Form Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
				<?php echo $this->Form->input('key_id',array('placeholder'=>'Key Id','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
				<?php echo $this->Form->input('evaluatee',array('placeholder'=>'Evaluatee','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
				<?php echo $this->Form->input('evaluator',array('placeholder'=>'Evaluator','between'=>'<div class="controls">','after'=>'</div>' ,'class'=>'span11'));?>
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
<?php echo $this->Form->create('Quiz',array('action'=>'index.json',
															'class'=>'canvasForm',
															'id'=>'QuizCanvasForm',
															'model'=> 'Quiz',
															'canvas'=>'#QuizTable'
														)
											);?>
<?php echo $this->Form->end();?>


<?php echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));?>