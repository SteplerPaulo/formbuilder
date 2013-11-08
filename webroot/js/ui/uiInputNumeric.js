$(document).ready(function(){
	var dot_count = 0;
	var MONEY_ROUND = 2;
	//Set input box to be masked as numeric
	$(document).on('keydown','.numeric',function(e){
		if($(this).val()==''){
			dot_count = 0;
		}
		var key = e.which;
		if(e.shiftKey){
		e.preventDefault();
		}
		if(key>=46 && key<=57 || key>=37 && key<=57 || key>188 && key<191 || key==8 || key>=96 && key<=105 || key==190||key==110||key==13 || key ==9){
			//Keycode for period 
			if(key==190||key==110){
				dot_count += 1;
				if(dot_count>1){
					e.preventDefault();
				}
			}
		}else{
			e.preventDefault();
		}
	});
	$(document).on('blur','.monetary',function(){
		var value =  parseFloat($(this).val());
		if(!isNaN(value)){
				$(this).val(ssUtil.roundNumber(value,MONEY_ROUND));
			}
	});
});