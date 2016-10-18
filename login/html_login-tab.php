<?php
#Login TAB
echo '
<div class="col-sm-5">
	<div class="media-body text-center">
        <i class="fa fa-sign-in fa-4x"></i>
        <b class="media-heading">INICIAR SESION</b>
        <p>Inicia sesion para acceder a tu perfil !</p>
    </div>
	<div class="form-group">
		<label>Conectarse con :</label> 
		<a class="btn btn-social-icon btn-facebook" href=""> <i class="fa fa-facebook"></i></a> 
		<a class="btn btn-social-icon btn-twitter" href=""> <i class="fa fa-twitter"></i></a>
	</div>
</div>
<form class="form col-sm-7 xxs-nopadding" role="form" method="POST">
	<input type="hidden" name="formid" value="form_login_contact">
	<input type="hidden" name="formtype" value="login">
	<input type="hidden" name="callback" value="%23ums:panel_contact:tab:panel_contact-login">
	<div class="form-group col-xs-12">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-at"></i></span>
			<input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="">
		</div>
	</div>
	<div class="form-group col-xs-12">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-lock"></i></span>
			<input type="password" class="form-control" name="userpass" placeholder="Su contraseña ..." minlength="4" maxlength="32" required="">
		</div>
	</div>
	<div class="form-group col-xs-12">
		<label><input type="checkbox" name="autologin" checked=""><b> Recordarme !</b></label>
	</div>
	<div class="form-group response"></div>
	<div class="form-group col-xs-12">
		<button type="submit" class="btn btn-default"> <i class="fa fa-sign-in"></i> <span>Iniciar sesion</span></button>
	</div>
</form>
';