$(document).ready(function(){
	$(document).bind('quick_scroll',function(evt,args){
	
		var offset = $(args.target).offset().top;
		switch(args.speed){
				case undefined:
					speed = 500;
					break;
				case 'slow':
					speed=1000;
					break;
				case 'fast':
					speed = 250;
					break;
		}
		$('html,body').animate({scrollTop:offset},speed);
	});
});
