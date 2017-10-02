<?php
//REQUESTS
include 'global/functions_validations.php';

if(isset($_GET))
{
	if(isset($_GET['login']))
  	{
    		if($_GET['login']=='facebook')// Iniciar sesion con la API de Facebook
    		{
          if(isset($_SESSION['debugger']))
          {
            $_SESSION['debugger'][]='GET:login:facebook => facebook.com';
          }

      			include_once('login/Facebook/autoload.php');
      			$fb = new Facebook\Facebook([
        									'app_id' => FBAPPID,
        									'app_secret' => FBAPPSECRET,
        									'default_graph_version' => 'v2.7',
        									]);

      			$helper = $fb->getRedirectLoginHelper();
      			//$permissions = ['email','user_photos'];  optional
      			$permissions = ['email']; 
      			$loginUrl = $helper->getLoginUrl(URLSYSTEM.'login/fb-callback.php', $permissions);

      			$_SESSION['connect']['referer']=$_SERVER['HTTP_REFERER'];
            $_SESSION['connect']['ref']=strtok($_SERVER['HTTP_REFERER'],'?');

            if($_GET['btn'])
            {
              $_SESSION['connect']['btn']=$_GET['btn'];
            }
            if($_GET['callback'])
            {
              $_SESSION['connect']['callback']=$_GET['callback'];
              $_SESSION['connect']['error']=$_GET['error'];
            }

    			header("Location: " . $loginUrl);
    		}
        if($_GET['login']=='twitter') // Iniciar sesion con la API de Twitter
        {
          if(isset($_SESSION['debugger']))
          {
            $_SESSION['debugger'][]='GET:login:twitter => twitter.com';
          }
          include_once("login/twitter/twitteroauth.php");
          $connection = new TwitterOAuth(TWCONSUMERKEY, TWCONSUMERSECRET);
          $request_token = $connection->getRequestToken(URLSYSTEM.'login/tw-callback.php');

          $_SESSION['connect']['twitter']['token']      = $request_token['oauth_token'];
          $_SESSION['connect']['twitter']['token_secret']   = $request_token['oauth_token_secret'];

          $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);

          $_SESSION['connect']['referer']=$_SERVER['HTTP_REFERER'];
          $_SESSION['connect']['ref']=strtok($_SERVER['HTTP_REFERER'],'?');

          if($_GET['btn'])
          {
            $_SESSION['connect']['btn']=$_GET['btn'];
          }
          if($_GET['callback'])
            {
              $_SESSION['connect']['callback']=$_GET['callback'];
              $_SESSION['connect']['error']=$_GET['error'];
            }
        header('Location: ' . $twitter_url); 
    }
    if($_GET['login']=='google')
    {
      if(isset($_SESSION['debugger']))
          {
            $_SESSION['debugger'][]='GET:login:google => google.com';
          }
      require_once 'login/google/Google_Client.php';
      require_once 'login/google/contrib/Google_Oauth2Service.php';

      $client = new Google_Client(); 
      $client->setApplicationName("Google UserInfo PHP Starter Application");
      $client->setClientId(GCLIENT);
      $client->setClientSecret(GSECRET);
      $client->setRedirectUri(URLSYSTEM.'login/g-callback.php');
      $oauth2 = new Google_Oauth2Service($client);
      $authUrl = $client->createAuthUrl();
      $_SESSION['connect']['referer']=$_SERVER['HTTP_REFERER'];
      $_SESSION['connect']['ref']=strtok($_SERVER['HTTP_REFERER'],'?');
      
            if($_GET['btn'])
            {
              $_SESSION['connect']['btn']=$_GET['btn'];
            }
            if($_GET['callback'])
            {
              $_SESSION['connect']['callback']=$_GET['callback'];
              $_SESSION['connect']['error']=$_GET['error'];
            }
      
          header("Location: " . $authUrl);
    }
	}
  if(isset($_GET['likes']))
  {
      include 'global/functions_like.php';  
  }
	if(isset($_GET['logout']))
  	{
      unset($_SESSION['connect']);
  		unset($_SESSION['logged']);
      unset($_COOKIE['token']);
      setcookie('token', null, -1, '/', UMSDOMAIN);
  		header("Location: " . $_SERVER['HTTP_REFERER']);
  	}
  if(isset($_GET['debugger']))
    {
      unset($_SESSION['debugger']);
      header("Location: " . $_SERVER['HTTP_REFERER']);
    }
  if(isset($_GET['sendconfirm']))
  {
    include 'accounts/function_SendEmail.php';
    if(Send_email('confirmation',$_SESSION['logged']))
    {
       header("Location: " . $_SERVER['HTTP_REFERER'].'#'.$_GET['callback']);
    }
    else
    {
      header("Location: " . $_SERVER['HTTP_REFERER']);
    }
   
  }
  if(isset($_GET['email']))
  {
    include 'global/functions_emails.php'; 
  }
  if(isset($_GET['app']))
  {
    include 'profile/functions_app.php'; 
  }
  if(isset($_GET['q']))
  {
    include 'accounts/tracking_searchs.php';
  }
}
//POST
if(isset($_POST))
{
  if(isset($_POST['formid']))
  {
    if($_POST['repeatmail']=='')
    {
    $formid=$_POST['formid'];
    $formtype=$_POST['formtype'];

    foreach ($_POST as $field => $value)// Validar todos los campos del formulario
    {
      if($field!='formid' && $field!='formtype')
      { 
        $_SESSION['feedback'][$formid][$field]['value']=$value;
        $feedback=$_SESSION['feedback'][$formid][$field]['status']=Validate($field,$value);

        if($feedback!='valid' && $feedback!='norequired')
          {
            $_SESSION['feedback'][$formid][$field]['display']=$VALIDATIONS[$field]['display'];
            $warningFields++;
          }
      }
    }
    if(!empty($_FILES)) 
    { 
      foreach ($_FILES as $field => $file) // Validar los campos de archivos del formulario
      {
        $feedback=$_SESSION['feedback'][$formid][$field]['status']=Validate_files($field,$file);
        if($feedback!='valid' && $feedback!='norequired')
          {
            $warningFields++;
          }
      }
    }

    if($warningFields)
      {
        $_SESSION['feedback'][$formid]['button']=$_SESSION['feedback'][$formid]['status']='warning';
      }
      else 
      {
        $_SESSION['feedback'][$formid]['status']='success';
        
        if($formtype=='login')
        {
          $formstatus=Login($_POST);
        }
        if($formtype=='signup')
        {
          $formstatus=Signup($_POST);
        }
        if($formtype=='recovery')
        {
          $formstatus=Recovery($_POST);
        }
        
        if($formtype=='settings' && isset($_SESSION['logged']))
        {
          if(!empty($_FILES))
          {
              $formstatus=File_Upload($_FILES);
          }
          else
          {
            $formstatus=Settings($_POST);
          }
          
        }
        
        if($formtype=='contact')
        {
          $formstatus=InsertMessage($_POST);
        }
        /*
         if($formtype=='chat' || $formtype=='contact')
        {
          $formstatus=Insert_chat($_POST);
        }
        */
        if($formtype=='comment')
        {
          $formstatus=InsertComment($_POST);
        }

        $_SESSION['feedback'][$formid]['alert']=$formstatus['alert'];

        if(key($formstatus['alert'])=='success')
        {
          $_SESSION['feedback'][$formid]['button']='success';
        }
        else
        {
          $_SESSION['feedback'][$formid]['button']='warning';
        }

        if($formstatus['feedback'])
        {
          foreach ($formstatus['feedback'] as $field => $feedback) 
          {
            $_SESSION['feedback'][$formid][$field]['status']=$feedback;
          }
        }
      #header('Location: '.$_SERVER['REQUEST_URI']);
      }
    }
    else
    {
      SpamForm($_POST);
    }
  }
}