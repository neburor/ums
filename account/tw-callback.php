<?php
session_start();
include '../global/config.php';
include_once("twitter/twitteroauth.php");

$connection = new TwitterOAuth(TWCONSUMERKEY, TWCONSUMERSECRET, $_SESSION['connect']['twitter']['token'] , $_SESSION['connect']['twitter']['token_secret']);

$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);


if($access_token)
{	
	$_SESSION['connect']['alert']['success']='Has iniciado sesion con twitter correctamente';

	$_SESSION['connect']['twitter'] = $access_token;
	
	header("Location: ".$_SESSION['connect']['referer'].$_SESSION['connect']['callback']);
}
else 
{	
	$_SESSION['connect']['alert']['danger']='Es necesario que acepte la aplicación para poder iniciar sesion con su cuenta de twitter';

	header("Location: ".$_SESSION['connect']['referer'].$_SESSION['connect']['callback']);
}
