<?php
#FormContact
if(isset($_SESSION['logged']))
{
echo '
	<div class="media">
        <div class="media-left">
            <img src="'.ShowPic().'" class="profile-pic">
        </div>
      	<div class="media-body">
            <strong class="media-heading">'.$_SESSION['logged']['name'].'</strong>
            <form class="form" role="form" action="'.$form['action'].'#'.$form['callback'].'" method="POST">
              <input type="hidden" name="formid" value="'.$form['id'].'">
              <input type="hidden" name="formtype" value="'.$form['type'].'">
              <div class="form-group '.FeedbackClass($_SESSION['feedback'][$form['id']]['message']).'">'.FeedbackIcon($_SESSION['feedback'][$form['id']]['message']).'
                <textarea class="form-control" name="message" placeholder="Su mensaje a la administracion ..." minlength="8" maxlength="512" required=""></textarea>
              </div>
              <div class="form-group response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
              <div class="form-group col-xs-12">
                <button type="submit" class="btn btn-default"><i class="fa fa-envelope"></i> Enviar mensaje</button>
              </div>
            </form>
        </div>
    </div>
';
}
else
{
echo '	
	<form class="form" role="form" action="" method="POST">
        <input type="hidden" name="formid" value="'.$form['id'].'">
        <input type="hidden" name="formtype" value="'.$form['type'].'">
      	<div class="form-group col-xs-12">
      		<p><i class="fa fa-info-circle"></i> Complete los siguientes campos o <b><i class="fa fa-sign-in"></i> Inicie sesion</b> / <b><i class="fa fa-user-plus"></i> Registarse</b>.</p>
      		<label>Conectarse con :</label> 
      			<a class="btn btn-social-icon btn-facebook" href="?login=facebook';
            if($form['callback'])
            {
              echo '&callback='.$form['callback'];
            }
            echo '"> <i class="fa fa-facebook"></i></a> 
      			<a class="btn btn-social-icon btn-twitter" href="?login=twitter';
            if($form['callback'])
            {
              echo '&callback='.$form['callback'];
            }
            echo '"> <i class="fa fa-twitter"></i></a>
      	</div>
      	<div class="form-group col-xs-6 col-xxs-12">
      		<div class="input-group">
      			<span class="input-group-addon"><i class="fa fa-user"></i></span>
      			<input type="text" class="form-control" name="name" placeholder="Tu nombre ..." required="">
      		</div>
      	</div>
      	<div class="form-group col-xs-6 col-xxs-12">
      		<div class="input-group">
      			<span class="input-group-addon"><i class="fa fa-at"></i></span>
      			<input type="email" class="form-control" name="email" placeholder="Tu correo ..." required="">
      		</div>
      	</div>
      	<div class="form-group col-xs-12">
      		<label><input type="checkbox" name="funnel" value="signon" checked=""> Crearme una cuenta <b>GRATIS!</b>.</label> Recibira un correo para confirmar.
      	</div>
      	<div class="form-group col-xs-12">
      		<div class="input-group">
      			<span class="input-group-addon"><i class="fa fa-edit"></i></span>
      			<textarea class="form-control" name="message" placeholder="Su mensaje a la administración ..." required=""></textarea>
      		</div>
      	</div>
      	<div class="form-group col-xs-12">
      		<button type="submit" class="btn btn-default btn-block"><i class="fa fa-envelope"></i> Enviar mensaje</button>
      	</div>
    </form>
';
}
unset($_SESSION['feedback'][$form['id']]);