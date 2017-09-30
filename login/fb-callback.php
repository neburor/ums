<?php
session_start();
#error_reporting(E_ERROR | E_WARNING | E_PARSE);

require '../config.php';
require_once ('Facebook/autoload.php');

$fb = new Facebook\Facebook([
  'app_id' => FBAPPID,
  'app_secret' => FBAPPSECRET,
  'default_graph_version' => 'v2.7',
  ]);

$helper = $fb->getRedirectLoginHelper();

if($accessToken = $helper->getAccessToken())
{
	if($graphUser = $fb->get('/me?fields=id,name,email,cover,picture.height(110).width(110)', $accessToken))
	{
		$user = $graphUser->getGraphUser();
	}

}

if($user)
{
	if(isset($_SESSION['debugger']))
	{
		$_SESSION['debugger'][]='API:facebook:connect => ConnectAccount()';
	}
	$_SESSION['connect']['alert']['success']='Has iniciado sesion con facebook correctamente';


	$UserConnect['network']['net']='facebook';
	$UserConnect['network']['id']=$user['id'];
	$UserConnect['network']['name']=$UserConnect['name']=$user['name'];
	$UserConnect['network']['email']=$user['email'];
	$UserConnect['pic']='facebook';
	$UserConnect['cover']='facebook';
	$UserConnect['network']['cover']=$user['cover']['source'];
	$UserConnect['form_id'] = (isset($_SESSION['connect']['callback'])) ? $_SESSION['connect']['callback'] : $_SESSION['connect']['btn'];
	$UserConnect['url_ref']=$_SESSION['connect']['ref'];
	if(isset($user['cover']['offset_y']))
	{
		$UserConnect['network']['cover_y']=$user['cover']['offset_y'];
	}
	if(isset($user['cover']['offset_x']))
	{
		$UserConnect['network']['cover_x']=$user['cover']['offset_x'];
	}
	$UserConnect['network']['pic']=$user['picture']['url'];
	$UserConnect['type']='connect';

	require '../accounts/function_connect.php';
	$_SESSION['logged']=ConnectAccount($UserConnect);
	$_SESSION['logged']['login']='facebook';
	$callback='#'.$_SESSION['connect']['callback'];
}
else 
{	
	if(isset($_SESSION['debugger']))
	{
		$_SESSION['debugger'][]='API:facebook:error | '.$helper->getError();
	}
	$_SESSION['connect']['alert']['danger']='Error de inicio de sesion';
	$callback='#'.$_SESSION['connect']['error'];
}

header("Location: ".$_SESSION['connect']['referer'].$callback);
