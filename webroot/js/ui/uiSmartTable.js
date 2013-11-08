$(document).ready(function(){
	//UPDATE KEYS
	$('.smart_table').bind('update_table',function(evt,args){
		var index =  0;
		var THIS = this;
		$.each($(this).find('tbody tr'),function(i,e){
			$.each($(e).find('input[type="hidden"]'),function(j,f){
				var vname = $(f).attr('vname');
				$(f).attr('name',vname.replace('%',index));
			});
			index+=1;
		});
		$(THIS).find("tbody tr:odd").css('background-color','#f7f6f2');
		$(THIS).find("tbody tr:even").css('background-color','#ffffff');
	});
	//DELETE ROW
	$(document).on('click','.smart_table .delete_row',function(){
		var PARENT = $(this).parent().parent().parent().parent();
		$(this).parent().parent().fadeOut('slow').remove();
		PARENT.trigger('update_table');
	});
});