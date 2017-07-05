<?php
//Sessions
if(isset($_SESSION['logged']))
{
	if(isset($_SESSION['debugger']))
	{
		$_SESSION['debugger'][]='SESSION:logged';
	}
	$notifapp=SQLselect(
            array(
                'table'=>'notifications_app',
                'limit'=>'LIMIT 1',
                'query'=>"SELECT count(*) FROM `notifications_app` where `to_id`='".$_SESSION['logged']['id']."' and `status`='0'"
                )
            );
	$_SESSION['logged']['notifs_app']=$notifapp['count(*)'];
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
		$_SESSION['logged']['login']='token';
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
