<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name forms">
									 <?php echo $this->Html->link( 'Evaluation Result',
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
		<?php echo '<div class="pull-left"><div><b>Evaluatee Name:</b> '.$evaluatee['Evaluatee']['name'].'</div>'; ?>
		<?php echo '<div><b>Form Title:</b> '.$form['Form']['title'].'</div>'; ?>
		<?php echo '<div><b>Respondent Count:</b> '.$respondent_count['0']['0']['respondent_count'].'</div></div>'; ?>	
		<?php echo '<div class="pull-right"><div><b>Mean:</b> '.$mean.'</div>'; ?>
		<?php echo '<div ><b>Spread Index:</b> '.$spread_index.'</div></div><div class="clear"></div>'; ?>
		<hr/>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#SummaryResult" data-toggle="tab">Summary</a></li>
			<li><a href="#DistributionResult" data-toggle="tab">Distribution</a></li>
			<li><a href="#OpenEndedResult" data-toggle="tab">Open-Ended</a></li>
			<li class="pull-right">
				<?php echo $this->Form->input('evaluator',array('options'=>$evaluatorTypes,'empty'=>'All','label'=>false,'disabled'=>'disabled'));?>	
				<!--YET NO EVENT FUNCTION CREATED-->
			</li>
		</ul>
	
		<div class="tab-content">
			<!--SUMMARY-->
			<div class="tab-pane fade in active" id="SummaryResult">
			  <?php if(!empty($summary)){ ?>
			  <table class="table table table-striped table-bordered" id="EvaluationTable">
					<thead>
						<tr>
							<th class="w90"><a >Evaluation Item</a></th>
							<th class="w10 text-center"><a >Weighted Means</a></th>
						</tr>
					</thead>
					<tbody>
						<?php $previous_domain_id = ''; $ctr=0; $sum=0;?>
						<?php foreach($summary as $key => $smry):?>
						<?php if($smry['Question']['domain_id'] != $previous_domain_id): ?>
							<?php if($previous_domain_id!=''): ?>
								<tr class="">
									<td class='text-right' style="border-right:none;"><b></b></td>
									<td class='text-center' style="border-left:none;"><b><?php echo number_format($sum/$ctr, 2, '.', ',') ?></b></td>
								</tr>
								<?php $ctr=0; $sum=0; ?>
							<?php endif; ?>
							
							<?php $previous_domain_id = $smry['Question']['domain_id']; ?>
							<tr class="error">
								<td colspan='2'><?php echo '<center><b>'.$smry['Question']['domain_name'].'</b></center>'; ?></td>
							</tr>
						<?php endif; ?>
						<tr>
							<td><?php echo $smry['Question']['text']; ?></td>
							<td class="w10 text-center"><?php echo $smry[0]['weighted_mean']; ?></td>
						</tr>
						<?php $ctr++;?>
						<?php $sum+=$smry[0]['weighted_mean'];?>
						
						<?php if(($key+1) == count($summary)):?>
							<tr class="">
								<td class='text-right' style="border-right:none;"><b></b></td>
								<td class='text-center' style="border-left:none;"><b><?php echo number_format($sum/$ctr, 2, '.', ',') ?></b></td>
							</tr>
						<?php endif; ?>
						
						<?php endforeach;?>
					</tbody>
				</table>
				<?php }else{ ?> No Data Available  <?php } ?>
			</div>
			<!--DISTRIBUTION-->
			<div class="tab-pane fade" id="DistributionResult">
				<?php if(!empty($distribution)){ ?>
				<table class="table table table-striped table-bordered" id="EvaluationTable">
					<thead>
						<tr class="w100">
							<th class="w65" rowspan="2"><a>Evaluation Item</a></th>
							<th colspan="5" class="w25 text-center"><a>Rating</a></th>
							<th class="w10 text-center" rowspan="2"><a>Weighted Mean</a></th>
						</tr>
						<tr class="w100 text-center">
							<th class="w5 text-center"><a>5</a></th>
							<th class="w5 text-center"><a>4</a></th>
							<th class="w5 text-center"><a>3</a></th>
							<th class="w5 text-center"><a>2</a></th>
							<th class="w5 text-center"><a>1</a></th>
						</tr>
					</thead>
					<tbody>
						<?php $previous_domain_id = ''; ?>
						<?php foreach($distribution as $k=>$d):?>
						<?php if($d['domain_id'] != $previous_domain_id){; ?>
							<?php $previous_domain_id = $d['domain_id']; ?>
							<tr class="error">
								<td colspan='7'><?php echo '<center><b>'.$d['domain_name'].'</b></center>'; ?></td>
							</tr>
						<?php }; ?>
						<tr>
							<td><?php echo $k; ?></td>
							<td class="text-center">
								<?php echo (isset($d[5]))?$d[5]['0']['frequency']:'0';?>
							</td>
							<td class="text-center">
								<?php echo (isset($d[4]))?$d[4]['0']['frequency']:'0';?>
							</td>
							<td class="text-center">
								<?php echo (isset($d[3]))?$d[3]['0']['frequency']:'0';?>
							</td>
							<td class="text-center">
								<?php echo (isset($d[2]))?$d[2]['0']['frequency']:'0';?>
							</td>
							<td class="text-center">
								<?php echo (isset($d[1]))?$d[1]['0']['frequency']:'0';?>
							</td>
							<td class="text-center"><?php echo $d['weighted_mean']; ?></td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				<?php }else{ ?> No Data Available  <?php } ?>
			</div>
			<!--DIVERGENT-->
			<div class="tab-pane fade" id="OpenEndedResult">
				<?php if(!empty($divergent_question)){ ?>
				<?php foreach($divergent_question as $question => $data):?>
				<table class="table table table-striped table-bordered" id="EvaluationTable">
					<thead>
						<tr>
							<th class="w90 text-left"><a ><?php echo $question; ?></a></th>
							<th class="w10 text-center"><a >Count</a></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($data as $d):?><tr>
							<td><?php echo $d['EvaluationDetail']['answer']; ?></td>
							<td class="text-center"><?php echo $d[0]['count']; ?></td>
						</tr><?php endforeach;?>
					</tbody>
				</table>
				<?php endforeach;?>
				<?php }else{ ?>No Data Available  <?php } ?>
			</div>
		</div>
	</div>
</div>