<?php
#Requests
include 'validatefields.php';

##############################


if(isset($_POST)) // Si se reciben datos por post, se procesan
{
	if(isset($_POST['formid']))
	{
		$formid=$_POST['formid'];
		$formtype=$_POST['formtype'];

		foreach ($_POST as $field => $value)
		{
			if($field!='formid' && $field!='formtype')
			{	
				$_SESSION['feedback'][$formid][$field]['value']=$value;
				$feedback=$_SESSION['feedback'][$formid][$field]['status']=Validate($field,$value);

				if($feedback!='valid' && $feedback!='norequired')
  				{
  					$warningFields++;
  				}
			}
		}
    if(!empty($_FILES))
    { 
      foreach ($_FILES as $field => $file) 
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
  			$_SESSION['feedback'][$formid]['button']='warning';
  		}
  		else 
  		{
  			if($formtype=='login')
    		{
    			$formstatus=Login($_POST);
    		}
        if($formtype=='signup')
        {
          $formstatus=Signup($_POST);
        }
        if($formtype=='settings')
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
        if($formtype=='message')
        {
          $formstatus=Insert($_POST);
        }
         if($formtype=='chat' || $formtype=='contact')
        {
          $formstatus=Insert_chat($_POST);
        }
        if($formtype=='comment')
        {
          $formstatus=Insert_comment($_POST);
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
  		}
	}
}
if(isset($_GET))
{
	if(isset($_GET['logout']))
	{
		$formstatus=Logout();

		if(key($formstatus['alert'])=='success')
		{
			header("Location: ".$_SERVER['HTTP_REFERER'].$_GET['callback']);
		}
	}
  if(isset($_GET['login']) || isset($_GET['connect']))
  {
    if($_GET['login']=='facebook' || $_GET['connect']=='facebook')// Iniciar secion con la API de Facebook
    {
      #require_once __DIR__ . 'account/Facebook/autoload.php';
      include_once('account/Facebook/autoload.php');
      $fb = new Facebook\Facebook([
        'app_id' => FBAPPID,
        'app_secret' => FBAPPSECRET,
        'default_graph_version' => 'v2.2',
        ]);
      $helper = $fb->getRedirectLoginHelper();
      $permissions = ['email']; // optional
      $loginUrl = $helper->getLoginUrl(URLSYSTEM.'account/fb-callback.php', $permissions);

      if($_GET['login'])
      {
        $_SESSION['connect']['action']='login';
      }
      else
      {
        $_SESSION['connect']['action']='connect';
      }
      if($_GET['referer'])
      {
        $_SESSION['connect']['referer']=$_GET['referer'];
      }
      else
      {
        $_SESSION['connect']['referer']=$_SERVER['HTTP_REFERER'];
      }

      if($_GET['callback'])
      {
        $_SESSION['connect']['callback']=$_GET['callback'];
      }
    header("Location: " . $loginUrl);
    }

    if($_GET['login']=='twitter' || $_GET['connect']=='twitter') // Iniciar sesion con la API de Twitter
    {
      include_once("account/twitter/twitteroauth.php");
      $connection = new TwitterOAuth(TWCONSUMERKEY, TWCONSUMERSECRET);
      $request_token = $connection->getRequestToken(URLSYSTEM.'account/tw-callback.php');

      $_SESSION['connect']['twitter']['token']      = $request_token['oauth_token'];
      $_SESSION['connect']['twitter']['token_secret']   = $request_token['oauth_token_secret'];

      $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
      
      if($_GET['login'])
      {
        $_SESSION['connect']['action']='login';
      }
      else
      {
        $_SESSION['connect']['action']='connect';
      }
      if($_GET['referer'])
      {
        $_SESSION['connect']['referer']=$_GET['referer'];
      }
      else
      {
        $_SESSION['connect']['referer']=$_SERVER['HTTP_REFERER'];
      }

      if($_GET['callback'])
      {
        $_SESSION['connect']['callback']=$_GET['callback'];
      }

      header('Location: ' . $twitter_url); 
    }
  }
  if(isset($_GET['confirmation']))
  {
    $_SESSION['feedback']['top']['alert']['success'] = 'Tu correo ha sido confirmado correctamente.';
  }
  if(isset($_SESSION['profile']) && (isset($_GET['like'])||isset($_GET['dislike'])))
  {
    if(isset($_GET['like']))
    {
      $_SESSION['feedback']['top']=Insert_likes(array(
                                                'formtype'  => 'like',
                                                'likeid'    => $_GET['element'],
                                                'liketype'  => $_GET['like']
                                                  ));
    }
    else
    {
      $_SESSION['feedback']['top']=Insert_likes(array(
                                                'formtype'  => 'dislike',
                                                'likeid'    => $_GET['element'],
                                                'liketype'  => $_GET['dislike']
                                                  ));
    }
    
  }
}