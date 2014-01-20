

<style type="text/css">
.well {
	width:336px;height:69px;padding:10px;border:1px solid #aaaaaa;
}

.q:active{
	padding: 10px;
	border: 1px solid #aaaaaa;
}
</style>
<script>
function allowDrop(ev){
	ev.preventDefault();
}

function drag(ev){
	ev.dataTransfer.setData("Text",ev.target.id);
}

function drop(ev){
	ev.preventDefault();
	var data=ev.dataTransfer.getData("Text");
	ev.target.appendChild(document.getElementById(data));
}
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
	

		<br><br>
		<div class="well" ondrop="drop(event)" ondragover="allowDrop(event)">
			<span id="q1" class="q" draggable="true" ondragstart="drag(event)">Question 1 </span>
		</div>
		
		<div class="well" ondrop="drop(event)" ondragover="allowDrop(event)">
			<span id="q2" class="q" draggable="true" ondragstart="drag(event)">Question 2 </span>
		</div>
		
		

	</div>
 </div>