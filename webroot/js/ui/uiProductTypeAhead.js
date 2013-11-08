$(document).ready(function(){
	//GET ALL PRODUCT ITEM ON DB
	$.ajax({
		url:BASE_URL+'products/search',
		method:'post',
		dataType:'json',
		success:function(result){					
			PRODUCT_ITEMS = result;
		}
	});

	//PRODUCT TYPEAHEAD HANDLER
	$('#ProductName').typeahead({
		source: function (query, process) {
			products = [];
			object = {};
			$.each(PRODUCT_ITEMS, function (i, o) {
				object[o.Product.name] = {
											"id": o.Product.id, "name": o.Product.name, 
											"icode": o.Product.item_code, "srp": o.Product.selling_price, 
											"unit_name": o.Unit.name,"unit_id": o.Unit.id,
											'srp':o.Product.selling_price
											};
				products.push(o.Product.name);
			});
			process(products);
		},
		matcher: function (item) {
			if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
				return true;
			}else{
				$('#ProductId').val('');
				$('#ProductItemCode').val('').removeAttr('readonly');
				$('#UnitName').val('');
				$('#UnitId').val('');
				$('#SRP').val('');
			}
		},
		sorter: function (items) {
			return items.sort();
		},
		highlighter: function (item) {
			var regex = new RegExp( '(' + this.query + ')', 'gi' );
			return item.replace( regex, "<strong>$1</strong>" );
		},
		updater: function (item) {
			$('#ProductId').val(object[item].id);
			$('#ProductItemCode').val(object[item].icode).attr('readonly','readonly');
			$('#UnitName').val(object[item].unit_name);
			$('#UnitId').val(object[item].unit_id);
			$('#SRP').val(object[item].srp);
			return item;
		},
		items:4,
	});
	
});