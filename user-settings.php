<div class="col-sm-push-1 col-sm-10 col-xs-12 xxs-nopadding">
  <h2>Mi perfil</h2>
  <p>Controla tu información de perfil, tanto lo que ven los demás, opciones de tu cuenta, etc. Los perfiles de usuario se muestran a todo el publico. Para entender lo que es aceptable para mostrar en los perfiles, consulte estas normas.</p>
  <div class="col-xs-12 xxs-noppading">
<?php
  echo HTML('form_settings_name');
?>
<div class="form-group">
  <label for="imagen" class="control-label">Imagen de perfil :</label>
  <ul class="list-group">
    <li class="list-group-item">
      <div class="media">
        <div class="media-left">
          <i class="fa fa-image fa-2x"></i>
        </div>
        <div class="media-body">
<?php
  echo HTML('form_settings_pic');
?>
        </div>
        <div class="media-right">
          <a href="" class="btn btn-default">Activar</a>
        </div>
        <small>Imagen recomendada de 110px de ancho y 110px de alto, de hasta 200kb.</small>
      </div>  
    </li>
<?php
if(isset($_SESSION['profile']['networks']['facebook']))
{
  echo '<li class="list-group-item">
      <div class="media">
        <div class="media-left">
          <i class="fa fa-facebook fa-2x"></i>
        </div>
        <div class="media-body">
          <img src="'.$_SESSION['profile']['networks']['facebook']['pic'].'" class="img-thumbnail">
        </div>
        <div class="media-right">
          <a href="" class="btn btn-default">Activar</a>
        </div>
      </div>  
    </li>';
}
if(isset($_SESSION['profile']['networks']['twitter']))
{
  echo '<li class="list-group-item">
      <div class="media">
        <div class="media-left">
          <i class="fa fa-twitter fa-2x"></i>
        </div>
        <div class="media-body">
          <img src="'.$_SESSION['profile']['networks']['twitter']['pic'].'" class="img-thumbnail">
        </div>
        <div class="media-right">
          <a href="" class="btn btn-default">Activar</a>
        </div>
      </div>  
    </li>';
}
?>
  </ul>
</div>

      <div class="form-group">
        <label for="imagen" class="control-label">Imagen de portada :</label>
  <ul class="list-group">
    <li class="list-group-item">
      <div class="media">
        <div class="media-left">
          <i class="fa fa-image fa-2x"></i>
        </div>
        <div class="media-body">
<?php
  echo HTML('form_settings_cover');
?>
        
        </div>
        <div class="media-right">
          <a href="" class="btn btn-default">Activar</a>
        </div>
        <small>Imagen recomendada de 1360px de ancho y 360px de alto, de hasta 1MB.</small>
      </div>  
    </li>
<?php
if(isset($_SESSION['profile']['networks']['facebook']))
{
  echo '<li class="list-group-item">
      <div class="media">
        <div class="media-left">
          <i class="fa fa-facebook fa-2x"></i>
        </div>
        <div class="media-body">
          <img src="'.$_SESSION['profile']['networks']['facebook']['cover'].'" class="img-thumbnail">
        </div>
        <div class="media-right">
          <a href="" class="btn btn-default">Activar</a>
        </div>
      </div>  
    </li>';
}
if(isset($_SESSION['profile']['networks']['twitter']))
{
  echo '<li class="list-group-item">
      <div class="media">
        <div class="media-left">
          <i class="fa fa-twitter fa-2x"></i>
        </div>
        <div class="media-body">
          <img src="'.$_SESSION['profile']['networks']['twitter']['cover'].'" class="img-thumbnail">
        </div>
        <div class="media-right">
          <a href="" class="btn btn-default">Activar</a>
        </div>
      </div>  
    </li>';
}
?>
  </ul>
      </div>

    
  </div>

  <div class="col-xs-12 xxs-noppading">
    <hr>
    <h3>Inicio de sesión</h3>
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