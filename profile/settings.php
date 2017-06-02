<?php
//Settings
$form=array(
      'id'    =>'form_settings_name',
      'type'  =>'settings',
      'action'=>'',
      'callback'=>'/app/settings/config'
        );

echo '<div class="col-xs-12">
		';
if($_SESSION['logged']['notifs']['email']['status']=='0')
{
	echo '<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-warning"></i> Advertencia ! </b> Su cuenta de correo no esta confirmada. <a href="?sendconfirm&callback=/app/settings/config" class="btn btn-warning">Enviar correo</a></div>';
}
echo '	<h3 class="text-center">Mis preferencias</h3>
		<form class="form" role="form" action="'.$form['action'].'#'.$form['callback'].'" method="POST">
					<input type="hidden" name="formid" value="'.$form['id'].'">
					<input type="hidden" name="formtype" value="'.$form['type'].'">
						<div class="form-group '.FeedbackClass($_SESSION['feedback'][$form['id']]['name']).'">'.FeedbackIcon($_SESSION['feedback'][$form['id']]['name']).'
							<label for="name">Cambiar nombre de perfil:</label>
							<div class="input-group"><span class="input-group-addon"> <i class="fa fa-user"></i></span><input type="text" class="form-control" name="name" placeholder="Nombre para mostrar" value="'.$_SESSION['logged']['name'].'" minlength="4" maxlength="64" required="">
								<span class="input-group-btn">
        							<button type="submit" class="btn btn-default"> <i class="fa fa-save"></i></button>
      							</span>
							</div>
							<div class="form-group response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
						</div>
						
					</form>
		</div>	
	';
unset($_SESSION['feedback'][$form['id']]);

if($_SESSION['logged']['login']!='email')
{
	$form=array(
      'id'    =>'form_settings_notif',
      'type'  =>'settings',
      'action'=>'',
      'callback'=>'/app/settings/config'
        );

echo '<div class="col-xs-12">
				<hr/>
				<form class="form" role="form" action="'.$form['action'].'#'.$form['callback'].'" method="POST">
					<input type="hidden" name="formid" value="'.$form['id'].'">
					<input type="hidden" name="formtype" value="'.$form['type'].'">
						<div class="form-group '.FeedbackClass($_SESSION['feedback'][$form['id']]['notif']).'">'.FeedbackIcon($_SESSION['feedback'][$form['id']]['notif']).'
							<label for="notif">Recibir notificaciones por correo :</label>
							<div class="input-group"><span class="input-group-addon"> <i class="fa fa-at"></i></span><input type="email" class="form-control" name="notif" placeholder="Correo electronico" value="'.$_SESSION['logged']['notifs']['email']['notif'].'" minlength="4" maxlength="64" required="">
								<span class="input-group-btn">
        							<button type="submit" class="btn btn-default"> <i class="fa fa-save"></i></button>
      							</span>
							</div>
							<div class="form-group response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
						</div>
						
					</form>
		</div>	
	';
unset($_SESSION['feedback'][$form['id']]);
}
else
{
	$form=array(
      'id'    =>'form_settings_pic',
      'type'  =>'settings',
      'action'=>'',
      'callback'=>'/app/settings/config'
        );
echo '	<div class="col-xs-12">
			<hr/>
			<form class="form" role="form" action="'.$form['action'].'#'.$form['callback'].'" method="POST">
					<input type="hidden" name="formid" value="'.$form['id'].'">
					<input type="hidden" name="formtype" value="'.$form['type'].'">';		
			$avatars = array_diff(scandir("ums/theme/".THEMEDIR."/avatars/"), array('..', '.','administracion.png'));
		$rand=rand(2,count($avatars)-5);
		echo '<div class="form-group col-xs-12 avatars"><label>Cambiar imagen de perfil:</label><br/>';
		for ($i=0; $i < 5; $i++) 
		{ 
			echo '<label>
					<input type="radio" name="pic" value="'.$avatars[$rand+$i].'" ';
					if($i==0){echo 'checked';}
			echo '/>
    				<img src="'.URLTHEME.'avatars/'.$avatars[$rand+$i].'"/>
 				</label>';
		}
		echo '<label><a class="btn btn-link" role="button" data-toggle="collapse" href="#avatars_'.$form['id'].'" aria-expanded="false" aria-controls="avatars"><i class="fa fa-plus fa-3x"></i></a></label>';
		echo '<div class="collapse avatars" id="avatars_'.$form['id'].'" data-content="'.URLSYSTEM.'login/avatars.php">';
		echo '</div></div>
			<div class="form-group col-xs-12 response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
				<div class="form-group col-xs-12">
					<button type="submit" class="btn btn-default"> <i class="fa fa-save"></i> <span>Guardar cambios</span></button>
				</div>';		
	echo	'</form>
		</div>';
unset($_SESSION['feedback'][$form['id']]);
	$form=array(
      'id'    =>'form_settings_pass',
      'type'  =>'settings',
      'action'=>'',
      'callback'=>'/app/settings/config'
        );
	echo '<div class="col-xs-12">
			<hr/>
			<form class="form" role="form" action="'.$form['action'].'#'.$form['callback'].'" method="POST">
				<input type="hidden" name="formid" value="'.$form['id'].'">
				<input type="hidden" name="formtype" value="'.$form['type'].'">
				<div class="form-group col-xs-12 '.FeedbackClass($_SESSION['feedback'][$form['id']]['userpass']).'">'.FeedbackIcon($_SESSION['feedback'][$form['id']]['userpass']).'
					<label for="userpass">Cambiar contraseña:</label>
					<div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-lock"></i></span>
						<input type="password" class="form-control" name="userpass" placeholder="Su contraseña actual..." minlength="4" maxlength="32" required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['userpass']).'>
					</div>
				</div>
				<div class="form-group col-sm-6 col-xs-12 '.FeedbackClass($_SESSION['feedback'][$form['id']]['newpass']).'">'.FeedbackIcon($_SESSION['feedback'][$form['id']]['newpass']).'
					<div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-key"></i></span>
						<input type="password" class="form-control" name="newpass" placeholder="Contraseña nueva ..." minlength="4" maxlength="32" required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['newpass']).'>
					</div>
				</div>
				<div class="form-group col-sm-6 col-xs-12 '.FeedbackClass($_SESSION['feedback'][$form['id']]['repass']).'">'.FeedbackIcon($_SESSION['feedback'][$form['id']]['repass']).'
					<div class="input-group">
						<span class="input-group-addon"> <i class="fa fa-key"></i></span>
						<input type="password" class="form-control" name="repass" placeholder="Repetir contraseña nueva..." minlength="4" maxlength="32" required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['repass']).'>
					</div>
				</div>
				<div class="form-group col-xs-12 response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
				<div class="form-group col-xs-12">
					<button type="submit" class="btn btn-default"> <i class="fa fa-save"></i> <span>Guardar cambios</span></button>
				</div>
			</form>
		</div>';
unset($_SESSION['feedback'][$form['id']]);
}

$echo ='	<div class="col-xs-12">
			<hr/>
			<label>Mis inicios de sesion:</label>
			<ul class="list-group">
				<li class="list-group-item">
					<div class="media">
						<div class="media-left">
							<i class="fa fa-at fa-2x"></i>
						</div>
						<div class="media-body">
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="media">
						<div class="media-left">
							<i class="fa fa-facebook fa-2x"></i>
						</div>
						<div class="media-body">
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="media">
						<div class="media-left">
							<i class="fa fa-twitter fa-2x"></i>
						</div>
						<div class="media-body">
						</div>
					</div>
				</li>
			</ul>
		</div>';