var BASE_URL = '/'+window.location.pathname.split('/')[1]+'/';
$('document').ready(function(){
	//FB Form Action
	$(document).on('click','.fb-action',function(){
		var action =$(this).attr('action');
		var row =$(this).parents('tr:first');
		var keyheader_id =row.find('.keyheader-id').text();
		$('#KeyHeader').val(keyheader_id);
		($(this).attr('newtab'))?$('#KeyHeaderAction').attr('target','_blank'):$('#KeyHeaderAction').removeAttr('target');
		$('#KeyHeaderAction').attr('action',action);
		$('#KeyHeaderAction').submit();
	});

	$(document).on('click','.fb-print-action',function(){
		var action =$(this).attr('action');
		$('#KeyHeaderAction').attr({'action':action,'target':'_blank'});
		$('#KeyHeaderAction').submit();
	});
	
	//Go Button 
	$('#GoEncryptButton').click(function(){
		var form_id = $('#KeyHeaderFormId').val();
		var count= $('#KeyHeaderIntentKeyCount').val();
		if(form_id && count){
			$.ajax({
				url:BASE_URL+'key_headers/login_key_encryption',
				type:'post',
				data:{'data':{'no_of_requested_key':count}},
				beforeSend: function(){
					$('#GeneratedKeyTable tbody').hide().html('');
					$('#GeneratedKeyTable tfoot td').html("<center>Generating... <img src='/formbuilder/img/icons/black-loader.gif' style='height: 25px' /><center>").fadeIn();
				},
				success:function(data){
						var json = $.parseJSON(data);
						$('#GeneratedKeyTable tfoot td').html('');
						var row ='';
						$.each(json, function(ctr,obj){
							if(ctr%2 == 0){
								row +='<tr>';
								row += '<td class="">'+(ctr+1)+'.</td><td>'+obj+'</td>';
								row += '<td class="hide"><input value="'+obj+'" name="data[Key]['+ctr+'][value]"></input></td>';
							}else{
								row += '<td class="">'+(ctr+1)+'.</td><td>'+obj+'</td>';
								row += '<td class="hide"><input value="'+obj+'" name="data[Key]['+ctr+'][value]"></input></td>';
								row +='</tr>';
							}
						});
						$('#GeneratedKeyTable tbody').html(row).show();
					}
			});
		}else if(!form_id){
			$('#KeyHeaderFormId').focus();
			return;
		}else if(!count){
			$('#KeyHeaderIntentKeyCount').focus();
			return;
		}
	});
	
	$('#Submit').click(function(){
		$('#KeyHeaderAddForm').ajaxSubmit({
			dataType:'json',
			success:function(formReturn){
				if(formReturn.status){
					$('#GeneratedKeyTable tbody').fadeIn('slow').html('');
				}
				$('#Notification').html(formReturn.msg).slideDown().delay(4000).slideUp();
				
				
			}
		});
	});
});
	 