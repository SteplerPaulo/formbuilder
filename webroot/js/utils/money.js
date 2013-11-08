$(document).ready(function(){
	window.MoneyBank = [];
	$(document).bind('honey-money',function(){
		$.each($('div.money,span.money'),function(c,o){
			var MBID = window.MoneyBank.length;
			var mbid =  $(o).attr('data-mbid');
			var hasChanged = false;
			var monetary =  parseFloat($(o).text());
			if(isNaN(monetary))  monetary = 0;
			if($(o).parent().hasClass('negative')) monetary*=-1;
			if(mbid==undefined){
				$(o).attr('data-mbid',MBID);
				MoneyBank[MBID] = monetary;
				hasChanged = true;
			}else if(MoneyBank[mbid]!=monetary ){
				hasChanged = true;
			}
			if(hasChanged){
				var v  = monetary<0? Math.abs(monetary).toFixed(2) : monetary.toFixed(2);
				$(o).text(v);
				if(monetary<0){
					$(o).parent().addClass('negative');
				}else{
					$(o).parent().removeClass('negative');
				}
			}	
		});
	});	
	setInterval(function(){$(document).trigger('honey-money')},100);
});