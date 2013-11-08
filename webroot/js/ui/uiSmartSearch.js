/*use in finding matched within a List*/

$(document).ready(function(){

function toTitleCase(str){
    return str.charAt(0).toUpperCase()+str.substring(1);
}


function toProperCase(txt){
	var proper = '';
	txt = txt.toString();
	var temp = txt.split(' ');
	$.each(temp,function(ctr, o){
		proper+=o.charAt(0).toUpperCase()+o.substring(1).toLowerCase()+' ';
	
	})
	//console.log(proper);
	return $.trim(proper);
};
//console.log(toProperCase('walrus h. Haler'));

$('.uiSmartSearch').keyup(function(evt, args){
        var searchKey = $.trim($(this).val());
        var searchOn = $(this).attr('search-on');
        var isNull = (searchKey==''); 
        var isNumeric = !isNaN(parseInt(searchKey));      
        if(isNull){ 
            $(searchOn).show(); 
        }else{    
                searchKey = toProperCase(searchKey);
				$(searchOn).hide();
				//console.log($(searchOn).find('input[value^='+searchKey+']').parents('li'));
                $(searchOn).find('input[value^="'+searchKey+'"]').parents('li').show();
                //console.log($(searchOn).find('input[value^="'+searchKey+'"]'));
        }
		//console.log(searchKey);
    });
        
});