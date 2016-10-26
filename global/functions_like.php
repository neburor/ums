<?php
#Likes

if(isset($_GET['like']))
{
	$resultado=SQLinsert(
            array(
                'table'=>'likes'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'],
                'account'=> $_SESSION['logged']['id'], 
                'asset'=> $_GET['likes'], 
                'asset_id'=> $_GET['like'],
                'like'=> '1'
                )
            );
}
elseif(isset($_GET['dislike']))
{
	if(isset($_SESSION['logged']))
	{
		$data=array(
				'domain'=> UMSDOMAIN,
                'account'=> $_SESSION['logged']['id'], 
                'asset'=> $_GET['likes'], 
                'asset_id'=> $_GET['dislike'],
                'like'=> '1'
			);
	}
	else
	{
		$data=array(
				'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'], 
                'asset'=> $_GET['likes'], 
                'asset_id'=> $_GET['dislike'],
                'like'=> '1'
			);
	}
	$resultado=SQLupdate(
            array(
                'table'=>'likes'
                ),
            $data,
            array(
            	'like'=> NULL
            	)
            );
}
    
if($resultado)
{
	header('Location: ' . $_SERVER['HTTP_REFERER'].'#'.$_GET['callback']);         
}
