$(document).ready(function(){

	$(document).on('click','.form-builder-action',function(){
		var action =$(this).attr('action');
		var row =$(this).parents('tr:first');
		var form_id =row.find('.form-id').text();
		$('#FormId').val(form_id);
		
		
		$('#FormAction').attr('action',action);
		$('#FormAction').submit();
	});

	//
	$(document).on('click','.form-builder-save',function(){
		var form = $(this).parents('form:first');
		
		_modal();
		//_save(form);
	});
	
	function _save(form){
		if (form[0].checkValidity()) {
			form.ajaxSubmit({
				dataType:'json',
				success:function(formReturn){
					$('.notif').html(formReturn.msg).slideDown().delay(2000).slideUp();
					form[0].reset();
				}
			});
		}else{
			$('.notif').html("<img src='/lib/img/icons/exclamation.png'/>&nbsp;Please fill out required fields.").slideDown().delay(2000).slideUp();
			$.each(form.find('[required="required"]'),function(i,o){
				$(o).attr('placeholder','Please fill out this field').focus();
			});
		}
	}
	
	function _modal(){
	
	}
})