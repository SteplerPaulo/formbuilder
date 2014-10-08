$(document).ready(function(){
	//FORM SUBMIT EVENT
	$(document).on('click','#EvaluationFormSubmitButton',function(){
		if($('#EvaluationEvaluatorTypeId').val() !=''){
			$('#EvaluationForm').ajaxSubmit({
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
		$('#EvaluationEvaluatorTypeId').focus();
	});
	
	//VIEW EVALUATION RESULT
	$(document).on('click','.fe-result',function(){
		var action =$(this).attr('action');
		var row =$(this).parents('tr:first');
		var form_id =row.find('.form-id').text();
		var evaluatee_id =row.find('.evaluatee_id').text();
		$('#EvaluationFormId').val(form_id);
		$('#EvaluationEvaluateeId').val(evaluatee_id);
		
		
		$('#EvaluationResult').attr('action',action);
		$('#EvaluationResult').submit();
	});
});
