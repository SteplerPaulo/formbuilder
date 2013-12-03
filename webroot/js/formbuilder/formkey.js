var BASE_URL = '/'+window.location.pathname.split('/')[1]+'/';
$('document').ready(function(){
	//FB Form Action
	$(document).on('click','.fb-action',function(){
		var action =$(this).attr('action');
		var row =$(this).parents('tr:first');
		var keyheader_id =row.find('.keyheader-id').text();
		$('#KeyHeader').val(keyheader_id);
		
		$('#KeyHeaderAction').attr('action',action);
		$('#KeyHeaderAction').submit();
	});

	$(document).on('click','.fb-print-action',function(){
		var action =$(this).attr('action');
		$('#KeyHeaderAction').attr('action',action);
		$('#KeyHeaderAction').submit();
	});
	
	
	
	//Go Button 
	$('#GoEncryptButton').click(function(){
		$(document).trigger('collect_selected_option_value');
		var form= $(this).parents("form:first");
		var count= $('#KeyHeaderIntentKeyCount').val();
		
		$.ajax({
			url:BASE_URL+'key_headers/login_key_encryption',
			type:'post',
			data:{'data':{'no_of_requested_key':count}},
			success:function(data){
					var json = $.parseJSON(data);
					$('#GeneratedKeyTable tbody').hide().html('');
					var row ='';
					$.each(json, function(ctr,obj){
						
						if(ctr%2 == 0){
							row +='<tr>';
							row += '<td class="text-right">'+(ctr+1)+'</td><td>'+obj+'</td>';
							row += '<td class="hide"><input value="'+obj+'" name="data[Key]['+ctr+'][value]"></input></td>';
						}else{
							row += '<td class="text-right">'+(ctr+1)+'</td><td>'+obj+'</td>';
							row += '<td class="hide"><input value="'+obj+'" name="data[Key]['+ctr+'][value]"></input></td>';
							row +='</tr>';
						}
						

					});
					$('#GeneratedKeyTable tbody').html(row).show();
				}
		});
	});
	
	$('#Submit').click(function(){
		$('#KeyHeaderAddForm').ajaxSubmit({
			dataType:'json',
			success:function(formReturn){
				if(formReturn.status){
					$('#GeneratedKeyTable tbody').fadeIn('slow').html('');
				}
				$('#Notification').html(formReturn.msg).slideDown().delay(5000).slideUp();
				
				
			}
		});
	});
	
	
});
	 