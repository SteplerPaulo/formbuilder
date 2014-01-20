	<style>
		#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
		#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
		#sortable li span { position: absolute; margin-left: -1.3em; }
	</style>
	<script>
	  $(function() {
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
	  });
	</script>
<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span8">		
				<div class="row-fluid">
					<div class="span2 module">
						<div class="module-wrap">
							<div class="module-name">
								<i class="icon-th-large"></i>
								Sortable
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

<div class="row-fluid">
 	<div class="span12">
		<br/>
		<ul id="sortable">
		  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
		  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
		  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
		  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
		  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
		  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
		  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>
		</ul>
	</div>
</div>
 
 