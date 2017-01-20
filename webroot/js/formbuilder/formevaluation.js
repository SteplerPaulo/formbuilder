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
		var evaluatee_id =row.find('.evaluatee_id').text();
		var evaluatee =row.find('.evaluatee').text();
		var school_year_id =row.find('.school_year_id').text();
		var school_year =row.find('.school_year').text();
		var period_id =row.find('.period_id').text();
		var period =row.find('.period').text();
		var educ_level_id =row.find('.educ_level_id').text();
		var educ_level =row.find('.educ_level').text();
		$('#EvaluationFormId').val(form_id);
		$('#EvaluationEvaluateeId').val(evaluatee_id);
		$('#EvaluationEvaluatee').val(evaluatee);
		$('#EvaluationSchoolYearId').val(school_year_id);
		$('#EvaluationSchoolYear').val(school_year);
		$('#EvaluationPeriodId').val(period_id);
		$('#EvaluationPeriod').val(period);
		$('#EvaluationEducLevelID').val(educ_level_id);
		$('#EvaluationEducLevel').val(educ_level);
		
		
		$('#EvaluationResult').attr('action',action);
		$('#EvaluationResult').submit();
	});
});
