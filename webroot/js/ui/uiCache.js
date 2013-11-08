//CACHE CONTAINERS
var CACHE = [];
var CACHE_INDEX;
var CACHE_DETAILS = {};
var IS_ADJUSTMENT = false;
var CACHE_INPUTS="";
	
function init_cache_model(model){CACHE_MODEL = model}
function init_cache_table_id(table_id){CACHE_TABLE_ID = table_id}	
function init_cache_form_id(form_id){CACHE_FORM_ID = form_id}

$(document).ready(function(){

	//GET CACHE INPUTS
	$(document).bind('get_cache_inputs',function(){
		var CACHE_INPUTS_COUNT = $(CACHE_FORM_ID+' .modal-body input').length;
		$.each($(CACHE_FORM_ID+' .modal-body input'),function(ctr,inp){
			CACHE_INPUTS += '#'+$(inp).attr('id');
			if(CACHE_INPUTS_COUNT != ctr+1) CACHE_INPUTS += ','
		});	
	}).trigger('get_cache_inputs');
	
	//DETAILS INPUT Event Handler
	$(''+CACHE_INPUTS+'').change(function(){
		compute_amount();
		data_collector();
	});

	//RESET CACHE CONTAINERS
	$(document).on('click','.reset-cache',function(){
		CACHE = [];
		CACHE_DETAILS = {};
		CACHE_INDEX;
		IS_ADJUSTMENT =  false;
	});
	
	//PUSH data from DB to CACHE
	$(document).on('click','.push-new-cache',function(){
		var record = RECORD.getActive();		
		$.each(record[CACHE_MODEL],function(i,o){
			CACHE.push(o);
		});
		
	});
	
	//ACTION ADJUST Event Handler 
	$(document).on('click','.intent-adjust-detail',function(){
		IS_ADJUSTMENT = true;
		CACHE_INDEX = $(this).parents('tr:first').index();//use to access element on CACHE
		
		
		$('#AlterableButton').text('Confirm Adjustment').removeClass('add-detail delete-detail').addClass('adjust-detail');
		data_collector();
	});

	//ADD SIGN Event Handler
	$(document).on('click','.intent-add-detail',function(){
		IS_ADJUSTMENT = false;

		$('#AlterableButton').text('Add To Detail').removeClass('adjust-detail delete-detail').addClass('add-detail');
	});
	
	//ACTION DELETE Event Handler
	$(document).on('click','.intent-delete-detail',function(){
		CACHE_INDEX = $(this).parents('tr:first').index();//use to access element on CACHE

		$('#AlterableButton').text('Confirm Delete').removeClass('add-detail adjust-detail').addClass('delete-detail');
	});
	
	//ADD DETAIL Event Handler
	$(document).on('click','.add-detail, .adjust-detail',function(){

		data_creator();
		data_populator();
		data_registrator();
	});
	
	//CONFIRM DELETE Event Handler (DETAIL DELETE)
	$(document).on('click','.delete-detail',function(){
		//Delete on DataBase
		$(CACHE_FORM_ID).ajaxSubmit();
		//End
		
		//Delete on CACHE
		CACHE.splice(CACHE_INDEX, 1);//remove specific element from CACHE
		//End
		
		//Rebuild Detail's Table
		if(!CACHE.length){
			$(CACHE_TABLE_ID).trigger('reset');
		}else{
			data_populator();
			data_registrator();
		}
		
		//Remove Attribute Disable
		$(CACHE_FORM_ID).find('input,select').removeAttr('disabled');
	
	});
	
	//INTENT CANCEL Handler
	$(document).on('click','.intent-cancel',function(){
		$(CACHE_FORM_ID).find('input,select').removeAttr('disabled');
	});
	
	//COLLECT DATA FOR CACHE
	function data_collector(){
		CACHE_DETAILS = {};//Avoid Detail Duplication
	
		$.each($(CACHE_FORM_ID+' .modal-body input'),function(ctr,inp){
			var model = $(inp).attr('name').split('[')[1].replace(']','');
			var field = $(inp).attr('name').split('[')[2].replace(']','');
			var value = $(inp).val();
			
			if(!CACHE_DETAILS[model]){
				CACHE_DETAILS[model]= {};
			}
			CACHE_DETAILS[model][field] =value;
			
		});	
	}
	
	//CREATE or ADJUST CACHE 
	function data_creator(){
		if(!IS_ADJUSTMENT){	//PUSH NEW CACHE DETAILS
			CACHE.push(CACHE_DETAILS);
		}else{						//REPLACE CACHE DETAILS
			CACHE[CACHE_INDEX] = CACHE_DETAILS;
		}
	}
	
	//POPULATE CACHE
	function data_populator(){

		//Set modal
		RECORD.setModel('Product');
		
		//POPULATE CACHE on DETAIL TABLE
		$(CACHE_TABLE_ID).trigger('preload');
		$(CACHE_TABLE_ID).trigger('populate', {'data':CACHE,'append':false});
		$(CACHE_TABLE_ID).trigger('showRecord',{'advancedtable':false});
	}
	
	//RECORD CACHE ON RECORD.GETACTIVE();
	function data_registrator(){
		$.each(CACHE,function(i,d){
			var RECID = RECORD.getPrefix()+RECORD.getIndex();
			RECORD.register(RECID,d);
			RECORD.setActive(RECID);
		});
	}
	
	function compute_amount(){
		$('#Amount').val($("#Qty").val()*$("#SRP").val());//Compute Amount
	}
});