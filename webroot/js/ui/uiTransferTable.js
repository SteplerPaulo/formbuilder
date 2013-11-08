$(document).ready(function(){
	$('.transfer_table').bind('transfer',function(evt,args){
		var transfer  = $(this).attr('transfer_to');
		var ticker = args.ticker;
		var record = args.record;
		$(ticker).removeAttr('checked');
		$(record).fadeOut('slow',function(){
			var c =$(record).clone();
			$(c).appendTo(transfer).fadeIn('slow');
			$(record).remove();
		});
		
		
	});
	$('.transfer_table').find('.ticker').live('change',function(){
		var ticker = $(this);
		var record =  $(this).parent().parent();
		var table =  $(this).parent().parent().parent().parent();
		$(table).trigger('transfer',{'record':record,'ticker':ticker});
	});
});