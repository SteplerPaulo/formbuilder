<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name issueOuts">
									 <?php echo $this->Html->link( 'User Profile',
															'javascript:void()'
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
<div class="sub-content-container">
	<div class="w90 center">
				<div class="tab-content">	
			<div class="row-fluid">
				<div class="span10">
					<div class="media span12">
						<span class="span3 vertical-line">
							<a class="pull-left thumbnail " href="#ProfilePictureModal"  role="button" data-toggle="modal">
								<?php 
									if(!empty($user['Document']['id'])){
										echo $this->Html->image('/users/download/'.$user['Document']['id'],array('alt'=>'','class'=>'media-object','style'=>'width:167px;height:200px'));
									}else{
										echo $this->Html->image('/img/200x250.gif',array('alt'=>'','class'=>'media-object','style'=>'width:167px;height:200px'));
									}
								?>
							</a>	
							<?php
								if($access->check('User') || $user['User']['id'] == $access->getmy('id') ):
									echo $this->element('upload');
								endif;
							?>
						</span>
						<div class="media-body span9">
							<section>
								<dl>
								
									<dt><h4>Username: <?php echo $user['User']['username']; ?></h4></dt>
									<dd><b>Last Name: </b><?php echo $user['User']['last_name']; ?></dd>
									<dd><b>First Name: </b><?php echo $user['User']['first_name']; ?></dd>
									<dd><b>Middle Name: </b><?php echo $user['User']['middle_name']; ?></dd>
						
								</dl>
							</section><hr>
							<section>
								<?php echo $this->element('apps'); ?>
							</section>
							
					
						</div>
					</div>
				</div>	
				<?php if($access->check('User') || $user['User']['id'] == $access->getmy('id') ):?>
				<div class="actions span2 well">
					<h3><?php __('Actions'); ?></h3>
					<div class="text-center">
						<button class="btn margin-bottom">
							<?php echo $this->Html->link(
									$this->Html->tag('i','',array('class' =>'icon-cog','data-toggle'=>'tooltip','title'=>'Account Setting','data-placement'=>'top')),
									array('action' => 'account_setting'),
									array('escape' => false)
								);		
							?> 
						</button>
						<!--
						<button class="btn margin-bottom">
							<?php echo $this->Html->link(
								$this->Html->tag('i','',array('class' =>'icon-trash','data-toggle'=>'tooltip','title'=>'Delete','data-placement'=>'top')),
								array('action' => 'delete', $user['User']['id']), 
								array('escape' => false), 
								sprintf(__('Are you sure you want to delete record of alumni %s?', true), $user['User']['username'])
							); ?>
						</button>
						-->
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>	
	</div>
</div>
