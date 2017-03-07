<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name forms">
									 <?php echo $this->Html->link( 'Forms',
															'javascript:void()'
														);  ?>								
							</div>
						</div>
					</div>
					<div class="span3">
					<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'create'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate' ,'id'=>'')
													);  ?>					
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
	<div class="w90 center">
		<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable advancedTable" id="FormTable" model="Form">
			<caption>Forms List</caption>
			<thead>
				<tr>
					<th class="w5 text-center"><a >Id</a></th>
					<th class="w30 text-center"><a >Title</a></th>
					<th class="w45 text-center hide"><a >Description</a></th>
					<th class="w5 text-center hide"><a >Questions Count</a></th>
					<th class="w10 text-center hide"><a >Type</a></th>
					<th class="actions w5"><a >Actions</a></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><span data-field="Form.id" class="form-id"></span></td>
					<td><span data-field='Form.title'></span></td>
					<td class="hide"><span data-field='Form.description'></span></td>
					<td class="text-center hide"><span data-field='QuestionCount.count'></span></td>
					<td class="hide><span data-field='FormType.name'></span></td>
					<td class="actions">
						<div class="btn-group">
							<div class="btn-group btn-center">
								<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
									<li>
										<a action='/formbuilder/forms/view' class="fb-action" newtab='_target'>
											<i class="icon-eye-open"></i> Preview
										</a>
									</li>
									<li>
										<a action="/formbuilder/forms/worksheet" class="fb-action">
											<i class="icon-edit"></i> Worksheet
										</a>
									</li>
									<!--
									<li>
										<a action="/formbuilder/forms/sortable_worksheet" class="fb-action">
											<i class="icon-edit"></i> Sortable Worksheet
										</a>
									</li>		
									<li>
										<a action="/formbuilder/forms/delete" class="fb-action">
											<i class="icon-trash"></i> Delete
										</a>
									</li>-->
								</ul>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<!-- CANVASFORM -->
<?php echo $this->Form->create('Form',array('action'=>'index.json',
															'class'=>'canvasForm',
															'id'=>'FormCanvasForm',
															'model'=> 'Form',
															'canvas'=>'#FormTable'
														)
											);?>
<?php echo $this->Form->end();?>

<!--FORMACTION-->
<?php echo $this->Form->create('FormAction',array('id'=>'FormAction'));?>
	<?php echo $this->Form->input('Form.id',array('id'=>'FormId'));?>
<?php echo $this->Form->end();?>

<?php 
	echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>