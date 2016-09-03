<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require 'config.php';
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
	$_SESSION['connect']['alert']['success']='Has iniciado sesion con facebook correctamente';
	$_SESSION['connect']['facebook']['id']=$user['id'];
	$_SESSION['connect']['facebook']['name']=$user['name'];
	$_SESSION['connect']['facebook']['email']=$user['email'];
	$_SESSION['connect']['facebook']['cover']=$user['cover']['source'];
	$_SESSION['connect']['facebook']['pic']=$user['picture']['url'];
}
else 
{	
	$_SESSION['connect']['alert']['danger']='Error de inicio de sesion';
}

header("Location: ".$_SESSION['connect']['referer']);
