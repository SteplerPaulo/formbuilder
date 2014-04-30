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
		<? echo ''.'<hr/>'; ?>
				
		<table class="table table table-striped table-bordered" id="ElectionReportTable">
			<thead>
				<tr>
					<th class="w20 text-center"><a >Position</a></th>
					<th class="w50"><a >Candidate Name</a></th>
					<th class="w20 text-center"><a >Vote Count</a></th>
					<th class="w10 text-center"><a >Remarks</a></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$votes = array();
					foreach($result['Return'] as $return){
						$votes[$return['options']['id']]=$return['options']['value'];
					}
				?>
				<? $PrevTitle = $CurrTitle=$result['Ballot'][0]['questions']['text'];$PrevPosition = $CurrPosition = $result['Ballot'][0]['questions']['id']; $columns = array();?>
				<? for($i=0;$i<count($result['Ballot']);$i++):?>
					<?php
					
						$ballot = $result['Ballot'][$i]; //Ballot entry
						$CurrPosition = $ballot['questions']['id'];
						$CurrTitle = $ballot['questions']['text'];
						$vote = isset($votes[$ballot['options']['id']])?$votes[$ballot['options']['id']]:0;
						//Mark up for a column
						$markup='<td>'.$ballot['options']['text'].'</td>';
						$markup.='<td class="text-center">'.$vote. '</td>';
						$markup.='<td></td>';

						if($PrevPosition != $CurrPosition||$i==count($result['Ballot'])-1){
							if($i==count($result['Ballot'])-1) array_push($columns,$markup); //Push last element
							foreach($columns as $ii=>$c){
								echo '<tr>'; //Start row
								if($ii==0) echo '<td rowspan="'.count($columns).'" >'.$PrevTitle.'</td>';	//Display Position
								echo $c; //Display content
								echo '</tr>'; //End row
							}
							$columns = array(); //Reset columns
							if($i!=count($result['Ballot'])-1) $i--; //One step backward
						}else{
							array_push($columns,$markup); //Push element to update markup
						}
						
						$PrevPosition = $CurrPosition; //Update PrevPosition
						$PrevTitle = $CurrTitle; //Update PrevTitle
					?>
				<? endfor;?>
			</tbody>
		</table>
	</div>
</div>