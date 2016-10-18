<?php
#Contact
echo '<div ums class="ums comments col-xs-12 nopadding">
        <div class="panel panel-default">
          <div class="panel-heading navheading">
            <i class="fa fa-commenting fa-3x"></i> <b>Comentarios</b>
';
if(isset($_SESSION['logged']))
{
  echo '
            <ul class="nav nav-tabs nav-login">
              <li role="presentation" class="active"><a href="" data-target="#tab_comment-comment" role="tab" data-toggle="tab" aria-controls="tab_comment-comment" aria-expanded="true"> <i class="fa fa-edit"></i> Comentario</a></li>
              <li role="presentation" class="pull-right"><a href="?logout"> <i class="fa fa-power-off"></i> <span class="hidden-xxs">Cerrar sesion</span></a></li>
            </ul>
      ';
}
else
{
  echo '
            <ul class="nav nav-tabs nav-login">
              <li role="presentation" class="active"><a href="" data-target="#tab_comment-comment" role="tab" data-toggle="tab" aria-controls="tab_commentcomment" aria-expanded="true"> <i class="fa fa-edit"></i> Comentario</a></li>
              <li role="presentation" class=""><a href="" data-target="#tab_comment-login" role="tab" data-toggle="tab" aria-controls="tab_comment-login" aria-expanded="false"> <i class="fa fa-sign-in"></i> <span class="hidden-xxs">Iniciar sesion</span></a></li>
              <li role="presentation" class=""><a href="" data-target="#tab_comment-signup" role="tab" data-toggle="tab" aria-controls="tab_comment-signup" aria-expanded="false"> <i class="fa fa-user-plus"></i> <span class="hidden-xxs">Registrarse</span></a></li>
            </ul>
  ';
}
echo '    </div>
          <div class="panel-body">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_comment-comment">
';
$formid=array('form_comment'=>'form_comment');
include 'form_comment.php';
echo '
              </div>
';
if(!isset($_SESSION['logged']))
{
  echo '<div role="tabpanel" class="tab-pane" id="tab_comment-login">';
$formid=array('form_login'=>'form_comment-login');
include 'ums/login/html_login-tab.php';
  echo '</div>';
  echo '<div role="tabpanel" class="tab-pane" id="tab_comment-signup">';
$formid=array('form_signup'=>'form_comment-signup');
include 'ums/login/html_signup-tab.php';
  echo '</div>';
}
echo '
            </div>
          </div>
        </div>
      </div>
';