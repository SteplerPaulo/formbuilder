$(document).ready(function(){
	$('.uiDumbList').bind('clone_list',function(evt,args){
		var THIS = this;
		var LISTEN = $(THIS).attr('listen_to');
		$(LISTEN).change(function(){
			$(THIS).empty();
			var DISABLED = $(this).is(':disabled');
			var ACTOR = $(this);
			$.each(ACTOR.find('option'),function(i,e){
				if(e.style.display!='none'){
					$(THIS).append($(e).clone());
				}
			});
			if(DISABLED){
				$(THIS).attr('disabled','disabled');
			}else{
				$(THIS).removeAttr('disabled');
			}
		});
	});
	$('.uiDumbList').attr('listen_to',function(){
		$(this).trigger('clone_list');
	}).change(function(){
		var THIS = this;
		var LISTEN = $(THIS).attr('listen_to');
		
		$(LISTEN).change(function(){
			$(THIS).val($(this).val());
		});
		$(LISTEN).val($(THIS).val()).change();
	});
});