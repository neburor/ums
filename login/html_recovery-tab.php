<?php
#Login TAB
echo '
<div class="'.$div['intro'].'">
	<div class="media-body text-center">
        <i class="fa fa-lock fa-4x"></i>
        <b class="media-heading">RECUPERAR CONTRASEÑA</b>
        <p>Escribe el correo registrado para recuperar contraseña</p>
    </div>
</div>
<form class="form '.$div['form'].' xxs-nopadding" role="form" action="'.$form['action'].'#'.$form['callback']['error'].'" method="POST">
    <input type="hidden" name="formid" value="'.$form['id'].'"/>
    <input type="hidden" name="formtype" value="'.$form['type'].'"/>
    <input type="hidden" name="callback" value="'.$form['callback']['success'].'">
	<div class="form-group col-xs-12 '.FeedbackClass($_SESSION['feedback'][$form['id']]['useremail']).'">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-at"></i></span>
			<input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['useremail']).'>
		'.FeedbackIcon($_SESSION['feedback'][$form['id']]['useremail']).'
		</div>
	</div>
	<div class="form-group col-xs-12 response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
	<div class="form-group col-xs-12">
		<button type="submit" class="btn btn-default"> <i class="fa fa-mail-forward"></i> <span>Enviar</span></button>
	</div>
</form>
';
unset($_SESSION['feedback'][$form['id']]);