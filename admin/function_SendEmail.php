<?php
#Send email
function Send_email($params=array())
{
    $notifs=SQLselect(
                array(
                    'table'=>'accounts_notif',
                    'limit'=>'LIMIT 1'
                    ),
                array( 
                    'account'=>$params['id'],
                    'type'=>'email'
                    )
            );

    if($notifs['status']=='1' || $notifs['status']=='2')
    {
        $account=SQLselect(
                array(
                    'table'=>'accounts',
                    'limit'=>'LIMIT 1'
                    ),
                array( 
                    'id'=>$params['id']
                    )
            );

        $emails=SQLinsert(
                array(
                    'table'=>'emails'
                    ),
                array(
                    'send'=> date("Y-m-d H:i:s"),
                    'domain'=> $params['domain'],
                    'account'=> $params['id'], 
                    'asset'=> $params['asset'],
                    'asset_id'=> $params['asset_id'],
                    'template'=>$params['template']
                    )
            );

		require 'theme/'.str_replace('.', '-', $params['domain']).'/'.$params['asset'].'_'.$params['template'].'.php';

		$headers = "MIME-Version: 1.0" . "\n"; 
    	$headers .="Content-type: text/html; charset=utf-8" . "\n";
    	$headers .="From: ".$params['domain']." <contacto@".$params['domain'].">" . "\r\n";
    	$headers .="X-Sender: <x-sender@".$params['domain'].">\n" . "\r\n";
        
        

     	if (mail($notifs['notif'],$subjet,$cuerpo,$headers))
     	{
            
     		$response['alert']['success']='Correo enviado.';
     	}
     	else
     	{
     		$response['alert']['warning']='Correo no enviado.';
     	}
    }
    else
    {
        $response['alert']['warning']='Correo no confirmado.';
    }	

    return $response;
}