<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require '../global/config.php';
require_once ('Facebook/autoload.php');


$fb = new Facebook\Facebook([
  'app_id' => FBAPPID,
  'app_secret' => FBAPPSECRET,
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

if($accessToken = $helper->getAccessToken())
{
	if($response = $fb->get('/me?fields=id,name,email,cover,picture.height(110).width(110)', $accessToken))
	{
		$user = $response->getGraphUser();
	}
}

if($user)
{

	$_SESSION['connect']['alert']['success']='Has iniciado sesion con facebook correctamente';

	$_SESSION['connect']['facebook']['id']=$user['id'];
	$_SESSION['connect']['facebook']['name']=$user['name'];
	$_SESSION['connect']['facebook']['email']=$user['email'];
	$_SESSION['connect']['facebook']['cover']=$user['cover']['source'];
	$_SESSION['connect']['facebook']['pic']=$user['picture']['url'];

	header("Location: ".$_SESSION['connect']['referer'].$_SESSION['connect']['callback']);
}
else 
{	
	$_SESSION['connect']['alert']['danger']='Es necesario que acepte la aplicación para poder iniciar sesion con su cuenta de facebook';

	header("Location: ".$_SESSION['connect']['referer'].$_SESSION['connect']['callback']);
	
}
