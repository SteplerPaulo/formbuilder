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
<? 
	//pr($keyHeader);exit;
?>

<div class="sub-content-container">
	<div class="row-fluid">
		<div class="w70 center">
			<div><b>Key Header ID : <? echo $keyHeader['KeyHeader']['id'];?></b></div>
			<div><b>Form Title : <? echo $keyHeader['Form']['title'];?></b></div>
			<div>
				<b>Form Type : <? echo $keyHeader['Form']['FormType']['name'];?></b>
				<span class="pull-right">
					<a action='/formbuilder/key_headers/print_keys' class="fb-print-action">
						Print <i class="icon-print"></i>
					</a>
				</span>
			</div>
			<hr/>
			<table class="table table table-striped table-bordered  table-condensed">
				
				<thead>
					<th class="w80 text-center"><a>Key</a></th>
					<th class="w10 text-center"><a>Status</a></th>
				</thead>
				<tbody>
					<? foreach($keyHeader['Key'] as $key): ?>
					<tr>
						<td><? echo $key['value']; ?></td>
						<td class="text-center"><? echo $key['status_str']; ?></td>
					</tr>
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
