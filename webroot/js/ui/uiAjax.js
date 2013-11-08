$(document).ready(function(){
	$('form').bind('ajaxFinish', function(e,args){
		var returnIs;
		var action = $(this).attr('action');
		var m_add = action.match('/add/');
		var m_edit = action.match('/edit/');
		var m_delete = action.match('/delete/');
		if(m_add){
			returnIs = 'add';
		}
		if(m_edit){
			returnIs = 'edit';
		}
		if(m_delete){
			returnIs = 'delete';
		}
		console.log('returnIs',returnIs);
		return returnIs;
	});

});