<?php
#Contact
if(isset($_GET['tab']))
{
  $tab['tab']=$_GET['tab'];
}
else
{
  $tab['tab']='tab_contact-contact';
}
echo '<div ums class="ums messages col-xs-12 nopadding"';
  if($tab['id'])
  { echo ' id="'.$tab['id'].'"';}
echo '>
        <div class="panel panel-default">
          <div class="panel-heading navheading">
            <i class="fa fa-envelope fa-3x"></i> <b>Contactanos</b>
            <ul class="nav nav-tabs nav-login">
              <li role="presentation" ';
              if($tab['tab']=='tab_contact-contact')
              {
                echo 'class="active"';
              }
              echo '><a href="" data-target="#tab_contact-contact" data-hash="/ums/tab/tab_contact-contact" role="tab" data-toggle="tab" aria-controls="tab_contact-contact" aria-expanded="true"> <i class="fa fa-edit"></i> Mensaje</a></li>
';
if(isset($_SESSION['logged']))
{
  echo '
              <li role="presentation" class="pull-right"><a href="?logout"> <i class="fa fa-power-off"></i> <span class="hidden-xxs">Cerrar sesion</span></a></li>
            </ul>
          </div>
      ';
$form=array(
      'id'    =>'tab_contact-contact'
        );
include 'list_messages.php';
}
else
{
  echo '
              <li role="presentation" ';
              if($tab['tab']=='tab_contact-login')
              {
                echo 'class="active"';
              }
              echo '><a href="" data-target="#tab_contact-login" data-hash="/ums/tab/tab_contact-login" role="tab" data-toggle="tab" aria-controls="tab_contact-login" aria-expanded="false"> <i class="fa fa-sign-in"></i> <span class="hidden-xxs">Iniciar sesion</span></a></li>
              <li role="presentation" ';
              if($tab['tab']=='tab_contact-signup')
              {
                echo 'class="active"';
              }
              echo '><a href="" data-target="#tab_contact-signup" data-hash="/ums/tab/tab_contact-signup" role="tab" data-toggle="tab" aria-controls="tab_contact-signup" aria-expanded="false"> <i class="fa fa-user-plus"></i> <span class="hidden-xxs">Registrarse</span></a></li>
              <li role="presentation" class="pull-right"><a href="?tab=tab_contact-recovery#tab_contact-recovery" data-target="#tab_contact-recovery" data-hash="/ums/tab/tab_contact-recovery" role="tab" data-toggle="tab" aria-controls="tab_contact-recovery" aria-expanded="false"></a></li>
            </ul>
          </div>
          <div class="panel-body">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane';
              if($tab['tab']=='tab_contact-contact')
              {
                echo ' fade active in';
              }
              echo '" id="tab_contact-contact">
  ';
$form=array(
      'id'    =>'tab_contact',
      'type'  =>'contact',
      'action'=>'?tab=tab_contact-contact',
      'groupclass'=>'col-xs-6 col-xxs-12',
      'callback'=>'/ums/tab/tab_contact-contact'
        );
include 'form_contact.php';
echo '
              </div>
              <div role="tabpanel" class="tab-pane';
              if($tab['tab']=='tab_contact-login')
              {
                echo ' fade active in';
              }
              echo '" id="tab_contact-login">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_contact-login',
      'type'  =>'login',
      'action'=>'?tab=tab_contact-login',
      'callback'=>array('error'=>'/ums/tab/tab_contact-login','success'=>'/ums/tab/tab_contact-contact'),
      'recovery'=>'<a  href="?tab=tab_contact-recovery#tab_contact-recovery" data-target="#tab_contact-recovery" data-hash="/ums/tab/tab_contact-recovery" class="pull-right">Recuperar <i class="fa fa-lock"></i></a>'
        );
include 'ums/login/html_login-tab.php';

echo '        </div>';
echo '        <div role="tabpanel" class="tab-pane';
              if($tab['tab']=='tab_contact-signup')
              {
                echo ' fade active in';
              }
              echo '" id="tab_contact-signup">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_contact-signup',
      'type'  =>'signup',
      'action'=>'?tab=tab_contact-signup',
      'callback'=>array('error'=>'/ums/tab/tab_contact-signup','success'=>'/ums/tab/tab_contact-contact')
        );
include 'ums/login/html_signup-tab.php';

echo '        </div>';
echo '        <div role="tabpanel" class="tab-pane';
              if($tab['tab']=='tab_contact-recovery')
              {
                echo ' fade active in';
              }
              echo '" id="tab_contact-recovery">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_contact-recovery',
      'type'  =>'recovery',
      'action'=>'?tab=tab_contact-recovery',
      'callback'=>array('error'=>'/ums/tab/tab_contact-recovery','success'=>'/ums/tab/tab_contact-recovery')
        );
include 'ums/login/html_recovery-tab.php';

echo '        </div>
            </div>
          </div>';
}

echo '  </div>
      </div>
';