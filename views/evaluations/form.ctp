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

<?php $index = 0;?>
<div class="sub-content-container">
	<div class="w90 center">
		<?php echo $this->Form->create('Evaluation',array('id'=>'EvaluationForm','action'=>'add'));?>
		<div class="well"><br/>
			<dl class="well">
				<div class="row-fluid"><b><?php echo $form['Form']['alias']; ?></div>
				<?php echo '<center>'.$form['Form']['title']. '<center/><center>'.$form['Form']['description'].'<center/><center>'.$form['FormType']['name'].'</center></b>'; ?>
				<?php echo $this->Form->input('Evaluation.form_id',array('type'=>'hidden','value'=>$form['Form']['id'])); ?>	
				<?php echo $this->Form->input('Key.id',array('type'=>'hidden','value'=>$key)); ?>	
			</dl>
			
			<dl class="well">	
				<div class="row">
					<div class="span3">
						<?php echo $this->Form->input('school_year_id',array('label'=>'S.Y.'));?>
					</div>
					<div class="span3">						
						<label>Period</label>						
						<?php foreach($periods as $key=>$value):?>
							<input type="radio" name="data[Evaluation][period_id]" value="<?php echo $key;?>" <?php echo ($key==5)?'checked':''?>></input>
							&nbsp;<?php echo $value; ?> &nbsp;&nbsp;
						<?php endforeach;?>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="span3">				
						<?php echo $this->Form->input('evaluator_type_id',array('options'=>$evaluatorTypes,'empty'=>'Select','required'=>'required'));?>		
					</div>
				</div>
				<div class="row">
					<div class="span12">
						<?php echo $this->Form->input('evaluator',array('class'=>'w97'));?>	
					</div>
					<div class="span12">
						<?php echo $this->Form->input('evaluatee_id',array('options'=>$evaluatee,'class'=>'w98'));?>
					</div>
				</div>
			</dl>
			
			<!--DOMAIN FOREACH--->
			<?php foreach($form['FormDomain'] as $domain):?>
			<dl class="well"> 
				<dt class="domain">
					<?php echo $domain['Domain']['name'].'<hr/>'; ?>
				</dt>
				<!--QUESTION FOREACH--->
				<?php foreach($form['DomainQuestion'][''.$domain['Domain']['name'].''] as $question => $question_data):?>
				<dd>
					<dl class="question">
						<?php echo $question; ?>
					</dl>
					<?php if($question_data['OptionType']['name'] == "textarea"){; ?>
						<dl class="textarea">
							<dd>
							<?php echo $this->Form->input('EvaluationDetail.'. $index.'.answer',array('type'=>'textarea','class'=>'center w100','placeholder'=>'Input here...','rows'=>2,'label'=>false)); ?>
							<?php echo $this->Form->input('EvaluationDetail.'. $index.'.question_id',array('type'=>'hidden','value'=>$question_data['id'],'label'=>false)); ?>
							<?php echo $this->Form->input('EvaluationDetail.'. $index++ .'.option_type',array('type'=>'hidden','value'=>'textarea','label'=>false)); ?>
							</dd>
						</dl><br/>
					<?php }else if($question_data['OptionType']['name'] == "checkbox"){; ?>
						<dl class="options well">
							<?php foreach($question_data['QuestionOption'] as $option):?>
							<dd>
								<input type="checkbox" name="data[EvaluationDetail][<?php echo $index;?>][option_id]" value="<?php echo $option['Option']['id']; ?>"></input>
								<?php echo $option['Option']['text']; ?>
								<?php echo $this->Form->input('EvaluationDetail.'. $index .'.question_id',array('type'=>'hidden','value'=>$question_data['id'],'label'=>false)); ?>
								<?php echo $this->Form->input('EvaluationDetail.'. $index++ .'.option_type',array('type'=>'hidden','value'=>'checkbox','label'=>false)); ?>
							</dd>
							<?php endforeach;?>
						</dl>
					
					<?php }else if($question_data['OptionType']['name'] == "radio"){; ?>
					
						<dl class="options well">
							<?php foreach($question_data['QuestionOption'] as $option):?>
							<dd>
								<input type="radio" name="data[EvaluationDetail][<?php echo $index;?>][option_id]" value="<?php echo $option['Option']['id']; ?>"></input>
								<?php echo $option['Option']['text']; ?>
							</dd>
							<?php endforeach;?>
							<?php echo $this->Form->input('EvaluationDetail.'. $index .'.question_id',array('type'=>'hidden','value'=>$question_data['id'],'label'=>false)); ?>
							<?php echo $this->Form->input('EvaluationDetail.'. $index++ .'.option_type',array('type'=>'hidden','value'=>'radio','label'=>false)); ?>
						</dl>
					<?php }; ?>
				</dd>
				<?php endforeach;?>
				<!--END QUESTION FOREACH--->
			</dl>
			<?php endforeach;?>
			<!--END DOMAIN FOREACH--->
			
			<dl class="text-right">
				<button type="button" class="btn btn-primary" id="EvaluationFormSubmitButton">Submit</button>
			</dl>
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>

<!--Action & Notification Modal-->
<div id="Modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Modal</h3>
	</div>
	<div class="modal-body">
		<div class="well" id="Notification">
		
		</div>
	</div>
	
	<div class="modal-footer">
		<div class="btn-group">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Back</button>
		</div>
	</div>
</div>
<!--End-->
	

<!--FORMACTION-->
<?php echo $this->Form->create('Form',array('id'=>'FormAction'));?>
	<?php echo $this->Form->input('Form.id',array('id'=>'FormId','type'=>'hidden'));?>
	<?php echo $this->Form->input('object_id',array('id'=>'ObjectId','type'=>'hidden'));?>
<?php echo $this->Form->end();?>


<?php 
	echo $this->Html->script(array('formbuilder/formevaluation'),array('inline'=>false));
?>