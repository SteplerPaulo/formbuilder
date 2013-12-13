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
			</div>
		</div>
	</div>
 </div>
<div class="sub-content-container">
	<div class="w90 center">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#SummaryResult" data-toggle="tab">Summary</a></li>
			<li><a href="#CommentResult" data-toggle="tab">Divergent Question</a></li>
			<li><a href="#DistributionResult" data-toggle="tab">Distribution</a></li>
		</ul>
		
		
		<div>Evaluatee Name:</b>  <? echo $evaluatee;?></div>
		<div>Form Title:</b>  <? echo $form['Form']['title'];?></div>
		<hr/>
		
		<!-- Tab panes -->
		<div class="tab-content">
			<!--Summary-->
			<div class="tab-pane fade in active" id="SummaryResult">
			  <table class="table table table-striped table-bordered tablesorter" id="EvaluationTable">
					<thead>
						<tr>
							<th class="w90 text-center"><a >Evaluation Item</a></th>
							<th class="w10 text-center"><a >Weighted Means</a></th>
						</tr>
					</thead>
					<tbody>
						<? foreach($summary as $smry):?>
						<tr>
							<td><? echo $smry['Question']['text']; ?></td>
							<td class="w10 text-center"><? echo $smry[0]['weighted_mean']; ?></td>
						</tr>
						<? endforeach;?>
					</tbody>
				</table>
			</div>
			<!--Divergent-->
			<div class="tab-pane fade" id="CommentResult">
				<? if(!empty($divergent_question)){ ?>
				<? foreach($divergent_question as $question => $data):?>
				<table class="table table table-striped table-bordered RECORD tablesorter" id="EvaluationTable">
					<thead>
						<tr>
							<th class="w90 text-left"><a ><? echo $question; ?></a></th>
							<th class="w10 text-center"><a >Count</a></th>
						</tr>
					</thead>
					<tbody>
						<? foreach($data as $d):?><tr>
							<td><? echo $d['EvaluationDetail']['answer']; ?></td>
							<td class="text-center"><? echo $d[0]['count']; ?></td>
						</tr><? endforeach;?>
					</tbody>
				</table>
				<? endforeach;?>
				
				<? }else{ ?> No Data Available  <? } ?>
			</div>
			<!--Distribution-->
			<div class="tab-pane fade" id="DistributionResult">
				<table class="table table table-striped table-bordered  RECORD tablesorter" id="EvaluationTable">
					<thead>
						<tr class="w100">
							<th class="w65 text-center" rowspan="2"><a>Evaluation Item</a></th>
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
						<? foreach($distribution as $k=>$d):?>
						<tr>
							<td><? echo $k; ?></td>
							<td class="text-center">
								<? echo (isset($d[5]))?$d[5]['0']['frequency']:'0';?>
							</td>
							<td class="text-center">
								<? echo (isset($d[4]))?$d[4]['0']['frequency']:'0';?>
							</td>
							<td class="text-center">
								<? echo (isset($d[3]))?$d[3]['0']['frequency']:'0';?>
							</td>
							<td class="text-center">
								<? echo (isset($d[2]))?$d[2]['0']['frequency']:'0';?>
							</td>
							<td class="text-center">
								<? echo (isset($d[1]))?$d[1]['0']['frequency']:'0';?>
							</td>
							<td class="text-center"><? echo $d['weighted_mean']; ?></td>
						</tr>
						<? endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>