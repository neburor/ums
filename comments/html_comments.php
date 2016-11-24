<?php
#Contact
if(isset($_GET['tab']))
{
  $tab=$_GET['tab'];
}
else
{
  $tab='tab_comment-comment';
}

echo '<div ums class="ums comments col-xs-12 nopadding">
        <div class="panel panel-default">
          <div class="panel-heading navheading">
            <i class="fa fa-commenting fa-3x"></i> <b>Comentarios</b>
            <ul class="nav nav-tabs nav-login">
              <li role="presentation" ';
              if($tab=='tab_comment-comment')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_comment-comment#tab_comment-comment" data-target="#tab_comment-comment" data-hash="/ums/tab/tab_comment-comment" role="tab" data-toggle="tab" aria-controls="tab_comment-comment" aria-expanded="true"> <i class="fa fa-edit"></i> Comentario</a></li>
';
if(isset($_SESSION['logged']))
{
  echo '
            
              <li role="presentation" class="pull-right"><a href="?logout"> <i class="fa fa-power-off"></i> <span class="hidden-xxs">Cerrar sesion</span></a></li>
      ';
}
else
{
  echo '
              <li role="presentation" ';
              if($tab=='tab_comment-login')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_comment-login#tab_comment-login" data-target="#tab_comment-login" data-hash="/ums/tab/tab_comment-login" role="tab" data-toggle="tab" aria-controls="tab_comment-login" aria-expanded="false"> <i class="fa fa-sign-in"></i> <span class="hidden-xxs">Iniciar sesion</span></a></li>
              <li role="presentation" ';
              if($tab=='tab_comment-signup')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_comment-signup#tab_comment-signup" data-target="#tab_comment-signup" data-hash="/ums/tab/tab_comment-signup" role="tab" data-toggle="tab" aria-controls="tab_comment-signup" aria-expanded="false"> <i class="fa fa-user-plus"></i> <span class="hidden-xxs">Registrarse</span></a></li>
  ';
}
echo '     </ul>
          </div>
          <div class="panel-body">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane';
              if($tab=='tab_comment-comment')
              {
                echo ' fade active in';
              }
              echo '" id="tab_comment-comment">
';
$form=array(
      'id'    =>'tab_comment',
      'type'  =>'comment',
      'action'=>'?tab=tab_comment-comment',
      'callback'=>'tab_comment-comment'
        );
include 'form_comment.php';
echo $FormComment;
echo '
              </div>
';
if(!isset($_SESSION['logged']))
{
  echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_comment-login')
              {
                echo ' fade active in';
              }
              echo '" id="tab_comment-login">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_comment-login',
      'type'  =>'login',
      'action'=>'?tab=tab_comment-login',
      'callback'=> array('error'=>'tab_comment-login','success'=>'tab_comment-comment')
        );
include 'ums/login/html_login-tab.php';
  echo '</div>';
  echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_comment-signup')
              {
                echo ' fade active in';
              }
              echo '" id="tab_comment-signup">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_comment-signup',
      'type'  =>'signup',
      'action'=>'?tab=tab_comment-signup',
      'callback'=>array('error'=>'tab_comment-signup','success'=>'tab_comment-comment')
        );
include 'ums/login/html_signup-tab.php';
  echo '</div>';
}
echo '
            </div>
          </div>
';
include 'list_comments.php';
echo '</div>
      </div>
';