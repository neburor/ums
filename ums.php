<?php
include 'mysql_db.php';
include 'config.php';
include 'global/function_device.php';
include 'global/functions.php';
include 'global/functions_form.php';
include 'sessions.php';

include 'messages/functions_db.php';
include 'comments/functions_db.php';

if(isset($_POST) || isset($_GET))
{ 
  include 'requests.php';
}