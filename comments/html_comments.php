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

echo '<div ums class="ums comments col-xs-12 nopadding"';
  if($params_comments['id']!='')
  {
    echo ' id="'.$params_comments['id'].'"';
  }
echo '>
        <div class="panel panel-default">
          <div class="panel-heading navheading">
            <i class="fa fa-commenting fa-2x"></i> <b>Comentarios</b>
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
              <li role="presentation" class="pull-right"><a href="?tab=tab_comment-recovery#tab_comment-recovery" data-target="#tab_comment-recovery" data-hash="/ums/tab/tab_comment-recovery" role="tab" data-toggle="tab" aria-controls="tab_comment-recovery" aria-expanded="false"></a></li>
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
      'callback'=>'/ums/tab/tab_comment-comment'
        );
include 'form_comment.php';
echo $FormComment;
if($_SESSION['logged']['alert'])
{
  echo '<div class="alert alert-'.key($_SESSION['logged']['alert']).' alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> '.$_SESSION['logged']['alert'][key($_SESSION['logged']['alert'])].'</div>';
}
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
      'callback'=> array('error'=>'/ums/tab/tab_comment-login','success'=>'/ums/tab/tab_comment-comment'),
      'recovery'=>'<a  href="?tab=tab_comment-recovery#tab_comment-recovery" data-target="#tab_comment-recovery" data-hash="/ums/tab/tab_comment-recovery" class="pull-right">Recuperar <i class="fa fa-lock"></i></a>'
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
      'callback'=>array('error'=>'/ums/tab/tab_comment-signup','success'=>'/ums/tab/tab_comment-comment')
        );
include 'ums/login/html_signup-tab.php';
  echo '</div>';
  echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_comment-recovery')
              {
                echo ' fade active in';
              }
              echo '" id="tab_comment-recovery">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_comment-recovery',
      'type'  =>'recovery',
      'action'=>'?tab=tab_comment-recovery',
      'callback'=>array('error'=>'/ums/tab/tab_comment-recovery','success'=>'/ums/tab/tab_comment-recovery')
        );
include 'ums/login/html_recovery-tab.php';
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