<?php
//Locked
if(isset($_SESSION['logged']))
{
	$locked['class']='';
	$locked['modal']='';
	$locked['data-target']='';
}
else
{
	$form=array(
      'id'    =>'modal_lock',
      'type'  =>'signup',
      'groupclass'=>'col-xs-12 col-sm-6',
      'callback'=>array('error'=>'/ums/modal/'.$locked['id'],'success'=>'pdf')
        );

	$locked['class']=' locked';
	$locked['data-target']=' data-target="#'.$locked['id'].'"';
	$locked['modal']='<div class="modal fade ums lock" id="'.$locked['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-lock"></i> Enlace bloqueado</h4>
      </div>
      <div class="modal-body"><div class="row">';

$locked['modal'].='	
	<form class="form" role="form" action="'.$form['action'].'#'.$form['callback']['error'].'" method="POST">
        <input type="hidden" name="formid" value="'.$form['id'].'">
        <input type="hidden" name="formtype" value="'.$form['type'].'">
    	<input type="hidden" name="callback" value="'.$form['callback']['success'].'">
    	<input type="hidden" name="autopass" value="on">
    	<input type="hidden" name="autopic" value="on">
    	<input type="hidden" name="autologin" value="on">
      	<div class="form-group col-xs-12">
      		<p><i class="fa fa-info-circle"></i> Complete los siguientes campos o <b><i class="fa fa-sign-in"></i> Inicie sesion</b> / <b><i class="fa fa-user-plus"></i> Registrese</b>.</p>
      		<label>Conectarse con :</label> 
      			<a class="btn btn-social-icon btn-facebook" href="?login=facebook';
            if($form['callback'])
            {
              $locked['modal'].= '&callback='.$form['callback']['success'].'&error='.$form['callback']['error'];
            }
            $locked['modal'].= '" rel="nofollow"> <i class="fa fa-facebook"></i></a> 
            <a class="btn btn-social-icon btn-google" href="?login=google';
            if($form['callback'])
            {
              $locked['modal'].= '&callback='.$form['callback']['success'].'&error='.$form['callback']['error'];
            }
            
            $locked['modal'].= '" rel="nofollow"> <i class="fa fa-google"></i></a>
      			<a class="btn btn-social-icon btn-twitter" href="?login=twitter';
            if($form['callback'])
            {
              $locked['modal'].= '&callback='.$form['callback']['success'].'&error='.$form['callback']['error'];
            }
            
            $locked['modal'].='" rel="nofollow"> <i class="fa fa-twitter"></i></a>
      	</div>
      	<div class="form-group '.$form['groupclass'].FeedbackClass($_SESSION['feedback'][$form['id']]['name']).'">
      		<div class="input-group">
      			<span class="input-group-addon"><i class="fa fa-user"></i></span>
      			<input type="text" class="form-control" name="name" placeholder="Tu nombre ..." required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['name']).'>
            '.FeedbackIcon($_SESSION['feedback'][$form['id']]['name']).'
      		</div>
      	</div>
      	<div class="form-group '.$form['groupclass'].FeedbackClass($_SESSION['feedback'][$form['id']]['email']).'">
      		<div class="input-group">
      			<span class="input-group-addon"><i class="fa fa-at"></i></span>
      			<input type="email" class="form-control" name="useremail" placeholder="Tu correo ..." required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['useremail']).'>
            '.FeedbackIcon($_SESSION['feedback'][$form['id']]['useremail']).'
      		</div>
          <div class="hidden"><input type="email" name="repeatmail" placeholder="Confirmar correo"></div>
      	</div>
      	<div class="form-group col-xs-12">
      		<label><input type="checkbox" name="funnel" value="signon" checked=""> Crearme una cuenta <b>GRATIS!</b>.</label> Recibira un correo para confirmar.
      	</div>
        <div class="form-group col-xs-12 response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
      	<div class="form-group col-xs-12">
      		<button type="submit" class="btn btn-default"><i class="fa fa-user-plus"></i> Crear cuenta</button>
      	</div>
    </form>
';
      $locked['modal'].='</div></div>
    </div>
  </div>
</div>';

unset($_SESSION['feedback'][$form['id']]);
}
