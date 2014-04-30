<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span8">		
				<div class="row-fluid">
					<div class="span2 module">
						<div class="module-wrap">
							<div class="module-name">
								<i class="icon-th-large"></i>
								Apps
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
 <!--Submodules-->
 <div class="row-fluid">
 	<div class="span12">
		<ul class="submodules">
			<li class="submodule">
				<div class="submodule-icon"><i class="icon-plus-sign"></i></div>
				<span class="submodule-name">Add App</span>
			</li>
			<li class="submodule">
				<div class="submodule-icon"><a href="/formbuilder/forms/create"><i class="icon-pencil"></i></a></div>
				<span class="submodule-name">Create Form</span>
			</li>
			
			<li class="submodule">
				<div class="submodule-icon"><a href="/formbuilder/forms"><i class="icon-list-alt icon-white"></i></a></div>
				<span class="submodule-name">Form List</span>
			</li>
			
			<li class="submodule">
				<div class="submodule-icon"><a href="/formbuilder/key_headers/generate_keys"><i class="icon-qrcode icon-white"></i></a></div>
				<span class="submodule-name">Generate Key</span>
			</li>
			
			<li class="submodule">
				<div class="submodule-icon"><a href="/formbuilder/key_headers"><i class="icon-file icon-white"></i></a></div>
				<span class="submodule-name">Key List</span>
			</li>
			
			
			<li class="submodule">
				<div class="submodule-icon"><a href="/formbuilder/forms/login"><i class="icon-lock icon-white"></i></a></div>
				<span class="submodule-name">Form Login</span>
			</li>
			
			<li class="submodule">
				<div class="submodule-icon"><a href="/formbuilder/quizzes/result"><i class="icon-folder-open icon-white"></i></a></div>
				<span class="submodule-name">Quiz Results</span>
			</li>
			
			<li class="submodule">
				<div class="submodule-icon"><a href="/formbuilder/evaluations/result"><i class="icon-folder-close icon-white"></i></a></div>
				<span class="submodule-name">Evaluation Results</span>
			</li>
			
			<li class="submodule">
				<div class="submodule-icon"><a href="/formbuilder/election_reports/result"><i class="icon-hdd icon-white"></i></a></div>
				<span class="submodule-name">Election Results</span>
			</li>
			
			<?php for($i=1;$i<0;$i++): ?>
			<li class="submodule">
				<div class="submodule-icon"><a href="#/"><i class="icon-check-empty"></i></a></div>
				<span class="submodule-name">Empty App</span>
			</li>
			<?php endfor; ?>
		</ul>
	</div>
 </div>