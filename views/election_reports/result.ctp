<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name forms">
									 <?php echo $this->Html->link( 'Election Result',
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
		<table class="table table table-striped table-bordered" id="ElectionReportTable">
			<? echo '<caption>'.$result['Ballot'][0]['forms']['title'].'</caption>'; ?><thead>
			<thead>
				<tr>
					<th class="w20 text-center"><a >Position</a></th>
					<th class="w50"><a >Candidate Name</a></th>
					<th class="w20 text-center"><a >Vote Count</a></th>
				</tr>
			</thead>
			<tbody>
				<? $CurrPosition = ''; $CurrPositionIndex = 0; ?>
				<? foreach($result['Ballot'] as $ballot):?>
				<? $vote = isset($votes[$ballot['options']['id']])?$votes[$ballot['options']['id']]:0; ?>
				
				<? if($ballot['questions']['id'] != $CurrPosition){?>
					<? $CurrPosition = $ballot['questions']['id'];?>
					<? $OptionCount = $result['OptionCount'][$CurrPositionIndex][0]['option_count'];?>
					<? $CurrPositionIndex++;?>
					<tr>
						<td rowspan="<? echo $OptionCount; ?>" class="text-center"><? echo '<b>'.$ballot['questions']['text'].'</b>'; ?></td>
						<td><? echo $ballot['options']['text']; ?></td>
						<td class="text-center"><? echo $vote; ?></td>
					</tr>
				<? }else{;?>
					<tr>
						<td><? echo $ballot['options']['text']; ?></td>
						<td class="text-center"><? echo $vote; ?></td>
					</tr>
				<? };?>
				<? endforeach;?>
			</tbody>
		</table>
	</div>
</div>