<?php //pr($form);exit;
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
															array('action' => 'index')
														);  ?>							
							</div>
						</div>
					</div>
					<div class="span3">
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate')
													);  ?>					
					</div>
					<div class="btn-group span3">
						<a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown" href="#">
							<i class=" icon-th-list"></i><span class="action-label">LINKS</span>	
						</a>
						<!-- dropdown menu links -->
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link(__('Form Types', true), array('controller' => 'form_types', 'action' => 'index')); ?> </li>
							<li><?php echo $this->Html->link(__('Questions', true), array('controller' => 'questions', 'action' => 'index')); ?> </li>
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

<div class="sub-content-container">

<div class="w90 center">
	<div class="well">
		<div class="well">
		
			<center>Description <i class="icon-hand-right"></i> <b><?php echo $form['Form']['description']; ?></b></center>
			<center>Title <i class="icon-hand-right"> </i><b><?php echo $form['Form']['title']; ?></b></center>
			<center>Type <i class="icon-hand-right"></i> <b><?php echo $form['FormType']['name']; ?></b></center>
		</div>
		
		<? foreach($form['DomainQuestion'] as $domain => $domain_data):?>
		<div class="well">
			<dl>
				<dt class=""><? echo $domain; ?></dt><br/>
			<? foreach($domain_data as $question => $question_data):?>
				
					<dd><? echo $question; ?>
						<dl>
							<? foreach($question_data['QuestionOption'] as $option):?>
							<dd>
								<input type="<? echo $question_data['OptionType']['name'];?>" name="<? echo $question_data['id']; ?>" value="<? echo $option['Option']['value']; ?>">
								<? echo $option['Option']['text']; ?>
							</dd>
							<? endforeach;?>
						</dl>
					</dd>
				
			<? endforeach;?>
			</dl>
		</div>
		<? endforeach;?>
		
	</div>
</div>
</div>