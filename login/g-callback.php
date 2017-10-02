<?php
session_start();
#error_reporting(E_ERROR | E_WARNING | E_PARSE);

require '../config.php';
require_once 'google/Google_Client.php';
require_once 'google/contrib/Google_Oauth2Service.php';
$client = new Google_Client();
$client->setApplicationName("Google UserInfo PHP Starter Application");
// Visit https://code.google.com/apis/console?api=plus to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
 $client->setClientId(GCLIENT);
 $client->setClientSecret(GSECRET);
 $client->setRedirectUri(URLSYSTEM.'login/g-callback.php');
// $client->setDeveloperKey('insert_your_developer_key');
$oauth2 = new Google_Oauth2Service($client);

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  return;
}

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  $client->revokeToken();
}
if ($client->getAccessToken()) {
  $user = $oauth2->userinfo->get();
  $_SESSION['token'] = $client->getAccessToken();

	if(isset($_SESSION['debugger']))
	{
		$_SESSION['debugger'][]='API:google:connect => ConnectAccount()';
	}
	$_SESSION['connect']['alert']['success']='Has iniciado sesion con google correctamente';


	$UserConnect['network']['net']='google';
	$UserConnect['network']['id']=$user['id'];
	$UserConnect['network']['name']=$UserConnect['name']=$user['name'];
	$UserConnect['network']['email']=$user['email'];
	$UserConnect['pic']='google';
	$UserConnect['cover']='google';
	$UserConnect['form_id'] = (isset($_SESSION['connect']['error'])) ? $_SESSION['connect']['error'] : ((isset($_SESSION['connect']['callback'])) ? $_SESSION['connect']['callback'] : $_SESSION['connect']['btn']);
	$UserConnect['url_ref']=$_SESSION['connect']['ref'];
    $output = "https://www.googleapis.com/plus/v1/people/" . $user['id'] . "?fields=cover&key=" . GAPI;
    $json = json_decode(file_get_contents($output));
    if (!($json === true || $json === false || $json === null))
    {
        $UserConnect['network']['cover']=$json->cover->coverPhoto->url;
    
		if(isset($json->cover->coverInfo->topImageOffset))
		{
			$UserConnect['network']['cover_y']=$json->cover->coverInfo->topImageOffset;
		}
		if(isset($json->cover->coverInfo->leftImageOffset))
		{
			$UserConnect['network']['cover_x']=$json->cover->coverInfo->leftImageOffset;
		}
	}
	$UserConnect['network']['pic']=$user['picture'];
	$UserConnect['type']='connect';

	require '../accounts/function_connect.php';
	$_SESSION['logged']=ConnectAccount($UserConnect);
	$_SESSION['logged']['login']='google';
	$callback='#'.$_SESSION['connect']['callback'];
}
else 
{	
	if(isset($_SESSION['debugger']))
	{
		$_SESSION['debugger'][]='API:google:error | ';
	}
	$_SESSION['connect']['alert']['danger']='Error de inicio de sesion';
	$callback='#'.$_SESSION['connect']['error'];
}

header("Location: ".$_SESSION['connect']['referer'].$callback);