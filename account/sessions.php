<?php
#Sessions
include 'dbhandler.php';
if(isset($_SESSION['profile']) || isset($_SESSION['connect'])) //Detectar si hay sesion iniciada
{
  if(isset($_SESSION['connect']['facebook']['id']))
  {
    $_SESSION['connect']['facebook']['domain']=UMSDOMAIN;
    $profile = profile_search('facebook',$_SESSION['connect']['facebook']);
    
    if($profile!=null)
    { 
      $_SESSION['profile']= $profile;
    }
    else
    {
      $profile = profiles(array(
                'domain'      => UMSDOMAIN,
                'funnel'      => 'connect',
                'name'        => $_SESSION['connect']['facebook']['name'],
                'email'       => $_SESSION['connect']['facebook']['email'],
                'facebook_id' => $_SESSION['connect']['facebook']['id']
                ));
      if($profile!=null)
      { 
        $_SESSION['profile']=$profile;

      }
    }

  }
  if(isset($_SESSION['connect']['twitter']['user_id']))
  {
    $_SESSION['connect']['twitter']['domain']=UMSDOMAIN;
    $_SESSION['connect']['twitter']['id']=$_SESSION['connect']['twitter']['user_id'];

    $profile = profile_search('twitter',$_SESSION['connect']['twitter']);

    if($profile!=null)
    { 
      $_SESSION['profile']= $profile;
    }
    else
    {
      $profile = profile_new(array(
                'domain'      => UMSDOMAIN,
                'funnel'      => 'connect',
                'name'        => $_SESSION['connect']['twitter']['screen_name'],
                'twitter_id'  => $_SESSION['connect']['twitter']['user_id']
                ));
      if($profile!=null)
      { 
        $_SESSION['profile']=$profile;
      
      }
    }
  }
  if(isset($_SESSION['profile']))
  {
     unset($_SESSION['connect']);
  }
}
elseif(isset($_COOKIE['token'])) //Detectar si hay token de sesion
{
  $profile = profiles(array(
                'domain'    => UMSDOMAIN,
                'action'    => 'autologin',
                'token'     => $_COOKIE['token']
                ));

  if($profile['id'])
  {
    $_SESSION['profile'] = $profile; // Asignar el perfil a la sesion
  }
}
elseif(!isset($_COOKIE['token']) && isset($_COOKIE['device']))
{
  $profile=profile_search('device',array('device'=>$_COOKIE['device'],'domain'=>UMSDOMAIN));
  if($profile)
  {
    $_SESSION['user']['name']=$profile['name'];
    $_SESSION['user']['email']=$profile['email'];
  }    
}