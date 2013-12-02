<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name evaluationDetails">
								 <?php echo $this->Html->link( 'Evaluation Details',
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
								<li><?php echo $this->Html->link(__('Evaluations', true), array('controller' => 'evaluations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Questions', true), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Options', true), array('controller' => 'options', 'action' => 'index')); ?> </li>
					  </ul>
					</div>
				</div>
			</div>
			<div class="span6 text-right">
				 <input class="span6 m-t-5 p" type="text" placeholder="Search">
			</div>
		</div>
	</div>
 </div>


 <div class="row-fluid">
<div class="span6">
<div class="evaluationDetails view">
<h2><?php  __('Evaluation Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $evaluationDetail['EvaluationDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Evaluation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($evaluationDetail['Evaluation']['id'], array('controller' => 'evaluations', 'action' => 'view', $evaluationDetail['Evaluation']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Question'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($evaluationDetail['Question']['id'], array('controller' => 'questions', 'action' => 'view', $evaluationDetail['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Option'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($evaluationDetail['Option']['id'], array('controller' => 'options', 'action' => 'view', $evaluationDetail['Option']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
</div>
<div class="span6">
</div>
</div>