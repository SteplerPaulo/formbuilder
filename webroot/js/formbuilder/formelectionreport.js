$(document).ready(function(){
	//FORM SUBMIT EVENT
	$(document).on('click','#FormSubmitButton',function(){
		//if($('#QuizExaminee').val() !=''){
			$('#ElectionReportForm').ajaxSubmit({
				dataType:'json',
				success:function(formReturn){
					$('#Notification').html(formReturn.msg);
					$('#Modal').modal('show'); 
					if(formReturn.status){
						setTimeout(function(){
							var action ='/formbuilder/forms/login';
							$('#FormAction').attr('action',action);
							$('#FormAction').submit();
						},1500);
					}
				}
			});
			return;
		//}
		//$('#QuizExaminee').focus();
	});
	
	//VIEW ELECTION REPORT RESULT
	$(document).on('click','.fer-result',function(){
		var action =$(this).attr('action');
		var row =$(this).parents('tr:first');
		var form_id =row.find('.form-id').text();
		$('#ElectionReportFormId').val(form_id);
		$('#ElectionReportResult').attr('action',action);
		$('#ElectionReportResult').submit();
	});
});
