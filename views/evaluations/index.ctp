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
	<div class="row-fluid">
		<div class="w90 center">
			<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable advancedTable" id="EvaluationTable" model="Evaluation">
				<thead>
					<tr>
						<th class="hide"><a >Form ID</a></th>
						<th class="hide"><a >Evaluatee ID</a></th>
						<th class="hide"><a >School Year ID</a></th>
						<th class="hide"><a >Period ID</a></th>
						<th class="hide"><a >Educ Level ID</a></th>
						<th class="w10 text-center"><a >School Year</a></th>
						<th class="w35 text-center"><a >Form Title</a></th>
						<th class="w10 text-center"><a >Period</a></th>
						<th class="w10 text-center"><a >Educ Level</a></th>
						<th class="w30 text-center"><a >Evaluatee</a></th>
						<th class="actions w5"><a >Actions</a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="hide"><span data-field="Form.id" class="form-id"></span></td>
						<td class="hide"><span data-field='Evaluation.evaluatee_id' class="evaluatee_id"></span></td>
						<td class="hide"><span data-field='SchoolYear.id' class="school_year_id"></span></td>
						<td class="hide"><span data-field='Period.id' class="period_id"></span></td>
						<td class="hide"><span data-field='EducLevel.id' class="educ_level_id"></span></td>
						<td><span data-field='SchoolYear.name' class="school_year"></span></td>
						<td><span data-field='Form.title'></span></td>
						<td><span data-field='Period.name' class="period"></span></td>
						<td><span data-field='EducLevel.name' class="educ_level"></span></td>
						<td><span data-field='Evaluatee.name' class="evaluatee"></span></td>
						<td class="actions">
							<div class="btn-group">
								<div class="btn-group btn-center">
									<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a target="_blank" action="/formbuilder/evaluations/result" class="fe-result">
												<i class="icon-eye-open"></i> View Result
											</a>
										</li>
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

<!--FORMACTION-->
<?php echo $this->Form->create('Evaluation',array('id'=>'EvaluationResult'));?>
	<?php echo $this->Form->input('Evaluation.form_id',array('id'=>'EvaluationFormId','type'=>'hidden'));?>
	<?php echo $this->Form->input('Evaluation.evaluatee_id',array('id'=>'EvaluationEvaluateeId','type'=>'hidden'));?>
	<?php echo $this->Form->input('Evaluation.evaluatee',array('id'=>'EvaluationEvaluatee','type'=>'hidden'));?>
	<?php echo $this->Form->input('Evaluation.school_year_id',array('id'=>'EvaluationSchoolYearId','type'=>'hidden'));?>
	<?php echo $this->Form->input('Evaluation.school_year',array('id'=>'EvaluationSchoolYear','type'=>'hidden'));?>
	<?php echo $this->Form->input('Evaluation.period_id',array('id'=>'EvaluationPeriodId','type'=>'hidden'));?>
	<?php echo $this->Form->input('Evaluation.period',array('id'=>'EvaluationPeriod','type'=>'hidden'));?>
	<?php echo $this->Form->input('Evaluation.educ_level_id',array('id'=>'EvaluationEducLevelID','type'=>'hidden'));?>
	<?php echo $this->Form->input('Evaluation.educ_level',array('id'=>'EvaluationEducLevel','type'=>'hidden'));?>
<?php echo $this->Form->end();?>


<?php echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));?>
<?php echo $this->Html->script(array('formbuilder/formevaluation'),array('inline'=>false)); ?>