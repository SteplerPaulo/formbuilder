<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name keyHeaders">
								 <?php echo $this->Html->link( 'Key Headers',
															array('action' => 'index')
														);  ?>							</div>
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
	<div class="row-fluid">
		<div class="w70 center">
			<?php echo '<div><b>Key Header ID:</b> '.$keyHeader['KeyHeader']['id'].'</div>';?>
			<?php echo '<div><b>Form Title:</b>'.$keyHeader['Form']['title'].'</div>';?>
			<?php echo '<div><b>Form Type: </b>'.$keyHeader['Form']['FormType']['name'].'</div>';?>
			
			<div>
				<?php echo '<b>Key Count: </b>'.count($keyHeader['Key']);?>
				<span class="pull-right">
					<a action='/formbuilder/key_headers/print_keys' class="fb-print-action">
						Print <i class="icon-print"></i>
					</a>
				</span>
			</div>
			<hr/>
			<table class="table table table-striped table-bordered  table-condensed">
				<thead>
					<th class="w5"><a>No</a></th>
					<th class="w34 text-center"><a>Key</a></th>
					<th class="w10 text-center"><a>Status</a></th>
					<th class="w1"></th>
					<th class="w5"><a>No</a></th>
					<th class="w35 text-center"><a>Key</a></th>
					<th class="w10 text-center"><a>Status</a></th>
				</thead>
				<tbody>
					<?php foreach($keyHeader['Key'] as $index=>$key): ?>
					<?php if($index%2 == 0){ ?>
						<tr>
							<td class="text-right"><?php echo $index+1;?></td>
							<td><?php echo $key['value'];?></td>
							<td class="text-center"><?php echo $key['status_str'];?></td>
							<td></td>
					<?php }else{?>
							<td class="text-right"><?php echo $index+1;?></td>
							<td><?php echo $key['value'];?></td>
							<td class="text-center"><?php echo $key['status_str'];?></td>
						</tr>
					<?php }?>
					<?php endforeach;?>
				</tbody>
			</table>	
		</div>
	</div>
</div>
<!--FORMACTION-->
<?php echo $this->Form->create('KeyHeaderAction',array('id'=>'KeyHeaderAction'));?>
	<?php echo $this->Form->input('KeyHeader.id',array('id'=>'KeyHeader','type'=>'hidden'));?>
<?php echo $this->Form->end();?>

<?php 
	echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));
	echo $this->Html->script(array('formbuilder/formkey'),array('inline'=>false));
?>
