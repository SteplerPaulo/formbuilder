$(document).ready(function() {
	$('.tab').css('display','block');
	
	$.each($('.tab .tab-header'),function(i,o){
		if($(o).parent().find('.tab-content').hasClass('off')){
			$(o).find('.indicator').text('+');
		}
	});
	$(document).on('click','.tab-header',function(){
		var src = $(this);
		var dis = $(src).find('.indicator').text();
		$(src).find('.indicator').text(dis=='+'?'-':'+');
		$(this).parent().find('.tab-content').slideToggle(300).toggleClass('on').toggleClass('off');		
		}
	 );
});