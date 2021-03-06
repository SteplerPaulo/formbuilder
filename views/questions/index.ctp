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
							<div class="module-name questions">
									 <?php echo $this->Html->link( 'Questions',
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
		<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable " id="QuestionTable" model="Question">
			<thead>
				<tr>
					<th class="w95 text-center"><a>Content</a></th>
					<th class="actions w5"><a>Actions</a></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><span data-field='Question.content'></span></td>
					<td class="actions">
						<div class="btn-group">
							<div class="btn-group btn-center">
								<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
								<ul class="dropdown-menu pull-right">
									<li>
										<i class="icon-plus-sign"></i><b> ADD</b>
										<a action="<? echo $_PROJECTNAME;?>/questions/add" class="fb-action">Options</a>
									</li>
									<li>
										<i class="icon-pencil"></i><b> EDIT</b>
										<a action="<? echo $_PROJECTNAME;?>/questions/edit" class="fb-action">Questions</a>
									</li>		
									<li>
										<i class="icon-remove"></i><b> Delete</b>
										<a action="<? echo $_PROJECTNAME;?>/questions/delete" class="fb-action">Questions</a>
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
<?php echo $this->Form->create('Question',array('action'=>'index',
															'class'=>'canvasForm',
															'id'=>'QuestionCanvasForm',
															'model'=> 'Question',
															'canvas'=>'#QuestionTable'
														)
											);?>
<?php echo $this->Form->end();?>
<?php 
	echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>