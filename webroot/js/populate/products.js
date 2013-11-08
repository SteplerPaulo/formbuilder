/* Global Variable*/
var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
var TYPEAHEAD_ITEMS = [];
var INVENTORY = [];
$(document).ready(function(){
	//Get All Products
	$(document).bind('getProductItems',function(){
		$.ajax({
			url:BASE_URL+'products.json',
			method:'post',
			dataType:'json',
			success:function(json){
				INVENTORY = json.data;	
				$.each(json.data,function(ctr,obj){
					TYPEAHEAD_ITEMS.push(obj.Product.name);
				});
				$(".product_desc").typeahead({
					source: TYPEAHEAD_ITEMS,
					items: 4
				});
			}
		});
	}).trigger('getProductItems');
	
	//Get Prouduct Id(saving purpose)
	$('.product_desc').on('blur',function(){
		var input = $(this).val();
		$.each(INVENTORY,function(i,o){
			if(o.Product.name == input){
				$('.product_id').val(o.Product.id);
				$('.unit').val(o.Unit.name);
				$('.price').val(o.Product.selling_price);
			}
		});
	});
});