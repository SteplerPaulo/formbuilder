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
		
		
		<?php echo '<b> Examinee Name: </b>'.$result['Quiz']['examinee'].'<br/>'; ?>
		<?php echo '<b>Form Title: </b>'.$result['Form']['title'].'<hr/>'; ?>
			
			
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
				<?php $CurrDomainId = ''; ?>
				<?php $score = 0; ?>
				<?php foreach($result['QuizDetail'] as $r):?>
				<?php if($r['Question']['domain_id'] != $CurrDomainId){; ?>
					<?php $CurrDomainId = $r['Question']['domain_id']; ?>
					<tr class="error">
						<td colspan='5'><?php echo '<b>'.$r['Question']['Domain']['name'].'</b>'; ?></td>
					</tr>
				<?php };?>
					<tr>
						<td><?php echo $r['Question']['text']; ?></td>
						<td><?php echo $r['Option']['text']; ?></td>
						<td class="text-center"><?php echo $r['Option']['remarks']; ?></td>
						<td class="text-center"><?php echo $r['Option']['value']; ?></td>
						<?php ($r['Option']['value'])?$score+= $r['Option']['value']:$score+=0; ?>
					</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan='5'><?php echo '<b> SCORE : '.$score.'</b>'; ?></td>
				</tr>
			</tfoot>
		</table>

	</div>
</div>