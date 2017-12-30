<?php
#ecommerce Contact

if(isset($_GET['tab']))
{
  $tab=$_GET['tab'];
}
else
{
  $tab='tab_ecommerce-contact';
}

echo '<div ums class="ums ecommerce col-xs-12 nopadding"';
  if($ecommerce['contact']['id']!='')
  {
    echo ' id="'.$ecommerce['contact']['id'].'"';
  }
echo '>
        <div class="panel panel-default">
          <div class="panel-heading navheading">
            <i class="fa fa-envelope fa-2x"></i> <b>Contactar</b>
            <ul class="nav nav-tabs nav-login">
              <li role="presentation" ';
              if($tab=='tab_ecommerce-contact')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_ecommerce-contact#tab_ecommerce-contact" data-target="#tab_ecommerce-contact" data-hash="/ums/tab/tab_ecommerce-contact" role="tab" data-toggle="tab" aria-controls="tab_ecommerce-contact" aria-expanded="false"> <i class="fa fa-edit"></i> <span class="hidden-xxs">Contactar</span></a></li>
              <li role="presentation" ';
if(isset($_SESSION['logged']))
{
  echo '
              <li role="presentation" class="pull-right"><a href="?logout"> <i class="fa fa-power-off"></i> <span class="hidden-xxs">Cerrar sesion</span></a></li>
            </ul>
          </div>
      ';
      if($post['account']!=$_SESSION['logged']['id'])
      {
        $form=array(
        'id'    =>'tab_ecommerce-contact'
        );
        include 'list_messages.php';
      }
      else{
        include 'list_contacts.php';
      }

}
else
{
              if($tab=='tab_ecommerce-login')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_ecommerce-login#tab_ecommerce-login" data-target="#tab_ecommerce-login" data-hash="/ums/tab/tab_ecommerce-login" role="tab" data-toggle="tab" aria-controls="tab_ecommerce-login" aria-expanded="false"> <i class="fa fa-sign-in"></i> <span class="hidden-xxs">Iniciar sesion</span></a></li>
              <li role="presentation" ';
              if($tab=='tab_ecommerce-signup')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_ecommerce-signup#tab_ecommerce-signup" data-target="#tab_ecommerce-signup" data-hash="/ums/tab/tab_ecommerce-signup" role="tab" data-toggle="tab" aria-controls="tab_ecommerce-signup" aria-expanded="false"> <i class="fa fa-user-plus"></i> <span class="hidden-xxs">Registrarse</span></a></li>
              <li role="presentation" class="pull-right"><a href="?tab=tab_ecommerce-recovery#tab_ecommerce-recovery" data-target="#tab_ecommerce-recovery" data-hash="/ums/tab/tab_ecommerce-recovery" role="tab" data-toggle="tab" aria-controls="tab_ecommerce-recovery" aria-expanded="false"></a></li>
  ';

  echo '</ul>
          </div>
          <div class="panel-body">
            <div class="tab-content">';
    echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_ecommerce-contact')
              {
                echo ' fade active in';
              }
              echo '" id="tab_ecommerce-contact">
';
$form=array(
      'id'    =>'tab_ecommerce-contact',
      'type'  =>'ecommerce',
      'action'=>'?tab=tab_ecommerce-contact',
      'callback'=>'/ums/tab/tab_ecommerce-contact'
        );
include 'form_contact.php';

if($_SESSION['logged']['alert'])
{
  echo '<div class="alert alert-'.key($_SESSION['logged']['alert']).' alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> '.$_SESSION['logged']['alert'][key($_SESSION['logged']['alert'])].'</div>';
}
echo '
              </div>
';
  echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_ecommerce-login')
              {
                echo ' fade active in';
              }
              echo '" id="tab_ecommerce-login">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_ecommerce-login',
      'type'  =>'login',
      'action'=>'?tab=tab_ecommerce-login',
      'callback'=> array('error'=>'/ums/tab/tab_ecommerce-login','success'=>'/ums/tab/tab_ecommerce-contact'),
      'recovery'=>'<a  href="?tab=tab_ecommerce-recovery#tab_ecommerce-recovery" data-target="#tab_ecommerce-recovery" data-hash="/ums/tab/tab_ecommerce-recovery" class="pull-right">Recuperar <i class="fa fa-lock"></i></a>'
        );
include 'ums/login/html_login-tab.php';
  echo '</div>';
  echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_ecommerce-signup')
              {
                echo ' fade active in';
              }
              echo '" id="tab_ecommerce-signup">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_ecommerce-signup',
      'type'  =>'signup',
      'action'=>'?tab=tab_ecommerce-signup',
      'callback'=>array('error'=>'/ums/tab/tab_ecommerce-signup','success'=>'/ums/tab/tab_ecommerce-contact')
        );
include 'ums/login/html_signup-tab.php';
  echo '</div>';
  echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_ecommerce-recovery')
              {
                echo ' fade active in';
              }
              echo '" id="tab_ecommerce-recovery">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_ecommerce-recovery',
      'type'  =>'recovery',
      'action'=>'?tab=tab_ecommerce-recovery',
      'callback'=>array('error'=>'/ums/tab/tab_ecommerce-recovery','success'=>'/ums/tab/tab_ecommerce-recovery')
        );
include 'ums/login/html_recovery-tab.php';
  echo '      </div>
            </div>
          </div>';
}
     echo ' </div>
      </div>
';