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
      			$permissions = ['email','user_photos']; // optional
      			
      			$loginUrl = $helper->getLoginUrl(URLSYSTEM.'login/fb-callback.php', $permissions);

      			$_SESSION['connect']['referer']=$_SERVER['HTTP_REFERER'];

    			header("Location: " . $loginUrl);
    		}
	}
	if(isset($_GET['logout']))
  	{
      unset($_SESSION['connect']);
  		unset($_SESSION['logged']);
  		header("Location: " . $_SERVER['HTTP_REFERER']);
  	}
  if(isset($_GET['debugger']))
    {
      unset($_SESSION['debugger']);
      header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
//POST
if(isset($_POST))
{
  if(isset($_POST['formid']))
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
        $_SESSION['feedback'][$formid]['button']='warning';
      }
      else 
      {
/*        if($formtype=='login')
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
        */
        if($formtype=='contact')
        {
          $formstatus=InsertMessage($_POST);
        }
        /*
         if($formtype=='chat' || $formtype=='contact')
        {
          $formstatus=Insert_chat($_POST);
        }
        if($formtype=='comment')
        {
          $formstatus=Insert_comment($_POST);
        }
*/
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