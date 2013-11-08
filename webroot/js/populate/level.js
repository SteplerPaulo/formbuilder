/* Global Variable*/
var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
var LEVEL = [];
$(document).ready(function(){
	//Populate Level
	$.ajax({
		url:'/profile/levels.json',
		method:'post',
		dataType:'json',
		success:function(json){
			LEVEL = json.data;
			$('.level').html('<option division-code="" value="">Select</option>');
			$.each(json.data,function(ctr,obj){ 
				$('.level').append('<option value="'+obj.Level.id+'">'+ obj.Level.name +'</option>');
			}); 
		}
	});
	

	
	//Level string/ use for meta saving
	$('.level').on('change',function(){
		var input = $(this).val();
		$.each(LEVEL,function(i,o){
			if(o.Level.id == input){
				$('.level_str').val(o.Level.department_id+' / '+o.Level.name);
			}
		});	
	});
	$('.level').on('blur',function(){
		var input = $(this).val();
		$.each(LEVEL,function(i,o){
			if(o.Level.id == input){
				$('.level_str').val(o.Level.department_id+' / '+o.Level.name);
			}
		});	
	});
});