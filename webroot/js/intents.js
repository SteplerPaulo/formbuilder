$('document').ready(function(){
	var COMMIT = 13;
	$('#intent-create').click(function(e){	
			e.preventDefault();
			if($(this).hasClass('disabled')) return;
			$('#intent-modal').modal('show');
			var form = $('#intent-modal').parents('form:first');
			var model = form.attr('model');
			form.attr('action',BASE_URL+model+'/add');
			$('#intent-modal').find('input[name*="id"]').val(null); // Reset to id to null
			form[0].reset();
			$('#intent-modal .modal-header').find('.intent-text,.intent-object').show();
			$('.detail-modal .modal-header').find('.intent-text,.intent-object').show();
			$('#intent-modal .modal-header .intent-notify').html('');
			$('.detail-modal .modal-header .intent-notify').html('');
			//Data Text for intent-save
			var text = $('#intent-modal .intent-save').attr('data-text');
			if(!text) $('#intent-modal .intent-save').attr('data-text', $('#intent-modal .intent-save').text());
			$('#intent-modal .intent-save').text($('#intent-modal .intent-save').attr('data-text')).show();
			//Data Text for intent-text
			var text = $('#intent-modal .intent-text').attr('data-text');
			if(!text) $('#intent-modal .intent-text').attr('data-text', $('#intent-modal .intent-text').text());
			$('#intent-modal .intent-text').text($('#intent-modal .intent-text').attr('data-text'));
			$('#intent-modal .intent-delete').hide();
			$('#intent-modal .modal-body').find('input,select,button,.btn').removeAttr('disabled');
			
	});
	$('.intent-save').bind('click', function(e){
		var form = $(this).parents('form:first');
		var formName = form.attr('name');
		var canvasForm =  form.attr('canvas');
		var self =  $(this);
		if(document[formName+''].checkValidity()){
			form.ajaxSubmit({
				dataType:'json',
				beforeSend:function(){
					self.attr("disabled","disabled");
				},
				success:function(formReturn){
					console.log(formReturn);
					var actionIs = form.attr('action');
					form.trigger('ajaxFinish',{data:formReturn.data, action:actionIs});
					if(formReturn.status==1){
						document[formName+''].reset();
						self.parents('.modal:first').modal('hide');
						self.removeAttr("disabled");
						$(document).trigger('request_tree',{'refresh':true});
						$(document).trigger('request_content',{'source':form,'data':formReturn.data});
						$(canvasForm).trigger('request_content',{data:formReturn.data, action:actionIs});
						
					}else{
						$('#warning').trigger('pop',{msg:formReturn.msg});	
					}
					
				}
			});
		}

	});	
	
	$('.intent-delete').click(function(e){	
		$('#intent-modal .modal-header').find('.intent-text,.intent-object').show();
		$('.detail-modal .modal-header').find('.intent-text,.intent-object').show();
		$('#intent-modal .modal-header .intent-notify').html('');
		$('.detail-modal .modal-header .intent-notify').html('');
		$('.intent-save').show();
		$('.intent-delete').hide();
	});
	$(document).on('click','.intent-remove',function(){
		var table =$(this).parents('table:first');
		var model = table.attr('model');
		var row =$(this).parents('tr:first');
		row.find('.intent-view').click();
		var record =  window.RECORD.getActive();
		var id = record[model]['id'];
		var modal =  $(row.find('.intent-view').attr('href'));
		var form = modal.parents('form:first');
		var model = form.attr('model');
		form.attr('action',BASE_URL+model+'/delete/'+id);
		//Data text for intent-save
		var text = modal.find('.intent-save').attr('data-text');
		if(!text) modal.find('.intent-save').attr('data-text',modal.find('.intent-save').text());
		modal.find('.intent-save').text('Delete');
		//Data text for intent-text
		var text = modal.find('.intent-text').attr('data-text');
		if(!text) modal.find('.intent-text').attr('data-text', modal.find('.intent-text').text());
		modal.find('.intent-text').text('Delete ');
		modal.find('.modal-body').find('input,select,button,.btn').attr('disabled','disabled');		
	});
	$(document).on('click','.intent-view',function(){
		//Data Text for intent-save
		var modal =   $($(this).attr('href'));
		var form = modal.parents('form:first');
		var model = form.attr('model');
		form.attr('action',BASE_URL+model+'/add');
		var text = modal.find('.intent-save').attr('data-text');
		if(!text) modal.find('.intent-save').attr('data-text', modal.find('.intent-save').text());
		modal.find('.intent-save').text(modal.find('.intent-save').attr('data-text')).show();
		//Data Text for intent-text
		var text = modal.find('.intent-text').attr('data-text');
		if(!text)  modal.find('.intent-text').attr('data-text', modal.find('.intent-text').text());
		modal.find('.intent-text').text('Edit ');
		modal.find('.modal-body').find('input,select,button,.btn').removeAttr('disabled','disabled');	
	});
	$(document).on('click','.intent-add',function(){
		//Data Text for intent-save
		var modal =   $($(this).attr('href'));
		var form = modal.parents('form:first');
		var model = form.attr('model');
		form.find('input[type="hidden"][role!="foreign-key"]').val('');//Reset input
		form.attr('action',BASE_URL+model+'/add');
		var text = modal.find('.intent-save').attr('data-text');
		if(!text) modal.find('.intent-save').attr('data-text', modal.find('.intent-save').text());
		modal.find('.intent-save').text(modal.find('.intent-save').attr('data-text')).show();
		//Data Text for intent-text
		var text = modal.find('.intent-text').attr('data-text');
		if(!text)  modal.find('.intent-text').attr('data-text', modal.find('.intent-text').text());
		modal.find('.intent-text').text(modal.find('.intent-text').attr('data-text'));
		modal.find('.modal-body').find('input,select,button,.btn').removeAttr('disabled','disabled');	
	});
	$('.intent-cancel').bind('click', function(){
		var form = $(this).parents('form:first');
		form[0].reset();
		//Reset text only if no child
		if(form.find('span.uneditable-input>*').length==0){
			form.find('span.uneditable-input').text('');
		}else{
			form.find('span.uneditable-input>*').text('');
		}
	});
	$('.intent-close').bind('click', function(){
		var form = $(this).parents('form:first');
		var canvas = form.attr('canvas');
		var in_modal = $(canvas).parents('.modal:first');
		if(in_modal){
			in_modal.modal('show');
		}
		
		//Reset text only if no child
		if(form.find('span.uneditable-input>*').length==0){
			form.find('span.uneditable-input').text('');
		}else{
			form.find('span.uneditable-input>*').text('');
		}
	});
	
	//TypeAhead on Table
	var intentAutoBox;
	$('.intent-autobox').focus(function(){
		intentAutoBox = $(this);
	}).typeahead({
		minLength: 2,
		source:function(query, process){ //PUTTING CONTENT
			var fieldTable = [];
			var fieldIs = $(intentAutoBox).parents('span:first').attr('data-field');
			
			$.each($('table td span[data-field="'+fieldIs+'"]'), function(ctrx, objx){
				fieldTable.push($(objx).text());
			});
			$.each(TREE.getPath(), function(ctrx, objx){
				fieldTable.push(objx.name);
			});
			process(fieldTable);
		},
		updater:function(item){
			$('#warning').trigger('pop',{itemMatch:item,msg:$(intentAutoBox).parent().prev().text()+' already taken'});
		}
	});
	
	
	//General Type Ahead
	$('.typeahead').focus(function(){
		var test = '&quot;Type&quot;';
		var data = [test];
		$(this).attr('data-source',data);
	
	});	
	
	$('.intent-avoid_conflict').on(		
		'blur', function(e){
			var input =  this;
			var afieldTable = [];
			var afieldIs = $(input).parents('span:first').attr('data-field');
			var valueIs=$(input).val();
			if(valueIs){
				$.each(	$('.RECORD td span[data-field="'+afieldIs+'"]'), function(ctrx, objx){
					afieldTable.push($(objx).text()+'');
				});
				$.each(	TREE.getPath(), function(ctrx, objx){
					afieldTable.push(objx.name);
				});
				if(afieldTable.indexOf(valueIs) != -1){
					$('#warning').trigger('pop',{msg:$(input).parents('span:first').find('label').text()+'  already taken!'});
					$(input).val('').focus();
				}
			}
		});
	
	$('#intent-modal input, #intent-modal select').on('focus', function(){
			$('#intent-modal .intent-save').attr('disabled','disabled');
	}).on('blur', function(){
			$('#intent-modal .intent-save').removeAttr('disabled');
	});
	
	$('#warning').bind('pop', function(e, args){
		$('#warning').find('.context').html(args.msg);
		$('#warning').modal('show');
	});

	$('#warning .warning-yes').click(function(){
		$('#warning').modal('hide');
		$('#warnig').trigger('yes');
	})
	

	$('#warning .warning-no').click(function(){
		$('#warning').modal('hide');
		$('#warnig').trigger('no');
	});	
	
	$('#intent-back').click(function(e){
		e.preventDefault();
		window.location=BASE_URL+"pages/apps";
	});
});
			
