$(document).ready(function(){
	function Treeish(){
		this.active={'level':0,'parent':0, 'root':0};
		var path = [];
		this.addPath =  function(key,value){
			path.push(value);
		}
		this.getPath =  function(){
			return path;
		}
		this.popPath =  function(){
			path.pop();
		}
		this.showPath =  function(target){
			
			var codePath =[];
			$(target).empty();
			$.each(path,function(i,obj){
				$(target).append('<li> <a>'+obj.name+'</a></li>'+(i<path.length-1?' <i class="icon-arrow-right"> </i> ':''));
				codePath.push(obj.code);
			});
			
			
			code_Path =  codePath.join('-');
			$('.tree-mother').empty();
			if(codePath.length<1){
				$('.tree-mother').hide();	
				$('.tree-mother').val('');	
			}else{	
				$('.tree-mother').val(code_Path).html('<strong>'+code_Path+'</strong>');
				$('.tree-mother').show();
			}
			
		}
		this.updateModal =  function(modal,record){
			var keys =  !record? {'level':'level_index','parent':'parent_index','root':'root_index'} :null;
			var values = !record?this.active:null;
			if(!record){
				$.each(keys,function(k,v){
					$(modal).find('input[name*="'+v+'"]').val(values[k]);
				});
			}else{
				$.each(record,function(mdl,content){
					$.each(content,function(fld,v){
						if(v instanceof Object){
							if(v.value instanceof Array){
								//Display content for value pair if array
								$.each(v.value,function(indx,val){
									$(modal).find('input[name*="['+mdl+']['+fld+'][value]['+indx+']"],select[name*="['+mdl+']['+fld+'][value]['+indx+']"]').val(val);
								});
							}else{
								//Display content for value pair
								$(modal).find('input[name*="['+mdl+']['+fld+'][value]"],select[name*="['+mdl+']['+fld+'][value]"]').val(v.value);	
							}
							//Display content for key pair
							$(modal).find('input[name*="['+mdl+']['+fld+'][key]"],select[name*="['+mdl+']['+fld+'][key]"]').val(v.key);
							$(modal).find('input[name*="['+mdl+']['+fld+'][id]"],select[name*="['+mdl+']['+fld+'][id]"]').val(v.id);
						}else{
							//Display content regular
							$(modal).find('input[name*="['+mdl+']['+fld+']"],select[name*="['+mdl+']['+fld+']"]').val(v).change();
							$(modal).find('span.uneditable-input[data-field="'+mdl+'.'+fld+'"]').text(v);
						}
					});
				});
			}
			if(!record){
				this.active=  values;
			}
			$(document).trigger('updateModal');
		}
	}
	$(document).bind('updateModal', function(){});
	var TREE =  window.TREE =  new Treeish();
	var RECORD = window.RECORD;
	//Initialize
	var parent_index = TREE.active.parent =  $('#tree_parent').val();
	var level_index = TREE.active.level =  $('#tree_level').val();
	var model = $('#tree_form').attr('model');
	$(document).bind('request_tree',function(evt,args){
		console.log('args',args);
		TREE.active.root = 1;
		if(!args.refresh){
			if(args.hasOwnProperty('parent')){  //check parent
				$('#tree_parent').val(args.parent);
			}
			if(args.hasOwnProperty('level')){ //check level
				$('#tree_level').val(args.level);
			}
			if(args.hasOwnProperty('order_by')){ //check order
				console.log('has order');
				$('#tree_order').val(args.order);
			}
		}
		
		var col_count =  $('.RECORD tbody td').length;
		$('#tree_form').ajaxSubmit({
			beforeSend:function(){
				$('.RECORD tbody').hide();
				$('.RECORD tfoot').fadeIn().html('<tr><td colspan="'+col_count+'" class="text-center"> <i class="icon-refresh icon-spin"></i> Loading...</td></tr>');
			},
			dataType:'json',
			success:function(data){
				//Notify when no records found
				if(!data.length){
					$('.RECORD').trigger('emptyRecord');
				}else{
					$('.RECORD').trigger('populate', {'data':data,'append':false});
					$('.RECORD').trigger('showRecord');
				}
				//Update RECORD active
				var lookup =  RECORD.getLookUp();
				if(data.length){
					RECORD.setActive(lookup[data[0][model]['parent_index']]);
				}
				//Update TREE path
				var active = RECORD.getActive();
				if(!args){
					args={};
					args.reverse = false;
				}
				if(active&&!args.reverse&&!args.refresh){
					TREE.addPath(active[model]['id'],{'name':active[model]['description'],'code':active[model]['mothercode']});				
				}
				if(active){
					if(active[model]['level_index']==1){
							TREE.active.root = active[model]['id'];
					}else if(active[model]['level_index']>1){
						TREE.active.root = active[model]['root_index'];
					}		
				}
				
				$(document).trigger("request_tree_finish");
			},
		});
	
	}).bind('request_content', function(){
	
	});
	$(document).on('click','.action-view',function(){
		var key =  $(this).parents('tr:first').attr('id');
		var data = $('.RECORD').trigger('access',{'key':key});
		var record =  window.RECORD.getActive();
		var parent =  record[model]['id'];
		var level =  parseInt(record[model]['level_index'])+1;
		TREE.active.parent = parent;
		TREE.active.level =  level;
		
		$(document).trigger('request_tree',{'parent':parent,'level':level});
	});
	$(document).on('click','.action-edit',function(){
		var key =  $(this).parents('tr:first').attr('id');
		var data = $('.RECORD').trigger('access',{'key':key});
		var record =  window.RECORD.getActive();
		
		TREE.updateModal($('#intent-modal'),record);
		var f = $('#intent-modal').parents('form:first');
		var m = f.attr('model');
		f.attr('action',BASE_URL+m+'/edit');
		$('#intent-modal').modal('show');
				
	});
	$(document).on('click','.action-delete',function(){
		$('input[type="text"],select').attr('disabled','disabled');
		var key =  $(this).parents('tr:first').attr('id');
		var oldrecord = window.RECORD.getActive();
		var data = $('.RECORD').trigger('access',{'key':key});
		var record =  window.RECORD.getActive();
		//Revert to parent index
		var lookup =  RECORD.getLookUp();
		RECORD.setActive(lookup[oldrecord[model]['id']]);
		TREE.updateModal($('#intent-modal'),record);
		var f = $('#intent-modal').parents('form:first');
		var m = f.attr('model');
		f.attr('action',BASE_URL+m+'/delete');
		$('.intent-save').text('Delete');
		$('#intent-modal').modal('show');
				
	});
	
	$(document).on('click','.tree-back',function(){
		var record  = window.RECORD;
		var active =  record.getActive();		
		TREE.popPath();
		//Redirect to apps menu
		if(!active){
			window.location=BASE_URL+"pages/display/apps";
		}else{
			var parent =  active[model]['parent_index'];
			var level =  active[model]['level_index'];
			TREE.active.parent = parent;
			TREE.active.level =  level;
			$(document).trigger('request_tree',{'parent':parent,'level':level,'reverse':true});
		}
	});
	$(document).on('click', '#intent-create,.action-edit,.action-delete', function(){
		if($('.HierchList')){
			TREE.showPath($('.HierchList'));
		}
			TREE.updateModal($('#intent-modal'));
			if(!$(this).hasClass('action-delete')){
				$('input[type="text"],select').removeAttr('disabled');
				$('.intent-save').text('Save');
			}
			$('.intent-save').removeAttr('disabled');
	});
	
	//Initialize
	RECORD.setModel(model);
	$('#intent-back').addClass('tree-back');
	$(document).trigger('request_tree',{'parent':parent_index,'level':level_index});
});