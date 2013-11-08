$(document).ready(function(){
	var formNeatConst = {
						'DELAY':1500,
						'ERROR': -1,
						'OK': 1						
						};
	$('.formNeat form').prepend('<div class="uiNotify mAll pad4"></div>');
	$('.formNeat.uiNotify').hide();
	$('.formNeat .metro   div.input input').livequery('focus',function(){
		$(this).parent().find('label').hide();
	}).livequery('blur',function(){
		
		if(!$.trim($(this).val())){
			$(this).parent().find('label').show();
		}
	});
	$('.formNeat .picker .submit input').livequery('click',function(){
		$(this).parents('.picker').find('.submit input').removeClass('selected');
		$(this).addClass('selected');
	}); 
	$('.formNeat .submit-button').click(function(){
		var form= $(this).parents("form:first");
		//console.log($(this));
		//console.log(form);
		form.trigger('formNeat_beforeSend');
		$('.formNeat input, .formNeat select').blur();
		if(form.find('.error-message').length==0){
			form.find('.uiNotify').removeClass('b1sLemon bgLemon b1sLime bgLime b1sCheri bgCheri');
			form.ajaxSubmit({
				beforeSend:function(){
					form.trigger('formNeat_beforeSend');
					form.find('input,select,label').addClass('o2');
				},
				success:function(data){
					//console.log(data);
					var json_data=$.parseJSON(data);
					var status = json_data.status;
					switch(status){
						case formNeatConst.OK:
							form.find('.uiNotify').addClass('b1sLime bgLime').removeClass('b1sCheri bgCheri');
							form.trigger('reset_form');
							//form.resetForm();
							break;
						case formNeatConst.ERROR: 
							form.find('.uiNotify').addClass('b1sCheri bgCheri').removeClass('b1sLime bgLime');
							break;
					
					}
					form.find('.uiNotify').html(json_data.msg).fadeIn().delay(formNeatConst.DELAY).fadeOut();
					$(document).trigger('quick_scroll',{'target': form.find('.uiNotify')});
					form.find('input,select,label').removeClass('o2');
					form.trigger('formNeat_sucess',{'data':data,'form':form});
					//form.resetForm();
				}
			});
		}else{
			form.find('.uiNotify').addClass('b1sLemon bgLemon');
			form.find('.uiNotify').html('<img src="/lib/img/icons/error.png" />&nbsp; Fill up required fields').fadeIn().delay(formNeatConst.DELAY).fadeOut();
			$(document).trigger('quick_scroll',{'target': form.find('.uiNotify')});
		}
	});
	$('.formNeat input, select').livequery(function(){
		var input = $(this);
		input.bind('validated',function(e,param){
			var obj = $(this);
			var form= obj.parents("form:first");
			var status = parseInt(obj.attr('valid'));
			obj.parent().find('.message').hide();
			switch(status){
				case formNeatConst.OK:			
					obj.removeClass('b1sCheri bgCheri');
					break;
				case formNeatConst.ERROR: 
					obj.addClass('b1sCheri bgCheri');
					break;
			}
		});
	});
	//Register formNeat events
	$('.formNeat form').bind('formNeat_beforeSend',function(evt,args){}).bind('formNeat_sucess',function(evt,args){});
});