<?php
//Sessions
if(isset($_SESSION['logged']))
{
	if(isset($_SESSION['debugger']))
	{
		$_SESSION['debugger'][]='SESSION:logged';
	}
}
elseif(isset($_COOKIE['token']))
{
	if(isset($_SESSION['debugger']))
	{
		$_SESSION['debugger'][]='SESSION:token => SearchAccount()';
	}
	include 'ums/accounts/function_TokenAccount.php';
	$account=TokenAccount($_COOKIE['token']);

	if($account)
	{
		if(isset($_SESSION['debugger']))
		{
			$_SESSION['debugger'][]='SESSION:token:connect';
		}
		$_SESSION['logged']=$account;
	}
	else
	{
		if(isset($_SESSION['debugger']))
		{
			$_SESSION['debugger'][]='SESSION:token:null';
		}
	}
	
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
