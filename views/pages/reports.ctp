<?php $print_type = array('1'=>'Batch'/*,'1'=>'Individual'*/) ;?>
<?php $sy = array('2013'=>'2013-2014') ;?>
<?php $forms = array('SR'=>'Sales Report') ;?>
<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name receivingReports">
									 <?php echo $this->Html->link( 'Reports',
															'javascript:void()'
														);  ?>								
							</div>
						</div>
					</div>
					<div class="span3">
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
	<!--
	<div class="w95 center">
		<table class="table table-striped table-condensed table-hover table-bordered tablesorter display" id="TableName">
			<thead>
				<tr role='row'>
					<th class=""><a>Field Name 1</a></th>
					<th class=""><a>Field Name 2</a></th>
				</tr>
			</thead>
			<tbody >		
		
			</tbody>
		</table>
	</div>
	-->

	<!-- Modal -->
	<div id="intent-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header ">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
			<h3 id="myModalLabel">Reports</h3>
		</div>
		<div class="modal-body minHeight250px">
			<h5 class="modal-section-header">Generate Report</h5>
			<div class="row-fluid">
				<?php echo $this->Form->input('Type',array('options'=>$print_type,'class'=>'span2','div'=>false));?>
				<?php echo $this->Form->input('sy',array('options'=>$sy,'label'=>'SY','class'=>'span2','div'=>false));?>
			</div>
			
			<div class="row-fluid">
				<?php echo $this->Form->input('report_form',array('options'=>$forms,'class'=>'span2','div'=>false));?>
				<?php echo $this->Form->input('student_name',array('type'=>'hidden','class'=>'span4','div'=>false));?>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary intent-print" type="button">Preview</button>
			<button class="btn intent-cancel" data-dismiss="modal" aria-hidden="true" type="button">Cancel</button>
		</div>
	</div>
	<?php echo $this->Form->create('IssueOut',array('id'=>'SalesReport','action'=>'sales_report','target'=>'_blank'));?>
		<?php echo $this->Form->input('user_name',array('id'=>'UserFullName','type'=>'hidden'));?>
	<?php echo $this->Form->end();?>

</div>
<?php
	echo $this->Html->script(array('biz/reports'),array('inline'=>false));
?>
