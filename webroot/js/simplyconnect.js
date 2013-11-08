var BASE_URL ='/'+window.location.pathname.split('/')[1]+'/';
var OAUTH_HOST = window.location.origin+'/profile/oauth/user';
var OAUTH_BASE = window.location.origin+BASE_URL;
var OAUTH_SUFFIX='oauth/';
var OAUTH_SIGNED='signreq';

function callback(data){
	window.location=OAUTH_BASE;
}
$(document).ready(function(){
	if(window.opener){
		var data =  $.parseJSON($('#user').val());
		window.opener.callback(data);
		window.close();
	}else{
		//$('#simple-root').addClass('animate').css({'width':'0%','overflow':'hidden'});
		$('#simple-root').addClass('animate').addClass('overflowHidden');
		checkStatus(window['localStorage']);
	}
	function checkStatus(hasLocalStorage){
		$.ajax({
			url:OAUTH_HOST,
			method:'GET',
			dataType:'json',
			success:function(data){
				simplyConnect(hasLocalStorage,200);
			},error:function(){
				simplyConnect(hasLocalStorage,403)
			}
		});		
	}
	function simplyConnect(hasLocalStorage,status){
		
		switch(status){
			case 403:
				if(hasLocalStorage){
					localStorage.setItem('user',null);		
					localStorage.setItem('user_info',null);		
				}else{
					window.user=null;
					window.user_info=null;
				}
				//Render UI
				$('#simple-root').html('<button class="btn  btn-primary" type="button" id="simplyconnect-btn"><i class="icon-refresh icon-spin "></i> SimplyConnect</button><span class="simple-msg">your account to gain access.</span>');
				$('#simple-root').css({'width':'100%','overflow':'none'});
				$('.simple-msg').attr('style','display: inline-block;padding: 0 0.3em;text-shadow: 1px 2px 0px #fff;color: #222;font-size: 1em;');
				$(document).on('click','#simplyconnect-btn',function(){
					window.open(OAUTH_BASE+OAUTH_SUFFIX,'Simply Connect','width=900,height=500');
				});
				
				if(OAUTH_BASE != window.location.href){
					window.location.href = BASE_URL;
					$('#simplyconnect-btn').click();
					$("#alert").alert('show');
				}
				break;
			case 200:
				if(!window.user){
					getUserInfo(hasLocalStorage);
				}else{
					user = $.parseJSON(localStorage.getItem('user')||window.user);
					ntf ='<div class="user-info  pull-right">'
					ntf+='	<div class="btn-group ">';
					ntf+='		<button class="btn"><i class="icon-user"></i> <span class="user-fullname">'+user.full_name+'</span></button>';
					ntf+='		<button class="btn"><i class="icon-group"></i> <sup class="badge badge-warning"></sup></button>';
					ntf+='		<button class="btn"><i class="icon-bullhorn"></i> <sup class="badge badge-warning"></sup></button>';
					ntf+='		<button class="btn"><i class="icon-envelope-alt"></i> <sup class="badge badge-warning"></sup></button>';
					ntf+='		<button class="btn"><a href="/profile/users/logout"><i class="icon-off"></i></a></button>';
					ntf+='	</div>';
					ntf+='</div>';
					$('#simple-root').removeClass('overflowHidden').css({'width':'100%','overflow':'none'});
					$('#simple-root').html(ntf);
					
					$(document).trigger('after_get');
				}
				$("#alert").alert('close');
				break;
		}
		
	}
	function getUserInfo(hasLocalStorage){
		$.ajax({
			url:OAUTH_BASE+OAUTH_SUFFIX+OAUTH_SIGNED,
			method:'GET',
			dataType:'json',
			success:function(data){
				if(data.meta.status=='ok'){
					var user = JSON.stringify(data.data.Employee||data.data.Developer||data.data.Student);
					var user_info = JSON.stringify(data.data);
					localStorage.setItem('user',user);
					localStorage.setItem('user_info',user_info);
					window.user = user;
					window.user_info = user_info;
					simplyConnect(hasLocalStorage,200);
				}
			}
		});
	}
});
