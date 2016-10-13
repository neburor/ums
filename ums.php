<?php
include 'mysql_db.php';
MysqlConnect();
include 'config.php';
include 'global/function_device.php';
include 'sessions.php';



if($_POST || $_GET)
{
  include 'requests.php';
}