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
		</div>
	</div>
</div>
<div class="sub-content-container">
	<div class="row-fluid">
		<div class="w70 center">
			<? echo '<div><b>Key Header ID:</b> '.$keyHeader['KeyHeader']['id'].'</div>';?>
			<? echo '<div><b>Form Title:</b>'.$keyHeader['Form']['title'].'</div>';?>
			<? echo '<div><b>Form Type: </b>'.$keyHeader['Form']['FormType']['name'].'</div>';?>
			
			<div>
				<? echo '<b>Key Count: </b>'.count($keyHeader['Key']);?>
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
					<? foreach($keyHeader['Key'] as $index=>$key): ?>
					<? if($index%2 == 0){ ?>
						<tr>
							<td class="text-right"><? echo $index+1;?></td>
							<td><? echo $key['value'];?></td>
							<td class="text-center"><? echo $key['status_str'];?></td>
							<td></td>
					<?}else{?>
							<td class="text-right"><? echo $index+1;?></td>
							<td><? echo $key['value'];?></td>
							<td class="text-center"><? echo $key['status_str'];?></td>
						</tr>
					<?}?>
					<? endforeach;?>
				</tbody>
			</table>	
		</div>
	</div>
</div>
<!--FORMACTION-->
<?php echo $this->Form->create('KeyHeaderAction',array('id'=>'KeyHeaderAction'));?>
	<? echo $this->Form->input('KeyHeader.id',array('id'=>'KeyHeader','type'=>'hidden'));?>
<?php echo $this->Form->end();?>

<?php 
	echo $this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));
	echo $this->Html->script(array('formbuilder/formkey'),array('inline'=>false));
?>
