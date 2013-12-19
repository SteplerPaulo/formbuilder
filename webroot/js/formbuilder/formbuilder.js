$(document).ready(function(){
	
	//FB Form Action
	$(document).on('click','.fb-action',function(){
		var action =$(this).attr('action');
		var row =$(this).parents('tr:first');
		var form_id =row.find('.form-id').text();
		$('#FormId').val(form_id);
		($(this).attr('newtab'))?$('#FormAction').attr('target','_blank'):$('#FormAction').removeAttr('target');
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
	
	//Worksheet Add Link
	$(document).on('click','.fb-worksheet-add',function(){
		var object_id =$(this).attr('object-id');
		$('#ObjectId').val(object_id);

		var action =$(this).attr('action');
		$('#FormAction').attr('action',action);
		$('#FormAction').submit();
	});
	
	//Worksheet Edit Link
	$(document).on('click','.fb-worksheet-edit',function(){
		var object_id =$(this).attr('object-id');
		$('#ObjectId').val(object_id);

		var action =$(this).attr('action');
		$('#FormAction').attr('action',action);
		$('#FormAction').submit();
	});
	
	//Worksheet Delete Link
	$(document).on('click','.fb-worksheet-delete',function(){
		delete_all_button_toggle($(this).attr('option'));
		
		$('#Modal').modal('show');
		
		var is_form_delete= $(this).attr('form');
		var object_id =$(this).attr('object-id');
		var question_option_id =$(this).attr('question-option-id');
		var action =$(this).attr('action');
		$('#ObjectId').val(object_id);
		$('#QuestionOptionId').val(question_option_id);
		$('#FormAction').attr('action',action);
		
		$('.fb-worksheet-confirm-delete-button').click(function(){
			$('#DeleteType').val($(this).attr('delete-type'));
			$('#FormAction').ajaxSubmit({
				dataType:'json',
				success:function(formReturn){
					$('#Notification').html(formReturn.msg).slideDown().delay(5000).slideUp();
					if(formReturn.status){
						goto_formlist(is_form_delete);
					}
						
					setTimeout(function(){
						goto_worksheet();
					},1000);
				}
			});
			
		});
	});
	
	//Edit Files Save Button
	$(document).on('click','.fb-edit-save-button',function(){
		var form = $(this).parents('form:first');
		if (form[0].checkValidity()) {
			form.ajaxSubmit();
			goto_worksheet();
		}else{
			$.each(form.find('[required="required"]'),function(i,o){
				$(o).attr('placeholder','*Required').focus();
			});
		}
	});
	
	//Create Files Save Button
	$(document).on('click','.fb-create-save-button',function(){
		var form = $(this).parents('form:first');
		
		if (form[0].checkValidity()) {
			form.ajaxSubmit({
				dataType:'json',
				success:function(formReturn){
					
					if(form.attr('id') =="FormAddForm"){
						$('#FormId').val(formReturn.data.Form.id);
						//console.log(form.attr('id') +' FormAddForm');
						//console.log(formReturn.data.Form.id);
					}
					modal_builder(formReturn);
					form[0].reset();
				}
			});
		}else{
			$('#Notification').html("<img src='/lib/img/icons/exclamation.png'/>&nbsp;Please fill out required fields.");
			$.each(form.find('[required="required"]'),function(i,o){
				$(o).attr('placeholder','*Required').focus();
			});
		}
	});

	//Go To Worksheet Event
	$(document).on('click','.fb-goto-worksheet-button',function(){
		goto_worksheet();
	});

	$(document).on('click','.fb-option-setting',function(){
		var opt_cog = $(this).attr('option-cog');
		$('#OptionCog').val(opt_cog);
		
		var action =$(this).attr('action');
		$('#FormAction').attr('action',action);
		$('#FormAction').submit();
	});
});

function delete_all_button_toggle(is_option){
	if(is_option){
		$('.fb-worksheet-confirm-delete-button[delete-type="all"]').show();
	}else{
		$('.fb-worksheet-confirm-delete-button[delete-type="all"]').hide();
	}
}

function goto_formlist(is_form_delete){
	if(is_form_delete){
		setTimeout(function(){
			location.reload();
		},500);
		return;
	}
}

function goto_worksheet(){
		var action ='/formbuilder/forms/worksheet';
		$('#FormAction').attr('action',action);
		$('#FormAction').submit();
}

function modal_builder(formReturn){
	var model = $('#Modal').parents('form:first').attr('parent-model');
	$('#'+model+'Id').val(formReturn.data[model+'']['id']);
	$('#Notification').html(formReturn.msg);
	$('#Modal').modal('show');
}