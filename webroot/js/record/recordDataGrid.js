$(document).ready(function(){
	var RECORD_BASE = 0;
	var RECORD_COMMIT = 13;
	var RECORD_STEP = 1;
	var RECORD_SPEED = 'fast';
	var RECORD_MAIN= 'mainInput';
	var RECORD_DYNAMIC = 'dynamicInput';
	var RECORD_COUNT = 0;
	var AUTO_FLAG = '(Auto)';
	
	$('.recordDatagrid input,.recordDatagrid select').livequery(function(){
		
		var input =  $(this);
		input.bind('next_row',function(evt,args){
		
			var PARENT  =  args.PARENT;
			var ROW  =  args.ROW;
			var NEW_ROW  =  args.NEW_ROW;
			var NAME  =  args.NAME;
			var COUNT  =  args.COUNT;
			var FIRST_COL  =  args.FIRST_COL;

			
			if(NEW_ROW){
				//Correct first row, set index to zero
				if(COUNT==1){
					ROW.find('input,select').each(function(i,obj){
						var name = $(obj).attr('vname')?$(obj).attr('vname'):$(obj).attr('name'); //Get input name
						$(obj).attr('vname',name);	//Assign to vname for reference
						var vname = $(obj).attr('vname'); //Get input vname
						$(obj).attr('name',vname.replace('%',RECORD_BASE)); //Correct input index
					});
				}
				NEW_ROW.find('input:not([type="hidden"])').val('');
				NEW_ROW.find('input,select').each(function(i,obj){
					var name = $(obj).attr('vname')?$(obj).attr('vname'):$(obj).attr('name'); //Get input name
					$(obj).attr('vname',name);	//Assign to vname for reference
					var vname = $(obj).attr('vname'); //Get input vname
					name = vname.replace('%',COUNT); //Set new name
					$(obj).attr('name',name); //Correct input index
					$(obj).parent().removeClass('required'); //Remove required class
					//$(obj).removeAttr('class');//Clean all classes attached
					$(obj).attr('valid', '-1'); 
				});
				
			}
			
			//Focus next item to first column
			var VNAME = $(FIRST_COL).attr('vname');
			var lastInput = $(PARENT).find('li:eq('+COUNT+')').find('input[vname="'+VNAME+'"],select[vname="'+VNAME+'"]');
			lastInput[0].focus();
		});
	})
	$(document).on('check_valid','.recordDatagrid input,.recordDatagrid select',function(){
		if(args==undefined){
			args = {'which':0};
		}
		var ROW  =  $(this).parents('li:first');
		var PARENT  =  $(ROW).parent();
		var CHILDREN = $(PARENT).find('li');
		//var SIBLINGS =  $(ROW).find('input[type="text"]');
		var SIBLINGS =  $(ROW).find('input:not([type="hidden"]),select');
		var LAST_ROW = $(PARENT).find('li:last')[0];
		var FIRST_COL = SIBLINGS[0];
		var LAST_COL = SIBLINGS[SIBLINGS.length-1];
		var SELF = $(this); 
		var ROW_COUNT = 0;
		var NAME =  SELF.attr('name');
			SELF = SELF[0];//SELF fix
			ROW = ROW[0]; //ROW fix
		var NEW_ROW =null;
		if(evt.which ==  RECORD_COMMIT||args.which ==RECORD_COMMIT){
		
			//Prevent form submit on ENTER key
			evt.preventDefault();
			
			
			if(SELF==FIRST_COL){
				$.each(SIBLINGS, function(e, c){
					$(c).parent().addClass('required');
				});
			}
			if(SELF==LAST_COL){
				if(ROW==LAST_ROW){
					ROW_COUNT =  $(PARENT).find('li').length;
					NEW_ROW =  $(ROW).clone();
					NEW_ROW.addClass(RECORD_DYNAMIC).removeClass(RECORD_MAIN);
					$(PARENT).append(NEW_ROW);
					$(PARENT).trigger('new_row');
					CHILDREN = $(PARENT).find('li');
				}else{
					 $(PARENT).find('li').each(function(CTR,OBJ){
						if(ROW==OBJ){
							ROW_COUNT = CTR+RECORD_STEP;
						}
					 });
				}
				//Triggers the next_row event
				
				$(SELF).trigger('next_row',{'PARENT':PARENT,'ROW':$(ROW),'NEW_ROW':NEW_ROW,'NAME':NAME,'COUNT':ROW_COUNT,'FIRST_COL':FIRST_COL});
			
			}else{
				SIBLINGS.each(function(CTR,OBJ){
					if(SELF==OBJ){
						COL_COUNT = CTR+RECORD_STEP;
					}
				});
				SIBLINGS[COL_COUNT].focus();
				
			}
		}
	})
	
	
	$(document).on('check_valid','.recordDatagrid input,.recordDatagrid select',function(){
			
		 if($(this).hasClass('unique')){
			
			var thisInput = $.trim($(this).val());
			if(thisInput!=AUTO_FLAG){
				var selfLi = $(this).parents('li:first').index();
				var itemRecord = $(this).parents('.recordDatagrid:first');
				var field = $.trim($(this).parent().parent().attr('class'));
				field = '.'+field;
				field = field.replace(/ /g,'.');
				var matched = $(itemRecord).find(field+' > div.input').find('input[value="'+thisInput+'"]');
				if (matched.size() > 1){
					//console.log('matched',matched);
					$(this).trigger('error',{msg:'Already existing'});
				}
			};
			
		} 
		
	});
	//Updates Datagrid list index
	$('.recordDatagrid').livequery(function(){
		var THIS =  this;
		$(THIS).bind('update_grid',function(){
			var list = $(this);
			list.find('li').each(function(ctr,li){
				if(ctr==0){
					$(li).removeClass(RECORD_DYNAMIC);
					$(li).addClass(RECORD_MAIN);
				}
				$(li).find('input,select').each(function(i,obj){
				
					var vname =$(obj).attr('vname')?$(obj).attr('vname'):$(obj).attr('name'); //Get input name
					var name = vname.replace('%',ctr); //Set new name
					$(obj).attr('name',name); //Correct input index
					$(obj).attr('vname',vname); //Correct input index
				});
			});
		}).bind('populate_grid',function(evt,args){
			var data =  args.data;	//Data to populate
			var SELF = $(this);
			var new_class = args.new_class;
			//Loop to generate rows
			$.each(data,function(indx,obj){
				//console.log(SELF);
				var start_index = SELF.find('li').length-1; //Current row index before insertion
				SELF.find('li:eq('+start_index+')').find('input:last([type="text"])').trigger('keypress',{'which':13}); //Trigger keypress on last input type of current row
				var last_index =  SELF.find('li').length-1; //Current row index after insertion
				var new_row =  SELF.find('li:eq('+last_index+')'); //New row inserted
				if(new_class){
					$(new_row).removeAttr('class');
					$.each(new_class,function(a,b){
						$(new_row).addClass(b);
					});
				}
				//Loop on each key to populate
				$.each(obj,function(prop,value){
					new_row.find(prop).val(value);
				});
				new_row.show();
			});
			SELF.trigger('grid_populated',args);//Trigger to suggest routine completion
		}).bind('grid_populated',function(evt,args){
		}).bind('new_row',function(evt,args){
		}).bind('fill_this_grid', function(evt, args){// Trigger single row population
			var data =  args.data[0];	//Data to populate
			var SELF = $(args.row[0]);  // The row to be populated
			var fields = Object.keys(data); 
			
			$.each(fields, function(indx, obj){
				SELF.find(obj).val(data[obj]);
			});
			
		});
		
		$(THIS).bind('clear_grid', function(){
			var SELF = $(this);
			SELF.find('li.dynamicInput').remove();
		});
	});
	

	
	//Deletes on record at a time
	$(document).on('click','.recordDatagrid a.recordDelete',function(evt,args){
		//Prevent from bouncing link
		evt.preventDefault();
		var SELF = $(this);
		var ROW  =  SELF.parents('li:first');
		var PARENT  =  $(ROW[0]).parent();
		var COUNT =  $(PARENT).find('li:visible').length;
		//Resets the page to default when last item is deleted
		if(COUNT == 1){
			$(document).trigger('restore_defaults');
		}
		else{
			$(ROW).fadeOut(RECORD_SPEED,function(){
				$(ROW).remove();
				$(PARENT).trigger('update_grid');
				$(PARENT).find("input,select").blur();
			});
		}
	});

	
	//Collects all useful data when row is clicked
	$(document).on('click','.recordDatagrid li.clickInput',function(evt,args){
		var SELF = $(this);
		var data =[];
		var obj={};
		$.each(SELF.find('*>div.input'),function(i,col){
			if($(col).find('input,select')){
				var classes = $(col).parent().attr('class').split(' ');
				var base_class = 'div.'+classes[classes.length-1];
				obj[base_class+' input'] = $(col).find('input,select').val();
			}
		});
		SELF.trigger('clicked',{'obj':obj}); //Fire this to pass the data collected
	});
	
	
});