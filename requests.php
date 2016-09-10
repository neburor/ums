<?php
//REQUESTS
if(isset($_GET))
{
	if(isset($_GET['login']))
  	{
    		if($_GET['login']=='facebook')// Iniciar sesion con la API de Facebook
    		{

      			include_once('login/Facebook/autoload.php');
      			$fb = new Facebook\Facebook([
        									'app_id' => FBAPPID,
        									'app_secret' => FBAPPSECRET,
        									'default_graph_version' => 'v2.7',
        									]);

      			$helper = $fb->getRedirectLoginHelper();
      			$permissions = ['email']; // optional
      			
      			$loginUrl = $helper->getLoginUrl(URLSYSTEM.'login/fb-callback.php', $permissions);

      			$_SESSION['connect']['referer']=$_SERVER['HTTP_REFERER'];

    			header("Location: " . $loginUrl);
    		}
	}
	if(isset($_GET['logout']))
  	{
  		unset($_SESSION['logged']);
  		header("Location: " . $_SERVER['HTTP_REFERER']);
  	}
}