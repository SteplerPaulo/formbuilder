<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name issueOuts">
									 <?php echo $this->Html->link( 'Issue Outs',
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
		<div class="users index">
			<h2><?php __('Users');?></h2>
			<table class="table table-striped table-bordered table-hover table-condensed">
				<tr>
					<th><?php echo $this->Paginator->sort('username');?></th>
					<th><?php echo $this->Paginator->sort('created');?></th>
					<th><?php echo $this->Paginator->sort('modified');?></th>
					<?php if($access->check('User')  || $access->check('User','delete')): ?>
					<th class="actions"><?php __('Actions');?></th>
					<?php endif; ?>
				</tr>
				<?php
				$i = 0;
				foreach ($users as $user):
					$class = null;
					if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				?>
				<tr<?php echo $class;?>>
					<td><?php echo $user['User']['username']; ?>&nbsp;</td>
					<td><?php echo $user['User']['created']; ?>&nbsp;</td>
					<td><?php echo $user['User']['modified']; ?>&nbsp;</td>
					<?php if($access->check('User') || $access->check('User','delete')): ?>
					<td class="actions w5 text-center">
						<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' =>'icon-eye-open')),array('action' => 'view', $user['User']['username']),array('escape' => false)); ?> 	
						<!--
						<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' =>'icon-edit')),array('action' => 'edit', $user['User']['id']),array('escape' => false)); ?> 		
						<?php echo $this->Html->link(
							$this->Html->tag('i','',array('class' =>'icon-trash')),
							array('action' => 'delete', $user['User']['id']), 
							array('escape' => false), 
							sprintf(__('Are you sure you want to delete user %s?', true), $user['User']['username'])
						); ?>
						-->
					</td>
					<?php endif; ?>
				</tr>
				<?php endforeach; ?>
			</table>
			<p>
			<?php
			echo $this->Paginator->counter(array(
			'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
			));
			?>				</p>

			<div class="paging">
				<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
			  | <?php echo $this->Paginator->numbers();?> |
				<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
			</div>
		</div>
		<div class="actions">
			<h3><?php __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('Create New User', true), array('action' => 'register')); ?></li>
			</ul>
		</div>
	</div>
</div>
