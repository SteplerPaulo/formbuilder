var EvalutionType = 3;
var SurveyType = 2;
var QuizType = 1;

$(document).ready(function(){
	//LOGIN EVENT
	$(document).on('click','#LogInButton',function(){
		if($('#FormKey').val()){	
			$('#FormLogin').ajaxSubmit({
				dataType:'json',
				success:function(formReturn){
					if(formReturn.data){
						$('#FormId').val(formReturn.data.KeyHeader.form_id);
						$('#ObjectId').val(formReturn.data.Key.id);
						
						if(formReturn.data.Key.status == '1'){
							alert('Warning: Used key');
							return;
						}
						
						if(formReturn.data.KeyHeader.Form.form_type_id==EvalutionType){
							var action ='/formbuilder/evaluations/form';
							$('#FormAction').attr('action',action);
							$('#FormAction').submit();
						}
						else if(formReturn.data.KeyHeader.Form.form_type_id==QuizType){
							var action ='/formbuilder/quizzes/form';
							$('#FormAction').attr('action',action);
							$('#FormAction').submit();
						}else if(formReturn.data.KeyHeader.Form.form_type_id==SurveyType){
							alert('This key is use for survey form type which is under constraction.Please contact developer for inquiries.');
						}
					}else{
						alert('Invalid log in key');
					}
				}
			});
		}else{
			$('#FormKey').focus();
		}
	});
});