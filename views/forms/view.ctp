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
		<div class="well">
			<div class="well">
				<div class="row-fluid"><b><?php echo $form['Form']['alias']; ?></div>
				<center><?php echo $form['Form']['title']; ?></center>
				<center><?php echo $form['Form']['description']; ?></center>
				<center><?php echo $form['FormType']['name']; ?></b></center>
				
				<?php echo$this->Form->input('test'); ?>
			</div>
			
			<?php if(isset($form['FormDomain'])){ ;?>
			<?php foreach($form['FormDomain'] as $domain):?>
				<dl class="well"> 
					<dt>
						<?php echo $domain['Domain']['name']; ?>
					</dt><hr/>
					<?php if(isset($form['DomainQuestion'][''.$domain['Domain']['name'].''])){ ;?>
						<?php foreach($form['DomainQuestion'][''.$domain['Domain']['name'].''] as $question => $question_data):?>
						
						<?php if($question_data['OptionType']['name'] == "textarea"){; ?>
						<dd>
							<dl>
								<?php echo $question; ?>
							</dl>
							<textarea class="center w100" placeholder="Input here..."></textarea>
						</dd><br/>
						
						<?php }else{; ?>
						<dd>
							<dl>
								<?php echo $question; ?>
							</dl>
							<dl class="well">
								<?php if(isset($question_data['QuestionOption'])){ ;?>
									<?php foreach($question_data['QuestionOption'] as $option):?>
									<dd>	
										<input type="<?php echo $question_data['OptionType']['name'];?>" name="<?php echo $question_data['id']; ?>" value="<?php echo $option['Option']['value']; ?>">
										<?php echo $option['Option']['text']; ?>
									</dd>
									<?php endforeach;?>
								<?php };?>
							</dl>
						</dd>
						<?php } ?>
						<?php endforeach;?>
					<?php };?>
				</dl>
			<?php endforeach;?>
			<?php };?>
		</div>
	</div>
</div>


<!--FORMACTION-->
<?php echo $this->Form->create('Form',array('id'=>'FormAction'));?>
	<?php echo $this->Form->input('Form.id',array('id'=>'FormId','type'=>'hidden'));?>
	<?php echo $this->Form->input('object_id',array('id'=>'ObjectId','type'=>'hidden'));?>
<?php echo $this->Form->end();?>


<?php 
	echo $this->Html->script(array('formbuilder/formbuilder'),array('inline'=>false));
?>