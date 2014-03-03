<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name electionReports">
									 <?php echo $this->Html->link( 'Election Reports',
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
			<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable advancedTable" id="ElectionReportTable" model="ElectionReport">
				<thead>
					<tr>
						<th class="hide"><a >Form Id</a></th>
						<th class="w95 text-center"><a >Form Title</a></th>
						<th class="actions w5"><a >Actions</a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="hide"><span data-field='Form.id' class="form-id"></span></td>
						<td><span data-field='Form.title'></span></td>
						<td class="actions">
							<div class="btn-group">
								<div class="btn-group btn-center">
									<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a action="/formbuilder/election_reports/result" class="fer-result">
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
<?php echo $this->Form->create('ElectionReport',array('action'=>'index.json',
															'class'=>'canvasForm',
															'id'=>'ElectionReportCanvasForm',
															'model'=> 'ElectionReport',
															'canvas'=>'#ElectionReportTable'
														)
											);?>
<?php echo $this->Form->end();?>

<!--FORMACTION-->
<?php echo $this->Form->create('ElectionReport',array('id'=>'ElectionReportResult'));?>
	<? echo $this->Form->input('ElectionReport.form_id',array('id'=>'ElectionReportFormId','type'=>'hidden'));?>
<?php echo $this->Form->end();?>

<?php echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));?>
<?php echo $this->Html->script(array('formbuilder/formelectionreport'),array('inline'=>false));?>