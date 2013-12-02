$(document).ready(function(){
	
	//LOGIN EVENT
	$(document).on('click','#LogInButton',function(){
		$('#EvaluationLogInForm').ajaxSubmit({
			dataType:'json',
			success:function(formReturn){
				
				if(formReturn.data){
					$('#FormId').val(formReturn.data.KeyHeader.form_id);
				
					var action ='/formbuilder/evaluations/form';
					$('#FormAction').attr('action',action);
					$('#FormAction').submit();
				}else{
					alert('Invalid log in key');
				}
			}
		});
	});

	//FORM SUBMIT EVENT
	$(document).on('click','#EvaluationFormSubmitButton',function(){
		$('#EvaluationForm').ajaxSubmit({
				dataType:'json',
				success:function(formReturn){
					$('#Notification').html(formReturn.msg);
					$('#Modal').modal('show'); 
					if(formReturn.status){
						setTimeout(function(){
							var action ='/formbuilder/evaluations/log_in';
							$('#FormAction').attr('action',action);
							$('#FormAction').submit();
						},1500);
					
					}
				}
		});
	});
	


	

	//FORM SUBMIT EVENT
	$(document).on('click','.test',function(){
		
		$('#EvaluationFormTest').ajaxSubmit();
	});
	
});
