<style>
	.dropdown-menu li a{
		padding-left: 31px !important;
	}
	.dropdown-menu li i{
		padding-left: 9px !important;
	}
</style>

<? 
	$_URI = explode("/",$_SERVER['REQUEST_URI']);
	$_PROJECTNAME = '/'.$_URI[1];
?>
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
					<div class="span3 upAccount">
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-chevron-left')).
													$this->Html->tag('span', 'BACK', array('class' => 'action-label')),
													'/pages/apps',array('escape' => false,'class'=>'btn btn-medium tree-back btn-block animate' ,'id'=>'intent-back')
													); ?> 					
					</div>
					<div class="span3">
					<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate' ,'id'=>'')
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

	<div class="w90 center">
		<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable advancedTable" id="FormTable" model="Form">
			<thead>
				<tr>
					<th class="w5 text-center"><a >Id</a></th>
					<th class="w30 text-center"><a >Title</a></th>
					<th class="w45 text-center"><a >Description</a></th>
					<th class="w5 text-center"><a >Questions Count</a></th>
					<th class="w10 text-center"><a >Type</a></th>
					<th class="actions w5"><a >Actions</a></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><span data-field="Form.id" class="form-id"></span></td>
					<td><span data-field='Form.title'></span></td>
					<td><span data-field='Form.description'></span></td>
					<td class="text-center"><span data-field='QuestionCount.count'></span></td>
					<td><span data-field='FormType.name'></span></td>
					<td class="actions">
						<div class="btn-group">
							<div class="btn-group btn-center">
								<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
									<li>
										<i class="icon-eye-open"></i><b> VIEW</b>
										<a action='<? echo $_PROJECTNAME;?>/forms/view' class="form-builder-action">Form</a>
										<a action='<? echo $_PROJECTNAME;?>/forms/questions_list' class="form-builder-action">Form Questions</a>
									</li>
									<li>
										<i class="icon-plus-sign"></i><b> ADD</b>
										<a action="<? echo $_PROJECTNAME;?>/domains/create" class="form-builder-action">Form Domain</a>
										<a action="<? echo $_PROJECTNAME;?>/questions/create" class="form-builder-action">Form Questions</a>
									</li>
									<li>
										<i class="icon-pencil"></i><b> EDIT</b>
										<a action="<? echo $_PROJECTNAME;?>/forms/edit" class="form-builder-action">Form</a>
										<a action="<? echo $_PROJECTNAME;?>/questions/" class="form-builder-action">Form Questions</a>
									</li>		
									<li>
										<i class="icon-remove"></i><b> Delete</b>
										<a action="<? echo $_PROJECTNAME;?>/forms/delete" class="form-builder-action">Form</a>
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
<?php echo $this->Form->create('FormAction',array('id'=>'FormAction','target'=>'_blank'));?>
	<? echo $this->Form->input('Form.id',array('id'=>'FormId'));?>
<?php echo $this->Form->end();?>

<?php 
	echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>