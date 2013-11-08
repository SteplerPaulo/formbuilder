$(document).ready(function(){
	var $top1= $('.actions-container').offset().top-20;
	$(window).scroll(function(){
		if($(window).scrollTop()>=$top1) { 
			$('.actions-container').addClass('fixed');
			$('.info-spacer').removeClass('hidden');
		}else{ 
			$('.actions-container').removeClass('fixed'); 
			$('.info-spacer').addClass('hidden');
		}
	});
	$('.content>div').css('opacity','100');
	$('ul.submodules>li').hide();
	$.each($('ul.submodules>li'),function(i,e){
		$(e).delay(300+(50*i)).slideDown('fast');
	});
	//PopOver
	$("[rel='popover']").popover({
            html: 'true',
			delay: { show: 1000, hide: 100 }
    });
	
	
	
	//Active dropdown
	/*$('.dropdown-toggle').click(function(){
		
		$(this).find('i.icon-cog').toggleClass('icon-spin');
		$('.not(.open).dropdown-toggle').find('i.icon-cog').removeClass('icon-spin');
	});*/
});