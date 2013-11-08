<?php
//Include OAuth Library and Configuration
App::import('Vendor', 'Oauth.OAuthStore', array('file' =>'library'.DS.'OAuthStore.php'));
App::import('Vendor', 'Oauth.OAuthRequester', array('file' =>'library'.DS.'OAuthRequester.php'));
Configure::load('oauth');
//OAuth Settings
define("CONSUMER_ID",Configure::read('OAuth.id'));
define("CONSUMER_KEY",Configure::read('OAuth.key'));
define("CONSUMER_SECRET",Configure::read('OAuth.secret'));
define("OAUTH_HOST",'http://'. $_SERVER['HTTP_HOST'].'/profile');
define("USER_URL", OAUTH_HOST . "/oauth/user");
define("REQUEST_TOKEN_URL", OAUTH_HOST . "/oauth/request_token");
define("AUTHORIZE_URL", OAUTH_HOST . "/oauth/authorize");
define("ACCESS_TOKEN_URL", OAUTH_HOST . "/oauth/access_token");
class OauthAppController extends AppController {
	var $uses =null;
	var $name = 'OauthApp';
	var $OAuth;
	var $OAuthRequester;
	var $OAuthToken;
	var $OAuthCallback;
	var $OAuthUser;
	function beforeFilter(){
		parent::beforeFilter();
		//Initialize ConnectionManager
		ClassRegistry::init('ConnectionManager');
		$ds = & ConnectionManager::getDataSource('default');
		//Instantiate OAuthStore
			$server = array(
			'consumer_key' => CONSUMER_KEY,
			'consumer_secret' => CONSUMER_SECRET,
			'server_uri' => OAUTH_HOST,
			'signature_methods' => array('HMAC-SHA1', 'PLAINTEXT'),
			'request_token_uri' => REQUEST_TOKEN_URL,
			'authorize_uri' => AUTHORIZE_URL,
			'access_token_uri' => ACCESS_TOKEN_URL
		);
		//Initialize ConnectionManager
		ClassRegistry::init('ConnectionManager');
		$ds = & ConnectionManager::getDataSource('default');
		//Instantiate OAuthStore
		try{
			$this->OAuth  = OAuthStore::instance('MySQL', $ds->config);
			//$this->OAuth  = OAuthStore::instance('Session',$server);
		}catch(OAuthException2 $e){
			echo $e->getMessage();
			exit;
		}
	}

	
	function index(){
		if(!isset($_GET['usr_id'])){
			$callback_uri = rawurlencode('http://'. $_SERVER['HTTP_HOST'].'/'.APP_DIR.'/oauth');
			$uri = USER_URL.'?callback='.$callback_uri;
			$this->redirect($uri);
		}
		$user_id = $_GET['usr_id'];
		$_SESSION['uid'] = $user_id;
		// The server description
		$server = array(
			'consumer_key' => CONSUMER_KEY,
			'consumer_secret' => CONSUMER_SECRET,
			'server_uri' => OAUTH_HOST,
			'signature_methods' => array('HMAC-SHA1', 'PLAINTEXT'),
			'request_token_uri' => REQUEST_TOKEN_URL,
			'authorize_uri' => AUTHORIZE_URL,
			'access_token_uri' => ACCESS_TOKEN_URL
		);
		try{
			$this->OAuth->updateServer($server, $user_id,true);
		}catch(OAuthException2 $e){
			echo $e->getMessage();
			$this->redirect(array('action'=>'signreq'));
		}
		// Obtain a request token from the server
		try{
			$token = OAuthRequester::requestRequestToken(CONSUMER_KEY, $user_id);
			$callback_uri = 'http://'. $_SERVER['HTTP_HOST'].'/'.APP_DIR.'/oauth/callback?consumer_key='.rawurlencode(CONSUMER_KEY).'&usr_id='.intval($user_id);
			$this->redirect(AUTHORIZE_URL.'?oauth_token='. $token['token'].'&oauth_callback='.rawurlencode($callback_uri));
			
		}catch(OAuthException2 $e){
			echo $e->getMessage();
			exit;
		}
	}
	function callback(){
		// Request parameters are oauth_token, consumer_key and usr_id.
		$consumer_key = $_GET['consumer_key'];
		$oauth_token = $_GET['oauth_token'];
		$user_id = $_GET['usr_id'];
		$_SESSION['user'] =  $user_id;
		// The server description
		$server = array(
			'consumer_key' => CONSUMER_KEY,
			'consumer_secret' => CONSUMER_SECRET,
			'server_uri' => OAUTH_HOST,
			'signature_methods' => array('HMAC-SHA1', 'PLAINTEXT'),
			'request_token_uri' => REQUEST_TOKEN_URL,
			'authorize_uri' => AUTHORIZE_URL,
			'access_token_uri' => ACCESS_TOKEN_URL
		);
		try
		{
			OAuthRequester::requestAccessToken($consumer_key, $oauth_token, $user_id);
			$this->redirect(array('action'=>'signreq'));
		}
		catch (OAuthException2 $e)
		{
			echo $e->getMessage();
			
		}
		exit;
	}
	function signreq(){
		// The request uri being called.
		$request_uri = OAUTH_HOST.'/users.json';
		$user_id = isset($_SESSION['login'])?$_SESSION['login']['data']['User']['id']:$_SESSION['uid'];
		//$user_id = 32156;
		// Parameters, appended to the request depending on the request method.
		// Will become the POST body or the GET query string.
		//echo $user_id;
		$params = array('id'=>$user_id);
		try{
			// Obtain a request object for the request we want to make
			$req = new OAuthRequester($request_uri, 'POST',$params);
			// Sign the request, perform a curl request and return the results, throws OAuthException2 exception on an error
			$result = $req->doRequest($user_id);
			if ($this->RequestHandler->isAjax()) {
				echo $result['body'];
				exit;
			}else{
				$login =json_decode($result['body'],true);
				$_SESSION['login']=$login;
				$_SESSION['uid'] = $login['data']['User']['actor'];
				$this->set('data',$login);
			}
		}catch(OAuthException2 $e){
			if ($this->RequestHandler->isAjax()) {
				$error = array('meta'=>array('status'=>'error','feedback'=>$e->getMessage()));
				echo json_encode($error);
				exit;
			}else{
			$this->set('error',$e->getMessage());
			}
		}
	}
	function dismiss(){
		$_SESSION['uid']=null;
		$_SESSION['login']=null;
		$this->redirect(OAUTH_HOST.'/users/logout');
	}
}

?>