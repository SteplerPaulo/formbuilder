
<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name domains">
									 <?php echo $this->Html->link( 'Domains',
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
		<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable advancedTable" id="DomainTable" model="Domain">
			<thead>
				<tr>
					<th class="w35 text-center"><a>Name</a></th>
					<th class="w60 text-center"><a>Description</a></th>
					<th class="actions w5"><a >Actions</a></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="w35"><span data-field='Domain.name'></span></td>
					<td class="w60"><span data-field='Domain.description'></span></td>
					<td class="actions w5">
						<div class="btn-group">
							<div class="btn-group btn-center">
								<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="#intent-modal" data-toggle="modal"  class="action-view view-forms"><i class="icon-eye-open"></i> Forms</a></li>					 
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
<!-- CANVASFORM -->
<?php echo $this->Form->create('Domain',array('action'=>'index.json',
															'class'=>'canvasForm',
															'id'=>'DomainCanvasForm',
															'model'=> 'Domain',
															'canvas'=>'#DomainTable'
														)
											);?>
<?php echo $this->Form->end();?>
<?php echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));?>