<div class="panel panel-default">
	<div class="panel-heading navheading"> 
		<ul class="nav nav-tabs nav-login">
			<li role="presentation" class="active">
				<a href="#" data-target="#panel_profile-login" role="tab" data-toggle="tab" aria-controls="panel_profile-login" aria-expanded="true"> <i class="fa fa-sign-in"></i> Iniciar sesión</a>
			</li>
			<li role="presentation" class="">
				<a href="#" data-target="#panel_profile-signup" role="tab" data-toggle="tab" aria-controls="panel_profile-signup" aria-expanded="false"> <i class="fa fa-user-plus"></i> Registrarse</a>
			</li>
		</ul>
	</div>
	<div class="panel-body"> 
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="panel_profile-login">
				<div class="col-sm-5">
					<div class="media-body text-center">
          				<i class="fa fa-sign-in fa-4x"></i>
          				<b class="media-heading">INICIAR SESION</b>
          				<p>Inicia sesion para acceder a tu perfil !</p>
        			</div>
        			<div class="form-group">
        				<label>Conectarse con :</label> 
        				<a class="btn btn-social-icon btn-facebook" href="http://ums.hostingmex.com.mx/ums/?login=facebook&amp;callback=%23ums:panel_profile:tab:panel_profile-login"> <i class="fa fa-facebook"></i></a> 
        				<a class="btn btn-social-icon btn-twitter" href="http://ums.hostingmex.com.mx/ums/?login=twitter&amp;callback=%23ums:panel_profile:tab:panel_profile-login"> <i class="fa fa-twitter"></i></a>
        			</div>
        		</div>
        		<form class="form col-sm-7 xxs-nopadding" role="form" action="http://ums.hostingmex.com.mx/ums/" method="POST">
        			<input type="hidden" name="formid" value="login">
        			<input type="hidden" name="formtype" value="login">
        			<input type="hidden" name="callback" value="%23ums:panel_profile:tab:panel_profile-login">
        			<div class="result form-group col-xs-12"></div>
        			<div class="form-group col-xs-12">
        				<div class="input-group">
        					<span class="input-group-addon"><i class="fa fa-at"></i></span>
        					<input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="">
        				</div>
        			</div>
        			<div class="form-group col-xs-12">
        				<div class="input-group">
        					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
        					<input type="password" class="form-control" name="userpass" placeholder="Su contraseña ..." minlength="4" maxlength="32" required="">
        				</div>
        			</div>
        			<div class="form-group">
        				<div class="input-group">
        					<label>
        						<input type="checkbox" name="autologin" checked=""><b> Recordarme !</b>
        					</label>
        				</div>
        			</div>
        			<div class="form-group col-xs-12">
        				<button type="submit" class="btn btn-default"> <i class="fa fa-sign-in"></i> Iniciar sesion</button>
        			</div>
        		</form>
        	</div>

        	<div role="tabpanel" class="tab-pane fade" id="panel_profile-signup">
        		<div class="col-sm-5">
        			<div class="media-body text-center">
          				<i class="fa fa-user-plus fa-4x"></i>
          				<b class="media-heading">REGISTRARSE</b>
          				<p>Crea una cuenta <b>GRATIS</b> !</p>
      				</div>
      				<div class="form-group"> 
      					<a class="btn btn-block btn-social btn-facebook" href="http://ums.hostingmex.com.mx/ums/?login=facebook&amp;callback=%23ums:panel_profile:tab:panel_profile-signup"> <i class="fa fa-facebook"></i> Registrarse con Facebook</a> 
      					<a class="btn btn-block btn-social btn-twitter" href="http://ums.hostingmex.com.mx/ums/?login=twitter&amp;callback=%23ums:panel_profile:tab:panel_profile-signup"> <i class="fa fa-twitter"></i> Registrarse con Twitter</a>
      				</div>
      			</div>
      			<form class="form col-sm-7 xxs-nopadding" role="form" action="http://ums.hostingmex.com.mx/ums/?signup" method="POST">
      				<input type="hidden" name="formid" value="signup">
      				<input type="hidden" name="formtype" value="signup">
      				<input type="hidden" name="callback" value="%23ums:panel_profile:tab:panel_profile-signup">
      				<div class="result form-group col-xs-12"></div>
      				<div class="form-group col-xs-12">
      					<div class="input-group">
      						<span class="input-group-addon"><i class="fa fa-user"></i></span>
      						<input type="text" class="form-control" name="username" placeholder="Su Nombre ..." minlength="4" maxlength="64" required="">
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
      					<div class="input-group">
      						<label>
      							<input type="checkbox" name="autopass"><b> Contraseña automatica !</b>
      						</label>
      					</div>
      				</div>
      				<div class="form-group col-xs-12">
      					<button type="submit" class="btn btn-default"> <i class="fa fa-user-plus"></i> Crear cuenta</button>
      				</div>
      			</form>
      		</div>
      	</div>
      </div>
  </div>