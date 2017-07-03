<?php
#Email open tracking

$route = explode(":", $_GET['email']);
	if(	strlen($route[0])==18 && 
		preg_match('#^[a-zA-Z0-9]*$#',$route[0]) && 
		preg_match('#^[0-9]*$#',$route[1]))
	{
		$confirmToken=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1'
                ),
            array(
                'token_hash'=>$route[0]
                )
            );

		if($confirmToken && $confirmToken['token_hash']==$route[0])
		{
			
			$update=SQLupdate(
            		array(
                		'table'=>'emails',
                   		),
            		array(
                		'id'=>$route[1],
                        'account'=>$confirmToken['id'],
                		'open'=>'0000-00-00 00:00:00'
                		),
            		array(
                		'open'=>date("Y-m-d H:i:s")
                		)
            );
			
			if($route[2]=='confirm')
			{
				$update=SQLupdate(
            		array(
                		'table'=>'accounts_notif'
                		),
            		array(
                		'account'=>$confirmToken['id'],
                		'status'=>'0'
                		),
            		array(
                		'status'=>'2'
                		)
            	);

            	if(isset($_SESSION['logged']) && $_SESSION['logged']['id']==$confirmToken['id'])
            	{
            		$_SESSION['logged']['notifs']['email']['status']='2';
				}
			
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
			