$(document).ready(function(){
var perRow;

$('.RECORD').bind('populate',function(event,data){
	var TABLE = $(this);
	var checkRow = TABLE.find('tr:nth(1)');
	var ToPOPU = data.data;
	var embedJSON = data.embedJSON;
	var append = data.append;
	var findTemp = TABLE.find('.temp');
	
	//TABLE.find('tr:nth(1)').remove();
	
	if(checkRow.length){  // if doesnt have a copy of row copy first row	
		perRow = TABLE.find('tr:nth(1)').clone();
		$(perRow).removeClass('temp');
	}
	
	if(!append){  //if append false
		$('.RECORD').trigger('clear');
		console.log('data Received on TableUI: ', ToPOPU);
		for(var i=0;i<ToPOPU.length; i++){
			$.each(ToPOPU[i], function(c,o){
				$.each(o, function(ctra,obja){
					try{
						fieldIt(perRow,c,ctra, ToPOPU[i][c][ctra]);
					}catch(err){
						console.log(err);
					}
				});
			});
			if(embedJSON){
				perRow.attr('data', JSON.stringify(ToPOPU[i]));
			}
			$(perRow).clone().appendTo('.RECORD');
			$(perRow).find('span[data-field]').html('');
		}
	}else{
		//console.log('data Received on TableUI: ', ToPOPU);
		for(var i=0;i<ToPOPU.length; i++){
			$.each(ToPOPU[i], function(c,o){
				$.each(o, function(ctra,obja){
					try{
						fieldIt(perRow,c,ctra, ToPOPU[i][c][ctra]);
					}catch(err){
						console.log(err);
					}
				});
			});
			if(embedJSON){
				perRow.attr('data', JSON.stringify(ToPOPU[i]));
			}
			//console.log('$(perRow)',$(perRow));
			$(perRow).clone().appendTo('.RECORD tbody');
			$(perRow).find('span[data-field]').html('');
		}	
	}
	
	if(findTemp){
		findTemp.remove();
		$('tr').find('button[disabled]').removeAttr('disabled');
	}
	TABLE.trigger('afterPOPU');
	
}).bind('clear', function(event, data){
	$(this).find('tbody:first').html('');
})




});
function fieldIt(row,model,field,rowData){
	this.field = $(row).find('span[data-field="'+model+'.'+field+'"]');
	this.rowData = rowData;
	this.inputExist = this.field.find('input');
	this.inputExist = this.inputExist.length;
	this.selectExist = this.field.find('select');
	this.selectExist = this.selectExist.length;
		
	if(this.inputExist){
		this.field.find('input:first').val(rowData);
	}else{
		if(this.selectExist){
			this.field.find('select:first').val(rowData);
		}else{
			this.field.html(rowData);
		}
	}
}