<div class="col-sm-push-1 col-sm-10 col-xs-12 xxs-nopadding">
  <h2>Mi perfil</h2>
  <p>Controla tu información de perfil, tanto lo que ven los demás, opciones de tu cuenta, etc. Los perfiles de usuario se muestran a todo el publico. Para entender lo que es aceptable para mostrar en los perfiles, consulte estas normas.</p>
  <div class="col-xs-12 xxs-noppading">
<?php
  echo HTML('form_settings1');
?>
    <form class="form" role="form"> 

      <div class="form-group">
        <label for="imagen" class="control-label">Imagen de portada :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-image"></i></span>
          <input type="file" class="form-control" name="imagen">
        </div>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-default">Guardar cambios <i class="fa fa-save"></i></button>
      </div>
    </form>
    <hr>
  </div>

  <div class="col-xs-12 xxs-noppading">
    <h3>Inicio de sesión</h3>
<?php
  echo HTML('form_settings2');
?>
    <b>Conectar cuentas de redes sociales, para iniciar sesión con un solo clic.</b>
     
    <a class="btn btn-block btn-social btn-facebook" href="#"> <i class="fa fa-facebook"></i> Conectar con <b>Facebook</b></a>
     
<?php
if($_SESSION['profile']['twitter_id']!='')
{
  echo '<a class="btn btn-social btn-twitter" href="#"> <i class="fa fa-twitter"></i> Desconectar</a> Conectado como <a href="#">'.$_SESSION['profile']['twitter'].'</a>';
}
else
{
  echo '<a class="btn btn-block btn-social btn-twitter" href="#"> <i class="fa fa-twitter"></i> Conectar con <b>Twitter</b></a>';
}
?>  
     
    <hr>
  </div>
  <div class="col-xs-12 xxs-noppading">
    <h3>Notificaciones</h3>
<?php
  if($_SESSION['profile']['email']!='')
  {
    $_SESSION['feedback']['form_settings3']['email']['value']=$_SESSION['profile']['email'];

    if($_SESSION['profile']['email_valid']==0)
    {  
      $LOCALVIEWS['form_settings3']['form']['data']['groups']['email']['params']['text']['content']='Su cuenta de correo no esta confirmada, reenvie correo de validación.';
      $LOCALVIEWS['form_settings3']['form']['data']['groups']['email']['params']['text']['class']='label label-warning';
    }
  }

  echo HTML('form_settings3');
?>
  </div>
</div>