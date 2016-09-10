<div class="col-sm-5">
	<div class="media-body text-center">
          <i class="fa fa-sign-in fa-4x"></i>
          <b class="media-heading">INICIAR SESION</b>
          <p>Inicia sesión para acceder a tu perfil !</p>
    </div>
    <div class="form-group text-center">
    	<a class="btn btn-social btn-facebook" href="?login=facebook"> <i class="fa fa-facebook"></i> Iniciar sesión<span class="hidden-xs"> con Facebook</span></a>
    </div>
</div>

<form class="form col-sm-7 xxs-nopadding" role="form" method="POST">
	<input type="hidden" name="formid" value="form_message">
	<input type="hidden" name="formtype" value="contact">
	<input type="hidden" name="callback" value="%23ums:panel_contact:tab:panel_contact-message">
		<fieldset class="well well-sm">
		<p>
			<i class="fa fa-info-circle"></i> Complete los siguientes campos o inicie sesión
		</p>
		<div class="form-group col-sm-6 col-xs-12">
			<div class="input-group">
				<span class="input-group-addon"> <i class="fa fa-user"></i></span>
				<input type="text" class="form-control" name="name" placeholder="Escriba su Nombre ..." minlength="4" maxlength="64" required="">
			</div>
		</div>
		<div class="form-group col-sm-6 col-xs-12">
			<div class="input-group">
				<span class="input-group-addon"> <i class="fa fa-at"></i></span>
				<input type="email" class="form-control" name="email" placeholder="Escriba su correo electrónico..." minlength="8" maxlength="64" required="">
			</div>
		</div>
	</fieldset>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-edit"></i></span>
			<textarea class="form-control" name="message" placeholder="Escriba su mensaje ..." minlength="8" maxlength="512" required="required"></textarea>
		</div>
	</div>

	<div class="form-group response"></div>
	<div class="form-group col-xs-12">
		<button type="submit" class="btn btn-default"> <i class="fa fa-envelope"></i> <span>Enviar mensaje</span></button>
	</div>
</form>