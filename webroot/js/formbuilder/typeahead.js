$(document).ready(function(){
	//GET ITEM
	

	$.ajax({
		url:'/formbuilder/options',
		method:'post',
		dataType:'json',
		success:function(result){			
			console.log(result);
			PRODUCT_ITEMS = result;
		}
	});


	//PRODUCT TYPEAHEAD HANDLER
	$('#OptionText').typeahead({
		source: function (query, process) {
			products = [];
			object = {};
			$.each(PRODUCT_ITEMS, function (i, o) {
				object[o.Option.text] = {
											"id": o.Option.id, "text": o.Option.text, 
											"value": o.Option.value,
											"is_correct": o.Option.is_correct
										};
				products.push(o.Option.text);
			});
			process(products);
		},
		matcher: function (item) {
			if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
				return true;
			}else{
				$('#OptionId').val('');
				$('#OptionValue').val('');
				$('#OptionIsCorrect').prop('checked', 0);
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
			$('#OptionId').val(object[item].id);
			$('#OptionValue').val(object[item].value);
			$('#OptionIsCorrect').prop('checked', parseInt(object[item].is_correct));
			return item;
		},
		items:4,
	});
	
});