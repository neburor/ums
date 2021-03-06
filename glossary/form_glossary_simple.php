<?php
#FormContact
$feedback=array('show'=>'warning',
                'status'=>$_SESSION['feedback'][$form['id']]['status']);

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
              <div class="form-group col-xs-12 col-sm-6'.FeedbackClass($_SESSION['feedback'][$form['id']]['term'],$feedback).'">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-edit"></i></span>
            <input type="text" class="form-control" name="term" placeholder="Termino ..." required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['term'],$feedback).'>
            '.FeedbackIcon($_SESSION['feedback'][$form['id']]['term'],$feedback).'
          </div>
        </div>
              <div class="form-group col-xs-12 col-sm-6'.FeedbackClass($_SESSION['feedback'][$form['id']]['description'],$feedback).'">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                <textarea class="form-control" name="description" placeholder="Descripción corta ..." minlength="8" maxlength="512" required="">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['description'],$feedback).'</textarea>
                '.FeedbackIcon($_SESSION['feedback'][$form['id']]['description'],$feedback).'
                </div>
              </div>
              <div class="form-group response col-xs-12">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
              <div class="form-group col-xs-12">
                <button type="submit" class="btn btn-default"><i class="fa fa-share"></i> Enviar término</button>
              </div>
            </form>
        </div>
    </div>
';
}
else
{
echo '	
	<form class="form" role="form" action="'.$form['action'].'#'.$form['callback'].'" method="POST">
        <input type="hidden" name="formid" value="'.$form['id'].'">
        <input type="hidden" name="formtype" value="'.$form['type'].'">
      	<div class="form-group col-xs-12">
      		<p><i class="fa fa-info-circle"></i> Complete los siguientes campos o <b><i class="fa fa-sign-in"></i> Inicie sesion</b> / <b><i class="fa fa-user-plus"></i> Registrese</b>.</p>
      		<label>Conectarse con :</label> 
      			<a class="btn btn-social-icon btn-facebook" href="?login=facebook';
            if($form['callback'])
            {
              echo '&callback='.$form['callback'];
            }
            if($form['btn'])
            {
              echo '&btn='.$form['btn'];
            }
            echo '" rel="nofollow"> <i class="fa fa-facebook"></i></a> 
            <a class="btn btn-social-icon btn-google" href="?login=google';
            if($form['callback'])
            {
              echo '&callback='.$form['callback'];
            }
            if($form['btn'])
            {
              echo '&btn='.$form['btn'];
            }
            echo '" rel="nofollow"> <i class="fa fa-google"></i></a>
      			<a class="btn btn-social-icon btn-twitter" href="?login=twitter';
            if($form['callback'])
            {
              echo '&callback='.$form['callback'];
            }
            if($form['btn'])
            {
              echo '&btn='.$form['btn'];
            }
            echo '" rel="nofollow"> <i class="fa fa-twitter"></i></a>
      	</div>
      	<div class="form-group col-xs-12 col-sm-6'.FeedbackClass($_SESSION['feedback'][$form['id']]['name']).'">
      		<div class="input-group">
      			<span class="input-group-addon"><i class="fa fa-user"></i></span>
      			<input type="text" class="form-control" name="name" placeholder="Tu nombre ..." required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['name']).'>
            '.FeedbackIcon($_SESSION['feedback'][$form['id']]['name']).'
      		</div>
      	</div>
      	<div class="form-group col-xs-12 col-sm-6'.FeedbackClass($_SESSION['feedback'][$form['id']]['email']).'">
      		<div class="input-group">
      			<span class="input-group-addon"><i class="fa fa-at"></i></span>
      			<input type="email" class="form-control" name="email" placeholder="Tu correo ..." required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['email']).'>
            '.FeedbackIcon($_SESSION['feedback'][$form['id']]['email']).'
      		</div>
          <div class="hidden"><input type="email" name="repeatmail" placeholder="Confirmar correo"></div>
      	</div>
      	<div class="form-group col-xs-12">
      		<label><input type="checkbox" name="funnel" value="signon" checked=""> Crearme una cuenta <b>GRATIS!</b>.</label> Recibira un correo para confirmar.
      	</div>
      	<div class="form-group '.$form['groupclass'].FeedbackClass($_SESSION['feedback'][$form['id']]['term']).'">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-edit"></i></span>
            <input type="text" class="form-control" name="term" placeholder="Termino ..." required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['term']).'>
            '.FeedbackIcon($_SESSION['feedback'][$form['id']]['term']).'
          </div>
        </div>
        <div class="form-group '.$form['groupclass'].FeedbackClass($_SESSION['feedback'][$form['id']]['description']).'">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-edit"></i></span>
            <textarea class="form-control" name="description" placeholder="Descripción corta ..." required="">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['description']).'</textarea>
            '.FeedbackIcon($_SESSION['feedback'][$form['id']]['description']).'
          </div>
        </div>
        <div class="form-group col-xs-12 response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
      	<div class="form-group col-xs-12">
      		<button type="submit" class="btn btn-default"><i class="fa fa-share"></i> Enviar término</button>
      	</div>
    </form>
';
}
unset($_SESSION['feedback'][$form['id']]);