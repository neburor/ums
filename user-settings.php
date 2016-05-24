<div class="col-sm-push-1 col-sm-10 col-xs-12 xxs-nopadding">
  <h2>Mis preferencias</h2>
  <p>Controla tu información personal, tanto lo que ven los demás como opciones de tu cuenta. Los perfiles de usuario se muestran a todo el publico. Para entender lo que es aceptable para mostrar en los perfiles, consulte estas <a href="">normas</a>.</p>
  <div class="col-xs-12 xxs-noppading">
     <hr>
    <h3>Mi perfil</h3>
    <p>Administra la configuración de visibilidad.</p>
    <div class="row">
<?php
  echo HTML('form_settings_name');
?>
    </div>
  <div class="row well">
<?php
if($_SESSION['profile']['pic']!='')
{
  $LOCALVIEWS['form_settings_pic']['form']['data']['groups']['pic']['select']['selected']=$_SESSION['profile']['pic'].'.png';
}
if(isset($_SESSION['profile']['networks']['facebook']))
{
  $LOCALVIEWS['form_settings_pic']['form']['data']['groups']['pic']['select']['selects']['facebook.png']='Facebook';
  $LOCALVIEWS['form_settings_cover']['form']['data']['groups']['cover']['select']['selects']['facebook.png']='Facebook';
}
if(isset($_SESSION['profile']['networks']['twitter']))
{
  $LOCALVIEWS['form_settings_pic']['form']['data']['groups']['pic']['select']['selects']['twitter.png']='Twitter';
  $LOCALVIEWS['form_settings_cover']['form']['data']['groups']['cover']['select']['selects']['twitter.png']='Twitter';
}
if(file_exists('images/pic/pic_'.$_SESSION['profile']['id'].'.jpg'))
{
  $LOCALVIEWS['form_settings_pic']['form']['data']['groups']['pic']['select']['selects']['local.png']='Imagen subida';
} 
  echo HTML('form_settings_pic');
  echo HTML('form_settings_pic_upload');
?>
  </div>
  <div class="row well">
<?php
if($_SESSION['profile']['cover']!='')
{
  $LOCALVIEWS['form_settings_cover']['form']['data']['groups']['cover']['select']['selected']=$_SESSION['profile']['cover'].'.png';
}
if(file_exists('images/cover/cover_'.$_SESSION['profile']['id'].'.jpg'))
{
  $LOCALVIEWS['form_settings_cover']['form']['data']['groups']['cover']['select']['selects']['local.png']='Imagen subida';
} 
echo HTML('form_settings_cover');
  echo HTML('form_settings_cover_upload');
?>
  </div>
    
  </div>

  <div class="col-xs-12 xxs-noppading">
    <hr>
    <h3>Opciones de cuenta</h3>
    <p>Controla la contraseña y la configuración de acceso a los datos de la cuenta.</p>
<?php
if($_SESSION['profile']['password']!='')
{
  echo HTML('form_settings_pass1');
}
else
{
  echo HTML('form_settings_pass2');
}
  
?>
    <b>Conectar cuentas de redes sociales, para iniciar sesión con un solo clic.</b>
 <div class="col-md-6 col-md-push-3">
                <ul class="list-group">
                  <li class="list-group-item">
                    <div class="media">
                      <div class="media-left">
                        <i class="fa fa-facebook fa-2x"></i>
                      </div>
                      <?php
if(isset($_SESSION['profile']['networks']['facebook']))
{
  echo '<div class="media-body"><div class="media"><div class="media-left"><img src="'.$_SESSION['profile']['networks']['facebook']['pic'].'" class="profile-pic"></div><div class="media-body"><a href="https://www.facebook.com/app_scoped_user_id/'.$_SESSION['profile']['networks']['facebook']['network_id'].'/" target="_blank">'.$_SESSION['profile']['networks']['facebook']['name'].'</a></div></div></div>';
}
else
{
  echo '<div class="media-body"><span class="hidden-xxs">Conectar con facebook</span></div><div class="media-right">'.htmllinks($LOCALVIEWS['link_settings_facebook']).'</div>';
}
                      ?>
                    </div>  
                  </li>
                  <li class="list-group-item">
                    <div class="media">
                      <div class="media-left">
                        <i class="fa fa-twitter fa-2x"></i>
                      </div>
 <?php
if(isset($_SESSION['profile']['networks']['twitter']))
{
  echo '<div class="media-body"><div class="media"><div class="media-left"><img src="'.$_SESSION['profile']['networks']['twitter']['pic'].'" class="profile-pic"></div><div class="media-body" class="profile-pic"><a href="https://twitter.com/'.$_SESSION['profile']['networks']['twitter']['url'].'" target="_blank">'.$_SESSION['profile']['networks']['twitter']['name'].'</a></div></div></div>';
}
else
{
  echo '<div class="media-body"><span class="hidden-xxs">Conectar con twitter</span></div><div class="media-right">'.htmllinks($LOCALVIEWS['link_settings_twitter']).'</div>';
}
                      ?>
                    </div>  
                  </li>
                </ul>
                </div>      
   
  </div>
  <div class="col-xs-12 xxs-noppading">
     <hr>
    <h3>Notificaciones</h3>
<?php
  if($_SESSION['profile']['notifs'])
  {
    foreach ($_SESSION['profile']['notifs'] as $notif => $value) 
    {
      if($notif=='email')
      {
          $_SESSION['feedback']['form_settings_notif']['email']['value']=$value['to'];
          if($value['status']!='valid')
          {
            $LOCALVIEWS['form_settings_notif']['form']['data']['groups']['email']['params']['text']['content']='Su cuenta de correo no esta confirmada, reenvie correo de validación.';
            $LOCALVIEWS['form_settings_notif']['form']['data']['groups']['email']['params']['text']['class']='label label-warning full-width text-warp';
            $LOCALVIEWS['form_settings_notif']['form']['data']['groups']['email']['button']=$BUTTONS['resend'];
          }
      }  

    }
  }

  echo HTML('form_settings_notif');
?>
  </div>
</div>