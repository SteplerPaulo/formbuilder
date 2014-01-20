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
		</div>
	</div>
 </div>

<? $index = 0;?>
<div class="sub-content-container">
	<div class="w90 center">
		<?php echo $this->Form->create('Quiz',array('id'=>'QuizForm','action'=>'add'));?>
		<div class="well"><br/>
			<dl class="well">
				<? echo '<b><center>'.$form['Form']['title']. '<center/><center>'.$form['Form']['description'].'<center/><center>'.$form['FormType']['name'].'</center></b>'; ?>
				<? echo $this->Form->input('Quiz.form_id',array('type'=>'hidden','value'=>$form['Form']['id'])); ?>	
				<? echo $this->Form->input('Key.id',array('type'=>'hidden','value'=>$key)); ?>	
			</dl>
			
			<dl class="well">	
				<?php echo $this->Form->input('Quiz.examinee',array('required'=>'required','class'=>'w100'));?>	
			</dl>
			
			<!--DOMAIN FOREACH--->
			<? foreach($form['FormDomain'] as $domain):?>
			<dl class="well"> 
				<dt class="domain">
					<? echo $domain['Domain']['name'].'<hr/>'; ?>
				</dt>
				<!--QUESTION FOREACH--->
				<? foreach($form['DomainQuestion'][''.$domain['Domain']['name'].''] as $question => $question_data):?>
				<dd>
					<dl class="question">
						<? echo $question; ?>
					</dl>
					<? if($question_data['OptionType']['name'] == "textarea"){; ?>
						<dl class="textarea">
							<dd>
							<? echo $this->Form->input('QuizDetail.'. $index.'.answer',array('type'=>'textarea','class'=>'center w100','placeholder'=>'Fill out this area...','label'=>false)); ?>
							<? echo $this->Form->input('QuizDetail.'. $index.'.question_id',array('type'=>'hidden','value'=>$question_data['id'],'label'=>false)); ?>
							<? echo $this->Form->input('QuizDetail.'. $index++ .'.option_type',array('type'=>'hidden','value'=>'textarea','label'=>false)); ?>
							</dd>
						</dl><br/>
					<?}else if($question_data['OptionType']['name'] == "checkbox"){; ?>
						<dl class="options well">
							<? foreach($question_data['QuestionOption'] as $option):?>
							<dd>
								<input type="checkbox" name="data[QuizDetail][<? echo $index;?>][option_id]" value="<? echo $option['Option']['id']; ?>"></input>
								<? echo $option['Option']['text']; ?>
								<? echo $this->Form->input('QuizDetail.'. $index .'.question_id',array('type'=>'hidden','value'=>$question_data['id'],'label'=>false)); ?>
								<? echo $this->Form->input('QuizDetail.'. $index++ .'.option_type',array('type'=>'hidden','value'=>'checkbox','label'=>false)); ?>
							</dd>
							<? endforeach;?>
						</dl>
					
					<?}else if($question_data['OptionType']['name'] == "radio"){; ?>
					
						<dl class="options well">
							<? foreach($question_data['QuestionOption'] as $option):?>
							<dd>
								<input type="radio" name="data[QuizDetail][<? echo $index;?>][option_id]" value="<? echo $option['Option']['id']; ?>"></input>
								<? echo $option['Option']['text']; ?>
							</dd>
							<? endforeach;?>
							<? echo $this->Form->input('QuizDetail.'. $index .'.question_id',array('type'=>'hidden','value'=>$question_data['id'],'label'=>false)); ?>
							<? echo $this->Form->input('QuizDetail.'. $index++ .'.option_type',array('type'=>'hidden','value'=>'radio','label'=>false)); ?>
						</dl>
					<? }; ?>
				</dd>
				<? endforeach;?>
				<!--END QUESTION FOREACH--->
			</dl>
			<? endforeach;?>
			<!--END DOMAIN FOREACH--->
			
			<dl class="text-right">
				<button type="button" class="btn btn-primary" id="FormSubmitButton">Submit</button>
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
	<? echo $this->Form->input('Form.id',array('id'=>'FormId','type'=>'hidden'));?>
	<? echo $this->Form->input('object_id',array('id'=>'ObjectId','type'=>'hidden'));?>
<?php echo $this->Form->end();?>


<?php 
	echo $this->Html->script(array('formbuilder/formquiz'),array('inline'=>false));
?>