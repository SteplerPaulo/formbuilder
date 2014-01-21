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
		
		
		<? echo '<b> Examinee Name: </b>'.$result[0]['quizzes']['examinee'].'<br/>'; ?>
		<? echo '<b>Form Title: </b>'.$result[0]['forms']['title'].'<hr/>'; ?>
			
			
		<table class="table table table-striped table-bordered" id="EvaluationTable">
			
			<thead>
				<tr>
					<th class="w40"><a >Quiz Item</a></th>
					<th class="w20 text-center"><a >Examinee Answer</a></th>
					<th class="w20 text-center"><a >Correct Answer</a></th>
					<th class="w10 text-center"><a >Remarks</a></th>
					<th class="w10 text-center"><a >Point(s)</a></th>
				</tr>
			</thead>
			<tbody>
				<? $CurrDomainId = ''; ?>
				<? $score = 0; ?>
				<? foreach($result as $r):?>
				<? if($r['domains']['id'] != $CurrDomainId){; ?>
					<? $CurrDomainId = $r['domains']['id']; ?>
					<tr class="error">
						<td colspan='5'><? echo '<b>'.$r['domains']['name'].'</b>'; ?></td>
					</tr>
				<? };?>
					<tr>
						<td><? echo $r['questions']['text']; ?></td>
						<td><? echo $r['options']['text']; ?></td>
						<td><? echo $r['correct_answer']['text']; ?></td>
						<td class="text-center"><? echo $r[0]['result']; ?></td>
						<td class="text-center"><? echo ($r['options']['text']==$r['correct_answer']['text'])?$r['correct_answer']['value']:'0'; ?></td>
						<?($r[0]['result'])?$score+= $r['options']['value']:$score+=0; ?>
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