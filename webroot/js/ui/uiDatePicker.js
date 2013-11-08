$(document).ready(function(){
	var uiDatePickerConst = {
						'START':'-50',
						'END': '+0',					
						};
	$('.uiDatePicker').datepicker({
		dateFormat: 'yy-mm-dd',
		destroyed: true,
		yearRange:  uiDatePickerConst.START+':'+  uiDatePickerConst.END,
		changeMonth: true,
		changeYear: true,
	});
});