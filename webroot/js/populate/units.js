var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
var UNITS = [];
var TYPEAHEAD_UNIT = [];
$(document).ready(function(){
//Get All Units
	$(document).bind('getAllUnits',function(){
		$.ajax({
			url:BASE_URL+'products/getUnits.json',
			method:'post',
			dataType:'json',
			success:function(json){
				UNITS = json.data;
				$.each(UNITS,function(ctr,obj){
					TYPEAHEAD_UNIT.push(obj.Unit.name);
				});
				$(".unit").typeahead({source: TYPEAHEAD_UNIT});
			}
		});
	}).trigger('getAllUnits');
	
	$('.unit').on('blur',function(){
		$('.unit_id').val('');
		var input= $(this).val();
		$.each(UNITS,function(i,o){
			if(o.Unit.name == input){
				$('.unit_id').val(o.Unit.id);
			}
		});
	});
});