<?php $this->Html->script('simplyconnect',array('inline'=>false)); ?>
<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span8">		
				<div class="row-fluid">
					<div class="span3 module">
						<div class="module-wrap">
							<div class="module-name">
								<i class="icon-refresh icon-spin"></i>
								SimplyConnect
							</div>
						</div>
					</div>
					<div class="span3">
						</div>
				</div>
			</div>
		</div>
	</div>	
 </div>
<div class="row-fluid">
	<div class="span9 offset2">
		<div class="well m-t-5e">
		<?php if(isset($error)): ?>
				<h3>Error: OAuth failed</h3>
				<?php echo $error; ?>
		<?php else: ?>
				<h3>Info:OAuth successful</h3>
				Redirecting...
				<?php echo $this->Form->input('user',array('value'=>json_encode($data['data']),'type'=>'hidden'));?>
		<?php endif; ?>
		</div>

	</div>
</div>
