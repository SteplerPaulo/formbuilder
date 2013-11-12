$(document).ready(function(){
	//FB Action
	$(document).on('click','.fb-action',function(){
		var action =$(this).attr('action');
		var row =$(this).parents('tr:first');
		var form_id =row.find('.form-id').text();
		$('#FormId').val(form_id);
		
		
		$('#FormAction').attr('action',action);
		$('#FormAction').submit();
	});
	
	//FB More Action
	$(document).on('click','.fb-more-action',function(){
		var object_id =$(this).attr('object-id');
		$('#FormId').val(object_id);
		
		var action =$(this).attr('action');
		$('#FormAction').attr('action',action);
		$('#FormAction').submit();
	});
	
	//FB Add Action Link
	$(document).on('click','.fb-add-action',function(){
		var object_id =$(this).attr('object-id');
		$('#ObjectId').val(object_id);
		
		var action =$(this).attr('action');
		$('#FormAction').attr('action',action);
		$('#FormAction').submit();
	});
	
	
	
	
	//Workplace Edit Link
	$(document).on('click','.fb-workplace-edit',function(){
		var object_id =$(this).attr('object-id');
		$('#ObjectId').val(object_id);

		var action =$(this).attr('action');
		$('#FormAction').attr('action',action);
		$('#FormAction').submit();
	});
	
	//Workplace Delete Link
	$(document).on('click','.fb-workplace-delete',function(){
		$('#Modal').modal('show');
		$('.fb-workplace-confirm-delete-button').removeAttr('disabled');
		var object_id =$(this).attr('object-id');
		var action =$(this).attr('action');
		
		$('.fb-workplace-confirm-delete-button').click(function(){
			$('#ObjectId').val(object_id);
			$('#FormAction').attr('action',action);
			$('#FormAction').ajaxSubmit({
				dataType:'json',
				success:function(formReturn){
					$('#Notification').html(formReturn.msg).slideDown().delay(5000).slideUp();
					$('.fb-workplace-confirm-delete-button').attr('disabled','disabled');
				}
			});
		});
	});
	
	
	//Edit Files Save Button //Save & Return
	$(document).on('click','.fb-edit-save-button',function(){
		var form = $(this).parents('form:first');
		form.ajaxSubmit();
		var action ='/formbuilder/forms/workplace';
		$('#FormAction').attr('action',action);
		$('#FormAction').submit();
	});
	
	//Create Files Save Button
	$(document).on('click','.fb-create-save-button',function(){
		var form = $(this).parents('form:first');
		
		if (form[0].checkValidity()) {
			form.ajaxSubmit({
				dataType:'json',
				success:function(formReturn){
					console.log(formReturn);
					modal_builder(formReturn);
					form[0].reset();
				}
			});
		}else{
			$('#Notification').html("<img src='/lib/img/icons/exclamation.png'/>&nbsp;Please fill out required fields.");
			$.each(form.find('[required="required"]'),function(i,o){
				$(o).attr('placeholder','Please fill out this field').focus();
			});
		}
	});
});



function modal_builder(formReturn){
	var model = $('#Modal').parents('form:first').attr('parent-model');
	$('#'+model+'Id').val(formReturn.data[model+'']['id']);
	$('#Notification').html(formReturn.msg);
	$('#Modal').modal('show');
}