$(document).ready(function(){
	//FORM SUBMIT EVENT
	$(document).on('click','#EvaluationFormSubmitButton',function(){
		if($('#EvaluationEvaluatee').val() !=''){
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
		$('#EvaluationEvaluatee').focus();
	});
	
	//VIEW EVALUATION RESULT
	$(document).on('click','.fe-result',function(){
		var action =$(this).attr('action');
		var row =$(this).parents('tr:first');
		var form_id =row.find('.form-id').text();
		var evaluatee =row.find('.evaluatee').text();
		$('#EvalautionFormId').val(form_id);
		$('#EvalautionEvalautee').val(evaluatee);
		
		$('#EvalautionResult').attr('action',action);
		$('#EvalautionResult').submit();
	});
});
