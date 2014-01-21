$(document).ready(function(){
	//FORM SUBMIT EVENT
	$(document).on('click','#FormSubmitButton',function(){
		if($('#QuizExaminee').val() !=''){
			$('#QuizForm').ajaxSubmit({
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
		}
		$('#QuizExaminee').focus();
	});
	
	//VIEW QUIZ RESULT
	$(document).on('click','.fq-result',function(){
		var action =$(this).attr('action');
		var row =$(this).parents('tr:first');
		var form_id =row.find('.form-id').text();
		var examinee =row.find('.examinee').text();
		$('#QuizFormId').val(form_id);
		$('#QuizExaminee').val(examinee);
		
		$('#QuizResult').attr('action',action);
		$('#QuizResult').submit();
	});
});
