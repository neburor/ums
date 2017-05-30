<?php
#Email Confirmation

include '../config.php';
if(isset($_GET['token'])) // Si se reciben datos por get
{
	if(strlen($_GET['token'])==18 && preg_match('#^[a-zA-Z0-9]*$#',$_GET['token']))
	{
		session_start();
		include '../mysql_db.php';
		include 'function_SearchAccount.php';

		$resultado=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1'
                ),
            array(
                'token_hash'=>$_GET['token']
                )
            );

		if($resultado && $resultado['token_hash']==$_GET['token'])
		{
			$update=SQLupdate(
            	array(
                	'table'=>'accounts_notif'
                	),
            	array(
                	'account'=>$resultado['id']
                	),
            	array(
                	'status'=>'1'
                	)
            	);

			if($update)
			{
				$_SESSION['feedback']['top']['alerts']['success']=" Tu correo ha sido confirmado correctamente.";
				header("Location: ".URLMESSAGES);
			}
			else 
			{
				header("Location: ".URLMESSAGES);
			}

		}
		else
		{
			header("Location: ".URLMESSAGES);
		}

	}
	else
	{
		header("Location: ".URLMESSAGES);
	}
			
}
else
{
	header("Location: ".URLMESSAGES);
}