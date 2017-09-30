<?php
session_start();
include '../config.php';
include_once("twitter/twitteroauth.php");

$connection = new TwitterOAuth(TWCONSUMERKEY, TWCONSUMERSECRET, $_SESSION['connect']['twitter']['token'] , $_SESSION['connect']['twitter']['token_secret']);

$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

$tt = json_decode(json_encode($connection->get('users/show', array('screen_name'=>$access_token['screen_name']))), True);
$tt_email = $connection->get("account/verify_credentials", ['include_entities' => true, 'skip_status' => true, 'include_email' => true]);
$_SESSION['tt']=$tt_email;

#$tt_cover = json_decode(json_encode($connection->get('users/profile_banner', array('screen_name'=>$access_token['screen_name']))), True);



if($access_token['user_id'])
{	
	if(isset($_SESSION['debugger']))
	{
		$_SESSION['debugger'][]='API:twitter:connect => ConnectAccount()';
	}
	$_SESSION['connect']['alert']['success']='Has iniciado sesion con twitter correctamente';

	$UserConnect['network']['net']='twitter';
	$UserConnect['network']['id']=$access_token['user_id'];
	$UserConnect['network']['name']=$UserConnect['name']=$tt['name'];
	$UserConnect['network']['screenname']=$access_token['screen_name'];
	$UserConnect['network']['email']=$tt_email->email;
	$UserConnect['network']['pic']=$tt['profile_image_url_https'];
	$UserConnect['network']['cover']=$tt['profile_banner_url_https'];
	$UserConnect['pic']='twitter';
	$UserConnect['cover']='twitter';
	$UserConnect['type']='connect';
	$UserConnect['form_id'] = (isset($_SESSION['connect']['callback'])) ? $_SESSION['connect']['callback'] : $_SESSION['connect']['btn'];
	$UserConnect['url_ref']=$_SESSION['connect']['ref'];
	
	require '../accounts/function_connect.php';

	$_SESSION['logged']=ConnectAccount($UserConnect);
	$_SESSION['logged']['login']='twitter';
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