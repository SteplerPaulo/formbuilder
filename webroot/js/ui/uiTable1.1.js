//DATA COUNT
var DATACOUNT
$(document).ready(function(){
	
	function ActiveRecord(){
		this.record_reg={};
		this.record_lkup = {};
		this.templates={};
		var active_record;
		var record_tmplt;
		var record_ctr=0;
		var record_prfx = 'RCRD';
		var record_mdl = null;
		this.setModel = function(model){
			record_mdl = model;
		}
		this.getTemplate = function(){
			return record_tmplt;
		}		
		this.setTemplate = function(template){
			record_tmplt =  template;
		}
		this.getPrefix =  function(){
			return record_prfx;
		}
		this.getIndex =  function(){
			return record_ctr++;
		}
		this.register  =  function(key,value){
			this.record_reg[key]=value;
			this.record_lkup[value[record_mdl]['id']]=key;
			
		}
		this.getRegistry =  function(){
			return this.record_reg;
		}
		this.getLookUp =  function(){
			return this.record_lkup;
		}
		this.getActive = function(){
			return active_record;
		}
		this.setActive = function(key){
			active_record = this.record_reg[key];
		}
	}
	var RECORD = window.RECORD =  new ActiveRecord();
	
	$('.RECORD').bind('init',function(event,data){
		var TABLE = $(this);
		if(!TABLE.find('tfoot').length){
			TABLE.append('<tfoot></tfoot>');
		}
		var clone =TABLE.find('tbody tr:nth(0)').clone();
		clone.removeAttr('style').find('td').removeClass('negative');
		clone.find('.money').removeAttr('data-mbid').removeAttr('data-value').removeAttr('attr-text');
		RECORD.setTemplate(clone);
	}).bind('populate',function(event,data){
		var RECORD =  window.RECORD;
		var TABLE = $(this);
		var ToPOPU = data.data;
		var embedJSON = data.embedJSON;
		var append = data.append;
		var model = data.model;
		TABLE.trigger('init');
		if(!append){  //if append false
			TABLE.trigger('clear');		
		}
		if(!model){
			for(var i=0;i<ToPOPU.length; i++){
				$.each(ToPOPU[i], function(c,o){
					$.each(o, function(ctra,obja){
						try{
							fieldIt(RECORD.getTemplate(),c,ctra, ToPOPU[i][c][ctra],i);
						}catch(err){
							console.log(err);
						}
					});
				});
				var RECID = RECORD.getPrefix()+RECORD.getIndex();
				RECORD.register(RECID,ToPOPU[i]);
				$(RECORD.getTemplate()).clone().attr("id",RECID).appendTo(TABLE);
				$(RECORD.getTemplate()).find('span[data-field]>input,span[data-field]>select')?$(RECORD.getTemplate()).find('span[data-field]>input,span[data-field]>select').val(''):$(RECORD.getTemplate()).find('span[data-field]').html('');
			}
		}else{
			var modelIs={};
			for(var i=0;i<ToPOPU.length; i++){
				$.each(ToPOPU[i], function(c,o){
					try{
						fieldIt(RECORD.getTemplate(),model,c,ToPOPU[i][c],i);
					}catch(err){
						console.log(err);
					}
				});
				
				modelIs[model]=ToPOPU;
				var RECID = RECORD.getPrefix()+"DTL"+RECORD.getIndex();
				RECORD.register(RECID,modelIs);
				$(RECORD.getTemplate()).clone().attr("id",RECID).appendTo(TABLE);
				$(RECORD.getTemplate()).find('span[data-field]>input,span[data-field]>select')?$(RECORD.getTemplate()).find('span[data-field]>input,span[data-field]>select').val(''):$(RECORD.getTemplate()).find('span[data-field]').html('');
			}
		
		}	
		TABLE.trigger('afterPOPU');	
	}).bind('clear', function(event, data){
		$(this).find('tbody:first').html('');
	}).bind('access',function(evt,args){
		RECORD.setActive(args.key);
	}).bind('preload',function(evt,args){
		var canvas =  this;
		var col_count =  $(canvas).find('tbody td').length;
		var args =  args|| {'html':'<tr class="preloader"><td colspan="'+col_count+'" class="text-center"> <i class="icon-refresh icon-spin"></i> Loading...</td></tr>'};
		$(canvas).find('tbody').hide();
		$(canvas).find('tfoot').fadeIn().html(args.html);

	}).bind('emptyRecord',function(evt,args){
		var canvas = this;
		var col_count =  $(canvas).find('tbody td').length;
		var args =  args||{'html':'<tr><td colspan="'+col_count+'" class="text-center"> <i class="icon-alert"></i> No record(s) found</td></tr>'};
		$(canvas).find('tfoot').fadeIn().html(args.html);
		if($(canvas).find('tbody td span').find('inpunt,select')){
			$(canvas).find('tbody td span').find('inpunt,select').val('');
		}else{
			$(canvas).find('tbody td span').empty();
		}
				
	}).bind('showRecord',function(evt,args){
		var canvas = this;
		var advancedtable = args?args.advancedtable:true;
		var meta = args?args.meta:null;
		$(canvas).find('tbody').fadeIn();
		if(advancedtable){
			$(canvas).advancedtable({'searchField':'#search-box','meta':meta});	
		}else{
			$(canvas).find('tfoot').fadeOut();
		}
		$(canvas).trigger('recordShown');
	}).bind('init_async',function(evt,args){
		var canvas = this;
		var args =  args||{'html':'Still loading...'};
		$(canvas).find('tfoot tr.preloader>td').html(args.html);
	}).bind('update_async',function(evt,args){
		var canvas = this;
		var args =  args||{'percentage':100,'msg':'<i class="icon-cog icon-spin"></i> Generating preview'};
		$(canvas).find('tfoot tr.preloader>td div.progress>div.bar').css({'width':(args.percentage+'%')});
		
		if(args.percentage==100){
			$(canvas).find('tfoot tr.preloader>td div.progress').slideUp('slow');
			$(canvas).find('tfoot tr.preloader>td div.message').html(args.msg);
		}else if(args.percentage == Infinity){
			$(canvas).find('tfoot tr.preloader>td div.progress').slideUp();
			$(canvas).find('tfoot tr.preloader>td div.message').html('No Data Available');
		}else{
			$(canvas).find('tfoot tr.preloader>td div.message span.msg').html(args.msg);
		}
	});
	$('.RECORD').trigger('init');
	
	function fieldIt(row,model,field,rowData,index){
		if(rowData instanceof Object){
			$.each(rowData,function(fld,rd){
				fieldIt(row,model,field+'.'+fld,rd,index);
			});
		}
		var rowData = rowData;
		var fields = $(row).find('*[data-field="'+model+'.'+field+'"]'); //Catch all corresponding elements
		$.each(fields,function(_if,_vf){ //Loop on fields to ensure all elements are populated
			var field = $(_vf); //Initialize jquery object
			var inputExist = field.find('input');
			var inputExist = inputExist.length;
			var selectExist = field.find('select');
			var selectExist = selectExist.length;
			if(inputExist){
				field.find('input:first').val(rowData);
				if(field.find('input:first').attr('vname')){
					var vname = field.find('input:first').attr('vname');
					field.find('input:first').attr('name',vname.replace('%',index));
				}
			}else{
				if(selectExist){
					field.find('select:first').val(rowData);
				}else{
					field.html(rowData);
					
				}
			}
		});
	}
});
