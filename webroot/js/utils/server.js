
$(document).ready(function(){
	var server_date =   new Date($('body').attr('server-date'));
	$('.server-time').val(server_date);
	now = new Date(server_date.getTime()+1000);
	
	$('.server-date-time').val(now.getFullYear()+"-"+now.getMonth()+1+"-"+now.getDate()+" "+now.getHours()+":"+now.getMinutes()+":"+now.getSeconds());

});
 
