<?php
#Login TAB
echo '
<div class="col-sm-5">
	<div class="media-body text-center">
        <i class="fa fa-user-plus fa-4x"></i>
        <b class="media-heading">REGISTRARSE</b>
        <p>Crea una cuenta <b>GRATIS</b> !</p>
    </div>
    <div class="form-group"> 
    	<a class="btn btn-block btn-social btn-facebook" href=""> <i class="fa fa-facebook"></i> <span>Registrarse con Facebook</span></a> 
    	<a class="btn btn-block btn-social btn-twitter" href=""> <i class="fa fa-twitter"></i> <span>Registrarse con Twitter</span></a>
	</div>
</div>
<form class="form col-sm-7 xxs-nopadding" role="form" method="POST">
	<input type="hidden" name="formid" value="form_signup_contact">
	<input type="hidden" name="formtype" value="signup">
	<input type="hidden" name="callback" value="%23ums:panel_contact:tab:panel_contact-signup">
	<div class="form-group col-xs-12">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-user"></i></span>
			<input type="text" class="form-control" name="name" placeholder="Su nombre ..." minlength="4" maxlength="64" required="">
		</div>
	</div>
	<div class="form-group col-xs-12">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-at"></i></span>
			<input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="">
		</div>
	</div>
	<div class="form-group col-sm-6 col-xs-12">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-key"></i></span>
			<input type="password" class="form-control" name="pass" placeholder="Su contraseña ..." minlength="4" maxlength="32">
		</div>
	</div>
	<div class="form-group col-sm-6 col-xs-12">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-key"></i></span>
			<input type="password" class="form-control" name="repass" placeholder="Repetir contraseña ..." minlength="4" maxlength="32">
		</div>
	</div>
	<div class="form-group col-xs-12">
		<label><input type="checkbox" name="autopass"><b> Contraseña automatica !</b></label>
	</div>
	<div class="form-group response"></div>
	<div class="form-group col-xs-12">
		<button type="submit" class="btn btn-default"> <i class="fa fa-user-plus"></i> <span>Crear cuenta</span></button>
	</div>
</form>
';