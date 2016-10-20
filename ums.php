<?php
include 'mysql_db.php';
include 'config.php';
include 'global/function_device.php';
include 'sessions.php';

include 'messages/functions_db.php';


if($_POST || $_GET)
{
  include 'requests.php';
}