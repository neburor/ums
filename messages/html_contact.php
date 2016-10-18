<?php
#Contact

echo '<div ums class="ums messages col-xs-12 nopadding">
        <div class="panel panel-default">
          <div class="panel-heading navheading">
            <i class="fa fa-envelope fa-3x"></i> <b>Contactanos</b>
            <ul class="nav nav-tabs nav-login">
              <li role="presentation" class="active"><a href="" data-target="#tab_message-message" role="tab" data-toggle="tab" aria-controls="tab_message-comment" aria-expanded="true"> <i class="fa fa-edit"></i> Mensaje</a></li>
';
if(isset($_SESSION['logged']))
{
  echo '
              <li role="presentation" class="pull-right"><a href="?logout"> <i class="fa fa-power-off"></i> <span class="hidden-xxs">Cerrar sesion</span></a></li>
            </ul>
          </div>
      ';

include 'list_messages.php';
}
else
{
  echo '
              <li role="presentation" class=""><a href="" data-target="#tab_message-login" role="tab" data-toggle="tab" aria-controls="tab_message-login" aria-expanded="false"> <i class="fa fa-sign-in"></i> <span class="hidden-xxs">Iniciar sesion</span></a></li>
              <li role="presentation" class=""><a href="" data-target="#tab_message-signup" role="tab" data-toggle="tab" aria-controls="tab_message-signup" aria-expanded="false"> <i class="fa fa-user-plus"></i> <span class="hidden-xxs">Registrarse</span></a></li>
            </ul>
          </div>
          <div class="panel-body">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_message-message">
  ';
$form=array(
      'id'    =>'form_contact',
      'type'  =>'contact'
        );
include 'form_contact.php';
echo '
              </div>
              <div role="tabpanel" class="tab-pane" id="tab_message-login">';

$formid=array('form_login'=>'form_contact-login');
include 'ums/login/html_login-tab.php';

echo '        </div>';
echo '        <div role="tabpanel" class="tab-pane" id="tab_message-signup">';

$formid=array('form_signup'=>'form_contact-signup');
include 'ums/login/html_signup-tab.php';

echo '        </div>
            </div>
          </div>';
}

echo '  </div>
      </div>
';