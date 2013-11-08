$(document).ready(function(){
	//Initialize
	var header = $('#head-detail_form').attr('model');
	var detail = eval($('#head-detail_form').attr('model-detail'));
	var	currentHead = 0;	
	
	$(document).bind('request_content',function(evt,args){ //get headers
		console.log("passed here request_content");
		var col_count =  $('.HEADER tbody td').length;
		RECORD.setTemplate($('.HEADER').find('TBODY tr:first'));
		RECORD.setModel($('#head-detail_form').attr('model'));
		
		$('#GetAll').ajaxSubmit({
			dataType:'json',
			success:function(data){
				console.log('data', data);
				//Notify when no records found
				if(!data.length){
					$('.HEADER tfoot').fadeIn().html('<tr><td colspan="'+col_count+'" class="text-center"> <i class="icon-alert"></i> No record(s) found</td></tr>');
				}else{
					$('.HEADER').trigger('populate', {'data':data,'append':false});
					$('.HEADER tbody').fadeIn();
					$('.HEADER tfoot').fadeOut().empty();
				}
			}
		});
	
	})
	
	$(document).on('click','.action-details',function(){
		var recordId = $(this).parents('tr:first').attr('id');
		console.log('recordId',recordId);
		$('.HEADER').trigger('access',{'key':recordId});
		var rcrd = RECORD.getActive();
		
		console.log('template',RECORD.getTemplate().html());
		console.log('rcrd',rcrd[detail]);
		console.log('rcrd.length',rcrd[detail].length);
		
		$.each(detail,function(ctr, per_detail){
			var data=[];
			if(rcrd[per_detail].length){   //If having details
				console.log("contains");
				$.each(rcrd[per_detail],function(ctr, obj){
					RECORD.setTemplate($('.DETAIL[detail-attr="'+per_detail+'"]').find('TBODY tr:first'));
					//console.log($('.DETAIL[detail-attr="'+per_detail+'"]').find('TBODY tr:first').html());
					RECORD.setModel(per_detail);
					$('.DETAIL[detail-attr="'+per_detail+'"]').trigger('populate', {'data':rcrd[per_detail],'append':false, 'model':per_detail});
					console.log('obj',obj);
					
					
				});
				
				/* console.log('data',data);
				console.log('detail: ',per_detail) */;
				
			}
		});
		/* $('#head-detail_form').ajaxSubmit({
			dataType:'json',
			success:function(data){
				var col_count =  $('.DETAIL tbody td').length;
				console.log('data', data);
				//Notify when no records found
				if(!data.length){
					console.log('data.length');
					$.each(detail,function(ctr, obj){
						console.log('obj');
						RECORD.setTemplate($('.DETAIL[detail-attr="'+obj+'"]').find('TBODY tr:first'));
						RECORD.setModel(obj);
						console.log('hey', data[obj]);
						$('.DETAIL[detail-attr="'+obj+'"]').trigger('populate', {'data':data[obj],'append':false, 'model':obj});
						$('.DETAIL[detail-attr="'+obj+'"] tbody').fadeIn();
						$('.DETAIL[detail-attr="'+obj+'"] tfoot').fadeOut().empty();		
					});
					
				}
			}
		}); */
	});
	
	$(document).trigger('request_content');
});