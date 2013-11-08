<?php	
	echo $this->Html->script(array('biz/issue_out'),array('inline'=>false));
?>

<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name accountCharts">
									 <?php echo $this->Html->link( 'Module Name',
															'javascript:void()'
														);  ?>								
							</div>
						</div>
					</div>
					
					<div class="span3">
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-chevron-left')).
														$this->Html->tag('span', 'BACK', array('class' => 'action-label')),
														array('controller'=>'pages','plugin'=>null,'action' => 'apps'), array('escape' => false,'class'=>'btn btn-medium btn-block animate' ,'id'=>'intent-back')
													);  ?>					
					</div>
					<div class="span3">
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														'#myModal', array('escape' => false,'data-toggle'=>'modal','href'=>'#myModal','role'=>'button','class'=>'btn btn-medium btn-primary btn-block animate' ,'id'=>'intent-create')
													);  ?>					
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>


	
	
		
<div class="sub-content-container">

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


	<!-- Modal -->
	<?php echo $this->Form->create('IssueOut',array('action'=>'add','name'=>'modalForm','model'=>'bookstore_inventory/issue_outs'));?>
	<div id="intent-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header ">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
			<h3 id="myModalLabel">Modal Name</h3>
		</div>
		<div class="modal-body minHeight250px">
			

		</div>
		<?php echo $this->Form->end();?>
		<div class="modal-footer">
			<button class="btn btn-primary intent-save save-product" type="button">Save</button>
			<button class="btn intent-cancel" data-dismiss="modal" aria-hidden="true" type="button">Cancel</button>
		</div>
	</div>


