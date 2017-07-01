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
			if(isset($_GET['confirm']))
			{
				$update=SQLupdate(
            		array(
                		'table'=>'accounts_notif'
                		),
            		array(
                		'account'=>$resultado['id']
                		),
            		array(
                		'status'=>'2'
                		)
            	);
            	
			}

			if (isset($_GET['email'])) 
			{
				$update=SQLupdate(
            		array(
                		'table'=>'emails',
                   		),
            		array(
                		'id'=>$_GET['email'],
                		'open'=>'0000-00-00 00:00:00'
                		),
            		array(
                		'open'=>date("Y-m-d H:i:s")
                		)
            	);
			}
			
			header("Location: ".URLTHEME."pixel.jpg");
		}
		else
		{
			header("Location: ".URLTHEME."pixel.jpg");
		}

	}
	else
	{
		header("Location: ".URLTHEME."pixel.jpg");
	}
			
}
else
{
	header("Location: ".URLTHEME."pixel.jpg");
}