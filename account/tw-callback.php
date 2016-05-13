<?php
session_start();
include '../global/config.php';
include_once("twitter/twitteroauth.php");

$connection = new TwitterOAuth(TWCONSUMERKEY, TWCONSUMERSECRET, $_SESSION['connect']['twitter']['token'] , $_SESSION['connect']['twitter']['token_secret']);

$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

$tt = json_decode(json_encode($connection->get('users/show', array('screen_name'=>$access_token['screen_name']))), True);
#$tt_cover = json_decode(json_encode($connection->get('users/profile_banner', array('screen_name'=>$access_token['screen_name']))), True);



if($access_token)
{	
	$_SESSION['connect']['alert']['success']='Has iniciado sesion con twitter correctamente';

	$_SESSION['connect']['twitter'] = $access_token;

	$_SESSION['connect']['twitter']['pic']=$tt['profile_image_url'];
	$_SESSION['connect']['twitter']['cover']=$tt['profile_banner_url'];
	$_SESSION['connect']['twitter']['name']=$tt['name'];
	#$_SESSION['connect']['twitter']['cover']= $tt_cover['sizes']['1500x500']['url'];
	
	header("Location: ".$_SESSION['connect']['referer'].$_SESSION['connect']['callback']);
}
else 
{	
	$_SESSION['connect']['alert']['danger']='Es necesario que acepte la aplicación para poder iniciar sesion con su cuenta de twitter';

	header("Location: ".$_SESSION['connect']['referer'].$_SESSION['connect']['callback']);
}
