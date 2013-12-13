$(document).ready(function(){
	//LOGIN EVENT
	$(document).on('click','#LogInButton',function(){
		if($('#EvaluationKey').val()){	
			$('#EvaluationLoginForm').ajaxSubmit({
				dataType:'json',
				success:function(formReturn){
					if(formReturn.data){
						$('#FormId').val(formReturn.data.KeyHeader.form_id);
						$('#ObjectId').val(formReturn.data.Key.id);

						if(formReturn.data.Key.status == '1'){
							alert('Key already used');
							return;
						}
						
						if(formReturn.data.KeyHeader.Form.form_type_id==3){
							var action ='/formbuilder/evaluations/form';
							$('#FormAction').attr('action',action);
							$('#FormAction').submit();
						}else if(formReturn.data.KeyHeader.Form.form_type_id==2){
							alert('This key is use for survey form type which is under constraction.Please contact developer for more info.');
						}else if(formReturn.data.KeyHeader.Form.form_type_id==1){
							alert('This key is use for quiz form type which is under constraction.Please contact developer for more info.');
						}
					}else{
						alert('Invalid log in key');
					}
				}
			});
		}else{
			$('#EvaluationKey').focus();
		}
	});

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
								var action ='/formbuilder/evaluations/login';
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
	
	//View Evaluation Result
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
