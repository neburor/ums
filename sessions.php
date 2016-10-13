<?php
//Sessions
if(isset($_SESSION['logged']))
{
	include 'functions_logged.php';
}
if(isset($_COOKIE['device']))
{
	SearchDevice();
}
else
{
	NewDevice();
}