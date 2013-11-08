$(document).ready(function(){
	$('.uiSmartList').attr('link_to',function(){
		//Disable all lists except ROOT
		$($(this).attr('link_to')).attr('disabled','disabled');
	}).live('change',function(){
		//Collect variables to comparison
		var LINK_TO = $(this).attr('link_to');
		var C = $(this).find('option:selected').attr('class').split(" ")[0];
		var CLASS = '.'+C;
		
		if(C){
			$(LINK_TO+' option:not('+CLASS+')').hide();
			$(LINK_TO+' option'+CLASS).show();
			$(LINK_TO).attr('disabled','');
			$(LINK_TO+' option:first').show().attr('selected','selected');
		}else{
			$(LINK_TO+' option').hide();
			$(LINK_TO+' option:first').show().attr('selected','selected');
			$(LINK_TO).attr('disabled','disabled').change();
			return;
		}
		if($(LINK_TO+' option'+CLASS).length>1){
			$(LINK_TO+' option:first').show().attr('selected','selected');
			$(LINK_TO).attr('disabled','');
		}else{			
			$(LINK_TO+' option'+CLASS+':first').show().attr('selected','selected');
			if($(LINK_TO+' option'+CLASS).length<=1){
				$(LINK_TO).attr('disabled','disabled').change();
			}
			
		}
		$(LINK_TO).change();
	});
});