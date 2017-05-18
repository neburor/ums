<?php
#Login TAB
echo '
<div class="'.$div['intro'].'">
	<div class="media-body text-center">
        <i class="fa fa-user-plus fa-4x"></i>
        <b class="media-heading">REGISTRARSE</b>
        <p>Crea una cuenta <b>GRATIS</b> !</p>
    </div>
    <div class="form-group"> 
    	<a class="btn btn-block btn-social btn-facebook" href="?login=facebook';
            if($form['callback'])
            {
              echo '&callback='.$form['callback']['success'].'&error='.$form['callback']['error'];
            }
            echo '"> <i class="fa fa-facebook"></i> <span>Registrarse con Facebook</span></a> 
    	<a class="btn btn-block btn-social btn-twitter" href="?login=twitter';
            if($form['callback'])
            {
              echo '&callback='.$form['callback']['success'].'&error='.$form['callback']['error'];
            }
            echo '"> <i class="fa fa-twitter"></i> <span>Registrarse con Twitter</span></a>
	</div>
</div>
<form class="form '.$div['form'].' xxs-nopadding" role="form" action="'.$form['action'].'#'.$form['callback']['error'].'" method="POST">
    <input type="hidden" name="formid" value="'.$form['id'].'"/>
    <input type="hidden" name="formtype" value="'.$form['type'].'"/>
    <input type="hidden" name="autologin" value="on"/>
    <input type="hidden" name="callback" value="'.$form['callback']['success'].'">
	<div class="form-group col-xs-12 '.FeedbackClass($_SESSION['feedback'][$form['id']]['name']).'">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-user"></i></span>
			<input type="text" class="form-control" name="name" placeholder="Su nombre ..." minlength="4" maxlength="64" required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['name']).'>
		'.FeedbackIcon($_SESSION['feedback'][$form['id']]['name']).'
		</div>
	</div>
	<div class="form-group col-xs-12 '.FeedbackClass($_SESSION['feedback'][$form['id']]['useremail']).'">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-at"></i></span>
			<input type="email" class="form-control" name="useremail" placeholder="Su correo ..." minlength="8" maxlength="64" required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['useremail']).'>
		'.FeedbackIcon($_SESSION['feedback'][$form['id']]['useremail']).'
		</div>
	</div>
	<div class="form-group col-sm-6 col-xs-12 '.FeedbackClass($_SESSION['feedback'][$form['id']]['pass']).'">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-key"></i></span>
			<input type="password" class="form-control" name="pass" placeholder="Su contraseña ..." minlength="4" maxlength="32" '.FeedbackValue($_SESSION['feedback'][$form['id']]['pass']).'>
		'.FeedbackIcon($_SESSION['feedback'][$form['id']]['pass']).'
		</div>
	</div>
	<div class="form-group col-sm-6 col-xs-12 '.FeedbackClass($_SESSION['feedback'][$form['id']]['repass']).'">
		<div class="input-group">
			<span class="input-group-addon"> <i class="fa fa-key"></i></span>
			<input type="password" class="form-control" name="repass" placeholder="Repetir contraseña ..." minlength="4" maxlength="32" '.FeedbackValue($_SESSION['feedback'][$form['id']]['repass']).'>
		'.FeedbackIcon($_SESSION['feedback'][$form['id']]['repass']).'
		</div>
	</div>
	<div class="form-group col-xs-12">
		<label><input type="checkbox" name="autopass"><b> Contraseña automatica !</b></label>
	</div>
	';
    if(DIRAVATARS)
    {
    	$avatars = array_diff(scandir(path.DIRAVATARS), array('..', '.','administracion.png'));
		$rand=rand(2,count($avatars)-5);
		echo '<div class="form-group col-xs-12 avatars"><label>Imagen de perfil:</label><br/>';
		for ($i=0; $i < 5; $i++) 
		{ 
			echo '<label>
					<input type="radio" name="pic" value="'.$avatars[$rand+$i].'" ';
					if($i==0){echo 'checked';}
			echo '/>
    				<img src="'.URLTHEME.DIRAVATARS.'/'.$avatars[$rand+$i].'"/>
 				</label>';
		}
		echo '</div>';
    }
echo '
	<div class="form-group col-xs-12 response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
	<div class="form-group col-xs-12">
		<button type="submit" class="btn btn-default"> <i class="fa fa-user-plus"></i> <span>Crear cuenta</span></button>
	</div>
</form>
';
unset($_SESSION['feedback'][$form['id']]);