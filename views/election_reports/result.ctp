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
		<? echo ''.'<hr/>'; ?>
				
		<table class="table table table-striped table-bordered" id="EvaluationTable">
			
			<thead>
				<tr>
					<th class="w20 text-center"><a >Position</a></th>
					<th class="w50"><a >Candidate Name</a></th>
					<th class="w20 text-center"><a >Vote Count</a></th>
					<th class="w10 text-center"><a >Remarks</a></th>
					
				</tr>
			</thead>
			<tbody>
				<!--
				<? $CurrPosition = ''; ?>
				<? foreach($result['Ballot'] as $ballot):?>
				<? if($ballot['questions']['id'] != $CurrPosition){; ?>
					<? $CurrPosition = $ballot['questions']['id']; ?>
					<tr>
						<td rowspan="2" class="text-center"><? echo '<b>'.$ballot['questions']['text'].'</b>'; ?></td>
						<td><? echo $ballot['options']['text']; ?></td>
						<td class="text-center"><? echo ''; ?></td>
						<td></td>
					</tr>

				<? }else{;?>
					<tr>
						<td><? echo $ballot['options']['text']; ?></td>
						<td class="text-center"><? echo ''; ?></td>
						<td></td>
					</tr>
					
				<? };?>
				<? endforeach;?>
				-->
					<tr>
						<td rowspan="2" class="text-center">President</td>
						<td>Binay</td>
						<td class="text-center">100</td>
						<td class="text-center">Winner</td>
					</tr>
					<tr>
						<td>Bong</td>
						<td class="text-center">50</td>
						<td class="text-center"></td>
					</tr>
			</tbody>
		</table>

	</div>
</div>