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
														$this->Html->tag('span', 'NEW FORM', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate')
													);  ?>					
					</div>
					<div class="btn-group span3">
						<a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown" href="#">
							<i class=" icon-circle-arrow-down"></i><span class="action-label">More Action</span>	
						</a>
						<ul class="dropdown-menu">
							<li>
								<i class="icon-plus-sign"></i><b> ADD</b>
								<a action="/formbuilder/domains/create" object-id="<? echo $form['Form']['id']?>" class="fb-more-action"> Domain</a>
							</li>		
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
 </div>

<div class="sub-content-container">
	<div class="w90 center">
		<div class="well">
			<div class="well">
				<div class="pull-right">
					<b>Form</b>
					<a action="../forms/edit" class="fb-workplace-edit"  object-id="<? echo $form['Form']['id']?>"><i class="icon-edit"> Edit</i></a> |
					<a action="../forms/delete" class="fb-workplace-delete"><i class="icon-remove-circle"> Delete</i></a> |
					<a action="../domains/create" class="" object-id="<? echo $form['Form']['id']?>"><i class="icon-plus-sign"> Add Domain</i></a> 
				</div><hr/>
				<center><b><?php echo $form['Form']['title']; ?></center>
				<center><?php echo $form['Form']['description']; ?></center>
				<center><?php echo $form['FormType']['name']; ?></b></center>
				
			</div>
			<!--
			<? foreach($form['DomainQuestion'] as $domain => $domain_data):?>
			<? $domain_id;?>
			<div class="well">
				<dl> 
					<dt class=""><? echo $domain; ?></dt><br/>
					<? foreach($domain_data as $question => $question_data):?>
						<? $domain_id=$question_data['Domain']['id']; ?>
						<dd>
							<? echo $question; ?>
							<span class="pull-right">
								
								<a action="../questions/edit" class="fb-workplace-edit" object-id="<? echo $question_data['id'];?>"><i class="icon-edit"> Edit</i></a> |
								<a class="fb-workplace-delete"><i class="icon-remove-circle"> Delete</i></a> |
								<a action="../domains/create" class="" object-id="<? echo $question_data['id'];?>"><i class="icon-plus-sign"> Add Option</i></a> 
							</span>						
							<dl class="well">
								<? foreach($question_data['QuestionOption'] as $option):?>
								<dd>	
									<input type="<? echo $question_data['OptionType']['name'];?>" name="<? echo $question_data['id']; ?>" value="<? echo $option['Option']['value']; ?>">
									<? echo $option['Option']['text']; ?>
									<span class="pull-right">
										<a action="../options/edit" class="fb-workplace-edit"  object-id="<? echo $option['Option']['id'];?>"><i class="icon-edit"> Edit</i></a> 
										<a action="../options/delete" class="fb-workplace-delete" object-id="<? echo $option['Option']['id'];?>"><i class="icon-remove-circle"> Delete</i></a>
									</span>
								</dd>
								<? endforeach;?>
							</dl>
						</dd>
					
				
					<? endforeach;?>
					<div class='domain-id'>
						<a action="../domains/edit/" class="fb-workplace-edit"  object-id="<? echo $domain_id;?>"><i class="icon-edit"> Edit Domain Name</i></a> 
						<a class="fb-workplace-delete"><i class="icon-remove-circle"> Delete</i></a>
					</div>
				</dl>
			</div>
			<? endforeach;?>
			-->
			
			<? foreach($form['FormDomain'] as $domain):?>
				<dl class="well"> 
					<dt>
						<? echo $domain['Domain']['name']; ?>
						<span class="pull-right">
							<a action="../domains/edit/" class="fb-workplace-edit"  object-id="<? echo $domain['Domain']['id'];?>"><i class="icon-edit"> Edit</i></a> |
							<a class="fb-workplace-delete"><i class="icon-remove-circle"> Delete</i></a> |
							<a action="../question/create" class="" object-id="<? echo $form['Form']['id']?>"><i class="icon-plus-sign"> Add Question</i></a> 
						</span>
					</dt><hr/>
					<? foreach($form['DomainQuestion'] as $domain => $domain_data):?>
						<? foreach($domain_data as $question => $question_data):?>
							<dd>
								<? echo $question; ?>
								<span class="pull-right">
									<a action="../questions/edit" class="fb-workplace-edit" object-id="<? echo $question_data['id'];?>"><i class="icon-edit"> Edit</i></a> |
									<a class="fb-workplace-delete"><i class="icon-remove-circle"> Delete</i></a> |
									<a action="../domains/create" class="" object-id="<? echo $question_data['id'];?>"><i class="icon-plus-sign"> Add Option</i></a> 
								</span>						
								<dl class="well">
									<? foreach($question_data['QuestionOption'] as $option):?>
									<dd>	
										<input type="<? echo $question_data['OptionType']['name'];?>" name="<? echo $question_data['id']; ?>" value="<? echo $option['Option']['value']; ?>">
										<? echo $option['Option']['text']; ?>
										<span class="pull-right">
											<a action="../options/edit" class="fb-workplace-edit"  object-id="<? echo $option['Option']['id'];?>"><i class="icon-edit"> Edit</i></a> 
											<a action="../options/delete" class="fb-workplace-delete" object-id="<? echo $option['Option']['id'];?>"><i class="icon-remove-circle"> Delete</i></a>
										</span>
									</dd>
									<? endforeach;?>
								</dl>
							</dd>
						<? endforeach;?>
					<? endforeach;?>
				</dl>
			<? endforeach;?>
		</div>
	</div>
</div>



<!--Delete Warning-->
<div id="Modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Warning</h3>
	</div>
	<div class="modal-body">
		<div class="well">
			<span class="label label-warning">Important</span>
			Once Deleted It Cannot be Undo
		</div>
		
		<div class="well" id="Notification" style="display:none"></div>
	</div>
	
	<div class="modal-footer">
		<div class="btn-group">
			<button class="btn fb-workplace-confirm-delete-button" type="button">Confirm Delete</button>
			<button class="btn fb-workplace-exit-button" data-dismiss="modal" aria-hidden="true">Exit</button>
		</div>
	</div>
</div>
<!--End-->








<!--FORMACTION-->
<?php echo $this->Form->create('Form',array('id'=>'FormAction'));?>
	<? echo $this->Form->input('Form.id',array('id'=>'FormId','type'=>'hidden'));?>
	<? echo $this->Form->input('object_id',array('id'=>'ObjectId','type'=>'hidden'));?>
<?php echo $this->Form->end();?>


<?php 
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>