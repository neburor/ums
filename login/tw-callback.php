<?php
session_start();
include '../config.php';
include_once("twitter/twitteroauth.php");

$connection = new TwitterOAuth(TWCONSUMERKEY, TWCONSUMERSECRET, $_SESSION['connect']['twitter']['token'] , $_SESSION['connect']['twitter']['token_secret']);

$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

$tt = json_decode(json_encode($connection->get('users/show', array('screen_name'=>$access_token['screen_name']))), True);
#$tt_cover = json_decode(json_encode($connection->get('users/profile_banner', array('screen_name'=>$access_token['screen_name']))), True);



if($access_token)
{	
	if(isset($_SESSION['debugger']))
	{
		$_SESSION['debugger'][]='API:twitter:connect => ConnectAccount()';
	}
	$_SESSION['connect']['alert']['success']='Has iniciado sesion con twitter correctamente';

	$_SESSION['connect']['network']='twitter';
	$_SESSION['connect']['id']=$access_token['user_id'];
	$_SESSION['connect']['name']=$tt['name'];
	$_SESSION['connect']['screenname']=$access_token['screen_name'];
	$_SESSION['connect']['pic']=$tt['profile_image_url'];
	$_SESSION['connect']['cover']=$tt['profile_banner_url'];
	
	require '../accounts/function_connect.php';

	$_SESSION['logged']=ConnectAccount();
	$callback='#'.$_SESSION['connect']['callback'];
}
else 
{	
	if(isset($_SESSION['debugger']))
	{
		$_SESSION['debugger'][]='API:twitter:error | ';
	}

	$_SESSION['connect']['alert']['danger']='Es necesario que acepte la aplicación para poder iniciar sesion con su cuenta de twitter';
	$callback='#'.$_SESSION['connect']['error'];
}
header("Location: ".$_SESSION['connect']['referer'].$callback);