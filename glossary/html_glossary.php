<?php
#Contact
if(isset($_GET['tab']))
{
  $tab=$_GET['tab'];
}
else
{
  $tab='tab_glossary-glossary';
}

echo '<div ums class="ums glossary col-xs-12 nopadding"';
  if($params_glossary['id']!='')
  {
    echo ' id="'.$params_glossary['id'].'"';
  }
echo '>
        <div class="panel panel-default">
          <div class="panel-heading navheading">
            <i class="fa fa-book fa-2x"></i> <b>Glosario</b>
            <ul class="nav nav-tabs nav-login">
              <li role="presentation" ';
              if($tab=='tab_glossary-glossary')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_glossary-glossary#tab_glossary-glossary" data-target="#tab_glossary-glossary" data-hash="/ums/tab/tab_glossary-glossary" role="tab" data-toggle="tab" aria-controls="tab_glossary-glossary" aria-expanded="true"> <i class="fa fa-edit"></i> Agregar</a></li>
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
              if($tab=='tab_glossary-login')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_glossary-login#tab_glossary-login" data-target="#tab_glossary-login" data-hash="/ums/tab/tab_glossary-login" role="tab" data-toggle="tab" aria-controls="tab_glossary-login" aria-expanded="false"> <i class="fa fa-sign-in"></i> <span class="hidden-xxs">Iniciar sesion</span></a></li>
              <li role="presentation" ';
              if($tab=='tab_glossary-signup')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_glossary-signup#tab_glossary-signup" data-target="#tab_glossary-signup" data-hash="/ums/tab/tab_glossary-signup" role="tab" data-toggle="tab" aria-controls="tab_glossary-signup" aria-expanded="false"> <i class="fa fa-user-plus"></i> <span class="hidden-xxs">Registrarse</span></a></li>
              <li role="presentation" class="pull-right"><a href="?tab=tab_glossary-recovery#tab_glossary-recovery" data-target="#tab_glossary-recovery" data-hash="/ums/tab/tab_glossary-recovery" role="tab" data-toggle="tab" aria-controls="tab_glossary-recovery" aria-expanded="false"></a></li>
  ';
}
echo '     </ul>
          </div>
          <div class="panel-body">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane';
              if($tab=='tab_glossary-glossary')
              {
                echo ' fade active in';
              }
              echo '" id="tab_glossary-glossary">
';
$form=array(
      'id'    =>'tab_glossary',
      'type'  =>'glossary',
      'action'=>'?tab=tab_glossary-glossary',
      'callback'=>'/ums/tab/tab_glossary-glossary'
        );
include 'form_glossary.php';

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
              if($tab=='tab_glossary-login')
              {
                echo ' fade active in';
              }
              echo '" id="tab_glossary-login">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_glossary-login',
      'type'  =>'login',
      'action'=>'?tab=tab_glossary-login',
      'callback'=> array('error'=>'/ums/tab/tab_glossary-login','success'=>'/ums/tab/tab_glossary-glossary'),
      'recovery'=>'<a  href="?tab=tab_glossary-recovery#tab_glossary-recovery" data-target="#tab_glossary-recovery" data-hash="/ums/tab/tab_glossary-recovery" class="pull-right">Recuperar <i class="fa fa-lock"></i></a>'
        );
include 'ums/login/html_login-tab.php';
  echo '</div>';
  echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_glossary-signup')
              {
                echo ' fade active in';
              }
              echo '" id="tab_glossary-signup">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_glossary-signup',
      'type'  =>'signup',
      'action'=>'?tab=tab_glossary-signup',
      'callback'=>array('error'=>'/ums/tab/tab_glossary-signup','success'=>'/ums/tab/tab_glossary-glossary')
        );
include 'ums/login/html_signup-tab.php';
  echo '</div>';
  echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_glossary-recovery')
              {
                echo ' fade active in';
              }
              echo '" id="tab_glossary-recovery">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_glossary-recovery',
      'type'  =>'recovery',
      'action'=>'?tab=tab_glossary-recovery',
      'callback'=>array('error'=>'/ums/tab/tab_glossary-recovery','success'=>'/ums/tab/tab_glossary-recovery')
        );
include 'ums/login/html_recovery-tab.php';
  echo '</div>';
}
echo '
            </div>
          </div>
        </div>
      </div>
';