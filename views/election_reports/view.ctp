<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name electionReports">
								 <?php echo $this->Html->link( 'Election Reports',
															array('action' => 'index')
														);  ?>							</div>
						</div>
					</div>
					<div class="span3">
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate')
													);  ?>					</div>
					<div class="btn-group span3">
					  <a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown" href="#">
						<i class=" icon-th-list"></i><span class="action-label">LINKS</span>	
					  </a>
					  <ul class="dropdown-menu">
						<!-- dropdown menu links -->
							<li><?php echo $this->Html->link(__('Forms', true), array('controller' => 'forms', 'action' => 'index')); ?> </li>
							<li><?php echo $this->Html->link(__('Election Report Details', true), array('controller' => 'election_report_details', 'action' => 'index')); ?> </li>
					  </ul>
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


 <div class="row-fluid">
<div class="span6">
<div class="electionReports view">
<h2><?php  __('Election Report');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $electionReport['ElectionReport']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Form'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($electionReport['Form']['title'], array('controller' => 'forms', 'action' => 'view', $electionReport['Form']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $electionReport['ElectionReport']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
</div>
<div class="span6">
<div class="related">
	<h3><?php __('Related Election Report Details');?></h3>
	<?php if (!empty($electionReport['ElectionReportDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Election Report Id'); ?></th>
		<th><?php __('Question Id'); ?></th>
		<th><?php __('Option Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($electionReport['ElectionReportDetail'] as $electionReportDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $electionReportDetail['id'];?></td>
			<td><?php echo $electionReportDetail['election_report_id'];?></td>
			<td><?php echo $electionReportDetail['question_id'];?></td>
			<td><?php echo $electionReportDetail['option_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'election_report_details', 'action' => 'view', $electionReportDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'election_report_details', 'action' => 'edit', $electionReportDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'election_report_details', 'action' => 'delete', $electionReportDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $electionReportDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Election Report Detail', true), array('controller' => 'election_report_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
</div>
</div>