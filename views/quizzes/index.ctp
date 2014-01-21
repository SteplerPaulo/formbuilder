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
					<th class="text-center hide"><a >Form Id</a></th>	
					<th class="w40 text-center"class="examinee"><a >Examinee</a></th>
					<th class="w40 text-center"><a >Form Title</a></th>
					<th class="w15 text-center"><a >Date</a></th>
					<th class="actions w5"><a >Actions</a></th>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td class="hide"><span data-field='Form.id' class="form-id"></span></td>
						<td><span data-field='Quiz.examinee' class="examinee"></span></td>
						<td><span data-field='Form.title'></span></td>
						<td><span data-field='Quiz.created'></span></td>
						<td class="actions">
							<div class="btn-group">
								<div class="btn-group btn-center">
									<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a action="/formbuilder/quizzes/result" class="fq-result">
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
<?php echo $this->Form->create('Quiz',array('action'=>'index.json',
															'class'=>'canvasForm',
															'id'=>'QuizCanvasForm',
															'model'=> 'Quiz',
															'canvas'=>'#QuizTable'
														)
											);?>
<?php echo $this->Form->end();?>

<!--FORMACTION-->
<?php echo $this->Form->create('Quiz',array('id'=>'QuizResult'));?>
	<? echo $this->Form->input('Quiz.form_id',array('id'=>'QuizFormId','type'=>'hidden'));?>
	<? echo $this->Form->input('Quiz.examinee',array('id'=>'QuizExaminee','type'=>'hidden'));?>
<?php echo $this->Form->end();?>


<?php echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));?>
<?php echo $this->Html->script(array('formbuilder/formquiz'),array('inline'=>false)); ?>