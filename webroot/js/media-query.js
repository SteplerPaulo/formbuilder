$('document').ready(function(){

	
//	$(window).resize(function(){
		//console.log("Window's width =>"+parseInt($(".window-min-width").css("width")));
		if(parseInt($(".window-min-width").css("width")) < 1178){
			
			
			$.each($('label+span'),function(i,d){
				$(this).prev().andSelf().wrapAll('<div class="row-fluid">');
			});
			$.each($('label+div'),function(i,d){
				$(this).prev().andSelf().wrapAll('<div class="row-fluid">');
			});
			
			
			
			
			$('.modal').find('label').css({'text-align':'left','width':'100px'});

			for(i=1;i<=12;i++){
				$('.modal').find('input,select').removeClass('span'+i);
			}
			for(i=1;i<=100;i++){
				$('.modal').find('input,select').removeClass('w'+i);
			}

			$('.modal input:not(.input-append)').addClass('w68');
			$('.modal select:not(.input-append)').addClass('w70');
			$('.modal .input-append').find('input').addClass('w63');
		}
	//});
});