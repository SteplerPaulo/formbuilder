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
			<div class="span3 pull-right  " id="Login">
						<div id="simple-root"></div> 	
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
				<span class="submodule-name">Form Create</span>
			</li>
			
			<li class="submodule">
				<div class="submodule-icon"><a href="/formbuilder/forms"><i class="icon-list-alt icon-white"></i></a></div>
				<span class="submodule-name">Form List</span>
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