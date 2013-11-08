$(document).ready(function(){
	$('.canvasForm').bind('request_content',function(evt,args){
		var form =  $(this);
		var model = form.attr('model');
		var canvas = form.attr('canvas');
		var in_modal = $(canvas).parents('.modal:first');
		var args = args||{'init':false};
		var no_details = $(canvas).find('tfoot tr.no-details').html();
		if(no_details){
			var template = JSON.stringify({'html':no_details});
			form.attr('template',template);
		}
		form.ajaxSubmit({
			dataType:'json',
			beforeSend:function(){
				$(canvas).trigger('preload');
			},
			success:function(data){
				if(!data.length && data instanceof Array){
					if(form.attr('template')){
						var template = $.parseJSON(form.attr('template'));
						$(canvas).trigger('emptyRecord',{'html':template.html});
					}else{
						$(canvas).trigger('emptyRecord');
					}
					
				}else{
					RECORD.setModel(model);
					if(data.meta){
						$(canvas).trigger('init_async',{html:'<div class="well"><div class="progress progress-warning progress-striped active"> <div class="bar" style="width:0%;"></div></div><div class="message"><i class="icon-refresh icon-spin"></i> <span class="msg"></span></div></div>'});
						async_data(window.location.origin+form.attr('action'),data.meta,data.data,canvas);
					}else{
						$(canvas).trigger('populate', {'data':data,'append':false});
						$(canvas).trigger('showRecord');
					}
					
				}
				if(in_modal&&!args.init){
					in_modal.modal('show');
				}
			}
		});
	});
	function async_data(url,meta,data,canvas){
		$(canvas).trigger('update_async',{percentage:(meta.page/meta.count)*100,msg:'Loading '+Math.round((meta.page/meta.count)*100)+'%'});
		
		if(meta.page == 5 ||  meta.page == meta.pages){
			$(canvas).trigger('update_async');
			setTimeout(function(){
				var advancedtable = $(canvas).hasClass('advancedTable');
				$(canvas).trigger('populate', {'data':data,'append':false});
				$(canvas).trigger('showRecord',{'meta':meta,'advancedtable':advancedtable});
			},1000);
		}else{
			$.ajax({
				url:meta.next,
				dataType:'json',
				success:function(_response){
					async_data(_response.meta.href,_response.meta,data.concat(_response.data),canvas);
				}
			})
		}
	}
	$(document).on('click','.canvasTable .action-view,.canvasTable .action-edit',function(evt,args){
		var key  = $(this).parents('tr:first').attr('id');
		var data = $('.RECORD').trigger('access',{'key':key});
		var record =  window.RECORD.getActive();
		var modal =  $(this).attr('href');
		var canvas =  '#'+$(modal).find('.canvasTable').attr('id');
		var advancedtable = $(canvas).hasClass('advancedTable');
		var model =  $(canvas).attr('model');
		var form  = $('form[canvas="'+canvas+'"]');
		$(canvas).trigger('preload');
		$.each(record,function(mdl,content){
				if(mdl==model){
					//console.log(record[mdl]);
					if(record[mdl].length){
						RECORD.setModel(mdl);
						$(canvas).trigger('populate', {'data':record[mdl],'append':false});
						$(canvas).trigger('showRecord',{'advancedtable':advancedtable});
					}else{
						if(form.attr('template')){
							var template = $.parseJSON(form.attr('template'));
							$(canvas).trigger('emptyRecord',{'html':template.html});
						}else{
							$(canvas).trigger('emptyRecord');
						}
					}
				}
				$.each(content,function(fld,v){
	
					if(v instanceof Object){
						$.each(v,function(vf,vv){
							if(vv instanceof Object){
								$.each(vv,function(vvf,vvv){
									$(modal).find('input[name*="['+mdl+']['+fld+']['+vf+']['+vvf+']"],select[name*="['+mdl+']['+fld+']['+vf+']['+vvf+']"]').val(vvv);
								});
							}else{
								$(modal).find('input[name*="['+mdl+']['+fld+']['+vf+']"],select[name*="['+mdl+']['+fld+']['+vf+']"]').val(vv);
							}
						});
						
						//fieldIt($(modal),mdl,fld,[],v);
					}else{
						//Display content regular
						$(modal).find('input[name*="['+mdl+']['+fld+']"],select[name*="['+mdl+']['+fld+']"]').val(v);
						$(modal).find('span.uneditable-input[data-field="'+mdl+'.'+fld+'"]').text(v);
						$(modal).find('span.display-text[data-field="'+mdl+'.'+fld+'"]').text(v);
						//Populate foreign key						
						//console.log(('input[name*="['+mdl+']['+fld+']",role="foreign-key"]'));
						$('.canvasForm').find('input[name*="['+mdl+']['+fld+']"]').val(v);
					}
						
					
				});
			});
	});
	function fieldIt(target,mdl,fld,path,v){
		
		if(v instanceof Object){
			$.each(v,function(vf,vv){
				fieldIt(target,mdl,vf,path+'['+vf+']',vv);
			});
		}else{
			target.find('input[name*="'+path+'"],select[name*="'+path+'"]').val(v);
		}
						
	}
	$('.canvasTable').parents('form:first').bind('reset',function(){
		var canvas = '#'+$(this).find('.canvasTable').attr('id');
		var form  = $('form[canvas="'+canvas+'"]');
		if(form.attr('template')){
			var template = $.parseJSON(form.attr('template'));
			$(canvas).trigger('emptyRecord',{'html':template.html});
		}else{
			$(canvas).trigger('emptyRecord');
		}
		$(canvas).find('input').removeAttr('name').val('');
		$(canvas).find('tbody').hide();
	});
	$(document).on('click','form .intent-cancel',function(evt,args){
		var form =  $($(this).parents('form:first').attr('canvas'));
		var canvas = form.attr('canvas');
		//console.log(canvas);
		//console.log(form);
		var in_modal = $(canvas).parents('.modal:first');
		if(in_modal){
			in_modal.modal('show');
		}
	});
	$(document).on('click','.canvasTable .action-btn',function(evt,args){
		var href = $(this).attr('href');
		var form = $(this).parents('form:first');
		var formName = form.attr('name');
		//console.log(href,form,formName);
		var canvasForm =  form.attr('canvas');
		var model = $(canvasForm).attr('model');
		var self =  $(this);
		if(document[formName+''].checkValidity()){
			form.ajaxSubmit({
				dataType:'json',
				beforeSend:function(){
					self.attr("disabled","disabled");
				},
				success:function(formReturn){
					var key =  formReturn['data'][model]['id'];
					form.find('input[role="primary-key"]').val(key);
					$('input[role="foreign-key"]').val(key);
				}
			});
		}
	});
	//Initialize page
	$('.canvasForm').trigger('request_content',{'init':true});
});