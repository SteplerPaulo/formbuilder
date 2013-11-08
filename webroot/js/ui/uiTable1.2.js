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
	


	
	/****************************************UPDATE TABLE**********************************************/
	$('.RECORD').bind('populate', function(evt,args){
		TABLE = $(this);

		var json = args.data;
		var ToPOPU = json;
		var columns = $(TABLE).find('tbody td');

		var data_columns = [];
		$.each(columns,function(index,item){
			var data_field = $(item).find('>:first-child').attr('data-field');
			var elem = $(item).clone();
			if(data_field){
				data_field =  data_field.split(".");
				data_columns.push({'model':data_field[0],'field':data_field[1],'attr':data_field[2],'elem':elem});
			}else{
				data_columns.push({'model':null,'field':null,'attr':null,'elem':elem});
			}
		});

		$(TABLE).dataTable().fnClearTable();
		console.log(json);
		$.each(json,function(i,o){
		
			var mark_up = [];
			$.each(data_columns,function(index,item){
				var model = item.model;
				var field =  item.field;
				var attr =  item.attr;
				var elem =  item.elem;
				
				if(model!=null){
					var value =  ToPOPU[i][model][field];
					if(value instanceof Object){
						if(attr){
							elem.find('>:first-child').text(value[attr]);
						}else{
							elem.find('>:first-child').text(value);
						}
					}else{
						elem.find('>:first-child').text(value);
					}
					
					
				}
				mark_up.push(elem.html());
			});
			
			var RECID = RECORD.getPrefix()+RECORD.getIndex();
			RECORD.register(RECID,ToPOPU[i]);
			
				
			
			var a = $(TABLE).dataTable().fnAddData(mark_up);
			var nTr = $(TABLE).dataTable().fnSettings().aoData[ a[0] ].nTr;
			$($(TABLE).dataTable().fnSettings().aoData[ a[0] ].nTr).attr("id",RECID);
			$('td', nTr)[0].setAttribute( 'class', 'id hide');	
			$(TABLE).find('tbody td span[data-field="ChecklistDetail.checklist_id"]').parent().addClass('hide');
			$(TABLE).find('tbody input.text-center,tbody span.text-center').parent().addClass('text-center');
			$(TABLE).find('tbody input.text-left,tbody span.text-left').parent().addClass('text-left');
			$(TABLE).find('tbody input.text-right,tbody span.text-right').parent().addClass('text-right');
		});	
	}).bind('access',function(evt,args){
		RECORD.setActive(args.key);
	}).bind('emptyRecord',function(evt,args){
		var canvas = this;
		var col_count =  $(canvas).find('tbody td').length;
		var args =  args||{'html':'<tr><td colspan="'+col_count+'" class="text-center"> <i class="icon-alert"></i> No record(s) found</td></tr>'};
		$(canvas).find('tbody').hide();
		$(canvas).find('tfoot').fadeIn().html(args.html);
		$(canvas).find('tbody td span').empty();
		
				
	}).bind('showRecord',function(evt,args){
		var canvas = this;
		$(canvas).find(' tbody').fadeIn();
		$(canvas).find(' tfoot').fadeOut().empty();
	}).bind('clear', function(evt, args){
		$(this).find('tbody:first').html(RECORD.getTemplate());
		
	});

	//SAVE
	$(document).bind('request_content', function(e){
		$(document).trigger('UpdateProductsTable');
	});
	
	
	
});

