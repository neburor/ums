<?php
#Login TAB
echo '
<div class="'.$div['intro'].'">
	<div class="media-body text-center">
        <i class="fa fa-sign-in fa-4x"></i>
        <b class="media-heading">INICIAR SESION</b>
        <p>Inicia sesion para acceder a tu perfil !</p>
    </div>
	<div class="form-group">
		<label>Conectarse con :</label> 
		<a class="btn btn-social-icon btn-facebook" href="?login=facebook'.$form['connect'];
            if($form['callback'])
            {
              echo '&callback='.$form['callback']['success'].'&error='.$form['callback']['error'];
            }
            echo '" rel="nofollow"> <i class="fa fa-facebook"></i></a> 
        <a class="btn btn-social-icon btn-google" href="?login=google'.$form['connect'];
            if($form['callback'])
            {
              echo '&callback='.$form['callback']['success'].'&error='.$form['callback']['error'];
            }
            echo '" rel="nofollow"> <i class="fa fa-google"></i></a>
		<a class="btn btn-social-icon btn-twitter" href="?login=twitter'.$form['connect'];
            if($form['callback'])
            {
              echo '&callback='.$form['callback']['success'].'&error='.$form['callback']['error'];
            }
            echo '" rel="nofollow"> <i class="fa fa-twitter"></i></a>
	</div>
</div>
<form class="form '.$div['form'].' xxs-nopadding" role="form" action="'.$form['action'].'#'.$form['callback']['error'].'" method="POST">
    <input type="hidden" name="formid" value="'.$form['id'].'">
    <input type="hidden" name="formtype" value="'.$form['type'].'">
    <input type="hidden" name="callback" value="'.$form['callback']['success'].'">
	<div class="form-group col-xs-12 '.FeedbackClass($_SESSION['feedback'][$form['id']]['useremail']).'">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-at"></i></span>
			<input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['useremail']).'>
			'.FeedbackIcon($_SESSION['feedback'][$form['id']]['useremail']).'
		</div>
	</div>
	<div class="form-group col-xs-12 '.FeedbackClass($_SESSION['feedback'][$form['id']]['userpass']).'">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-lock"></i></span>
			<input type="password" class="form-control" name="userpass" placeholder="Su contraseña ..." minlength="4" maxlength="32" required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['userpass']).'>
			'.FeedbackIcon($_SESSION['feedback'][$form['id']]['userpass']).'
		</div>';
		if($form['recovery'])
		{
			echo $form['recovery'];
		}
	echo '</div>
	<div class="form-group col-xs-12">
		<label><input type="checkbox" name="autologin" checked=""><b> Recordarme !</b></label>
	</div>
	<div class="form-group col-xs-12 response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
	<div class="form-group col-xs-12">
		<button type="submit" class="btn btn-default"> <i class="fa fa-sign-in"></i> <span>Iniciar sesion</span></button>
	</div>
</form>
';
unset($_SESSION['feedback'][$form['id']]);