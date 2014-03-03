var EvalutionType = 3;
var ElectionBallotType = 2;
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
						}
						else if(formReturn.data.KeyHeader.Form.form_type_id==QuizType){
							var action ='/formbuilder/quizzes/form';
						}else if(formReturn.data.KeyHeader.Form.form_type_id==ElectionBallotType){
							var action ='/formbuilder/election_reports/form';
						}
						$('#FormAction').attr('action',action);
						$('#FormAction').submit();
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