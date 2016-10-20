<?php
//Sessions
if(isset($_SESSION['logged']))
{
	if(isset($_SESSION['debugger']))
	{
		$_SESSION['debugger'][]='SESSION:logged => include functions_logged.php';
	}
	include 'functions_logged.php';
}
if(!isset($_SESSION['device']))
{
	if(isset($_COOKIE['device']))
	{
		if(isset($_SESSION['debugger']))
		{
			$_SESSION['debugger'][]='COOKIE:device => SearchDevice()';
		}
		SearchDevice();
	}
	else
	{
		if(isset($_SESSION['debugger']))
		{
			$_SESSION['debugger'][]='!COOKIE:device => NewDevice()';
		}
		NewDevice();
	}
}
else
{
	if(isset($_SESSION['debugger']))
		{
			$_SESSION['debugger'][]='SESSION:device:';
		}
}
