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
						<?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-list-alt icon-white')).
														$this->Html->tag('span', 'Form List', array('class' => 'action-label')),
														array('action' => 'index'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate')
													);  ?>					
					</div>
					<div class="span3">
					 <?php echo $this->Html->link( 	$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														$this->Html->tag('span', 'NEW FORM', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-block animate')
													);  ?>					
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
				<center><b><?php echo $form['Form']['title']; ?></center>
				<center><?php echo $form['Form']['description']; ?></center>
				<center><?php echo $form['FormType']['name']; ?></b></center>
			</div>
			
			<? if(isset($form['FormDomain'])){ ;?>
			<? foreach($form['FormDomain'] as $domain):?>
				<dl class="well"> 
					<dt>
						<? echo $domain['Domain']['name']; ?>
					</dt><hr/>
					<? if(isset($form['DomainQuestion'][''.$domain['Domain']['name'].''])){ ;?>
						<? foreach($form['DomainQuestion'][''.$domain['Domain']['name'].''] as $question => $question_data):?>
						
						<? if($question_data['OptionType']['name'] == "textarea"){; ?>
						<dd>
							<dl>
								<? echo $question; ?>
							</dl>
							<textarea class="center w100" placeholder="Fill out this area..."></textarea>
						</dd><br/>
						
						<? }else{; ?>
						<dd>
							<dl>
								<? echo $question; ?>
							</dl>
							<dl class="well">
								<? if(isset($question_data['QuestionOption'])){ ;?>
									<? foreach($question_data['QuestionOption'] as $option):?>
									<dd>	
										<input type="<? echo $question_data['OptionType']['name'];?>" name="<? echo $question_data['id']; ?>" value="<? echo $option['Option']['value']; ?>">
										<? echo $option['Option']['text']; ?>
									</dd>
									<? endforeach;?>
								<? };?>
							</dl>
						</dd>
						<? } ?>
						<? endforeach;?>
					<? };?>
				</dl>
			<? endforeach;?>
			<? };?>
		</div>
	</div>
</div>


<!--FORMACTION-->
<?php echo $this->Form->create('Form',array('id'=>'FormAction'));?>
	<? echo $this->Form->input('Form.id',array('id'=>'FormId','type'=>'hidden'));?>
	<? echo $this->Form->input('object_id',array('id'=>'ObjectId','type'=>'hidden'));?>
<?php echo $this->Form->end();?>


<?php 
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>