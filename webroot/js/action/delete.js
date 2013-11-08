/* Global Variable*/
var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';

$(document).ready(function(){	
	//Delete Header
	$(document).on('click','.header-delete',function(){
	
		setTimeout(function(){
			$('.intent-save').hide();
			$('.intent-delete').show();
			$('#intent-modal .modal-header').find('.intent-text,.intent-object').hide();
			$('#intent-modal .modal-header .intent-notify').append('<h3 class="warning">Delete Item</h3>')
		},100)
		
		var row =$(this).parents('tr:first');
		row.find('.action-view').click();
		var id  = $('.header_id').val();
		var model = $('[action].canvasFormHeader').attr('action').split('/')[2]+'/';
		//on delete
		$(document).on('click','.confirm-header-delete',function(){	
			$.ajax({
				url:BASE_URL+model+'delete/'+id,
				method:'POST',
				dataType:'json',
				success:function(data){
					$('.canvasForm').trigger('request_content',{'init':true});
				}
			});
		});
	});
	
	
	//Delete Detail
	$(document).on('click','.detail-delete',function(){
		setTimeout(function(){
			$('.intent-save').hide();
			$('.intent-delete').show();
			$('.detail-modal .modal-header').find('.intent-text,.intent-object').hide();
			$('.detail-modal .modal-header .intent-notify').append('<h3 class="warning">Delete Item</h3>');
		},100)
		var row =$(this).parents('tr:first');
		row.find('.action-edit').click();
		
		var id = $('.detail_id').val();
		var model = $('[action].canvasFormDetail').attr('action').split('/')[2]+'/';
		
		var product_id = $('.product_id').val();
		$.each(INVENTORY,function(i,o){ // INVENTORY =>from product.js
			if(product_id == o.Product.id){
				$('.product_desc').val(o.Product.name);
			}
		});
		

		//on delete
		$(document).on('click','.confirm-detail-delete',function(){	
			$.ajax({
				url:BASE_URL+model+'/delete/'+id,
				method:'POST',
				dataType:'json',
				success:function(data){
					$('.canvasForm').trigger('request_content');
				}
			});
		});
	});
});
	