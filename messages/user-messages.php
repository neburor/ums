<div class="col-sm-push-1 col-sm-10 col-xs-12 xxs-nopadding">
<?php
include 'functions.php';
$mensajes=MESSAGES($_SESSION['profile']['id']);
if($mensajes)
{
  echo $mensajes;
}
else
{
  echo HTML('div_intro_newmessage');
  echo HTML('form_user_newmessage');
}

?>
</div>