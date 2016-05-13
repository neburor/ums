<?php
#Email Confirmation


if(isset($_GET['token'])) // Si se reciben datos por get
{
	if(strlen($_GET['token'])==12 && preg_match('#^[a-zA-Z0-9]*$#',$_GET['token']))
	{
		include '../global/config.php';
		include 'dbhandler.php';

		$profile=profile_search('token',array(	'token' => $_GET['token'],
												'domain'=> $_GET['domain']
												));

		if($profile && $profile['token_hash']==$_GET['token'])
		{
			$update=profile_update(array('email_valid'=>1),$profile['id']);
			if($update)
			{
				$_SESSION['profile'] = $profile;
				header("Location: ".URLSYSTEM);
			}
			else 
			{
				header("Location: ".URLSYSTEM);
			}

		}
		else
		{
			header("Location: ".URLSYSTEM);
		}

	}
			
}
else
{
	header("Location: ".URLSYSTEM);
}