<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name keyHeaders">
									 <?php echo $this->Html->link( 'Key Headers',
															'javascript:void()'
														);  ?>								
							</div>
						</div>
					</div>
					<div class="span3">
					<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'generate_keys'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate' ,'id'=>'')
													);  ?>					
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
			<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable advancedTable" id="KeyHeaderTable" model="KeyHeader">
				<thead>
					<tr>
						<th class="hide"><a >Key Header Id</a></th>
						<th class="w70 text-center"><a >Form Title</a></th>	 
						<th class="w10 text-center"><a >Key Count</a></th>	
						<th class="w15 text-center"><a >Date Created</a></th>	 
						<th class="actions w5"><a >Actions</a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="hide"><span data-field="KeyHeader.id" class="keyheader-id"></span></td>
						<td><span data-field="Form.title"></span></td>
						<td  class="text-center"><span data-field="Key.count"></span></td>
						<td><span data-field="KeyHeader.created"></span></td>
						<td class="actions">
							<div class="btn-group">
								<div class="btn-group btn-center">
									<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
									<ul class="dropdown-menu pull-right">	
										<li>
											<a action='/formbuilder/key_headers/view' class="fb-action">
												<i class="icon-eye-open"></i> View
											</a>
										</li>
										<li>
											<a action='/formbuilder/key_headers/print_keys' class="fb-action" newtab="_blank">
												<i class="icon-print"></i> Print
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
<?php echo $this->Form->create('KeyHeader',array('action'=>'index.json',
															'class'=>'canvasForm',
															'id'=>'KeyHeaderCanvasForm',
															'model'=> 'KeyHeader',
															'canvas'=>'#KeyHeaderTable'
														)
											);?>
<?php echo $this->Form->end();?>

<!--FORMACTION-->
<?php echo $this->Form->create('KeyHeaderAction',array('id'=>'KeyHeaderAction'));?>
	<? echo $this->Form->input('KeyHeader.id',array('id'=>'KeyHeader'));?>
<?php echo $this->Form->end();?>

<?php 
	echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));
	echo $this->Html->script(array('formbuilder/formkey'),array('inline'=>false));
?>