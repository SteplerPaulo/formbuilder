<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name forms">
									 <?php echo $this->Html->link( 'Quiz Result',
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
		
		
		<? echo '<b> Examinee Name: </b>'.$result['Quiz']['examinee'].'<br/>'; ?>
		<? echo '<b>Form Title: </b>'.$result['Form']['title'].'<hr/>'; ?>
			
			
		<table class="table table table-striped table-bordered" id="EvaluationTable">
			
			<thead>
				<tr>
					<th class="w40"><a >Quiz Item</a></th>
					<th class="w20 text-center"><a >Examinee Answer</a></th>
					<th class="w10 text-center"><a >Remarks</a></th>
					<th class="w10 text-center"><a >Point(s)</a></th>
				</tr>
			</thead>
			<tbody>
				<? $CurrDomainId = ''; ?>
				<? $score = 0; ?>
				<? foreach($result['QuizDetail'] as $r):?>
				<? if($r['Question']['domain_id'] != $CurrDomainId){; ?>
					<? $CurrDomainId = $r['Question']['domain_id']; ?>
					<tr class="error">
						<td colspan='5'><? echo '<b>'.$r['Question']['Domain']['name'].'</b>'; ?></td>
					</tr>
				<? };?>
					<tr>
						<td><? echo $r['Question']['text']; ?></td>
						<td><? echo $r['Option']['text']; ?></td>
						<td class="text-center"><? echo $r['Option']['remarks']; ?></td>
						<td class="text-center"><? echo $r['Option']['value']; ?></td>
						<?($r['Option']['value'])?$score+= $r['Option']['value']:$score+=0; ?>
					</tr>
				<? endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan='5'><? echo '<b> SCORE : '.$score.'</b>'; ?></td>
				</tr>
			</tfoot>
		</table>

	</div>
</div>