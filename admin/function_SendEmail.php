<?php
#Send email
function Send_email($type,$params=array())
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
    $account=SQLselect(
                array(
                    'table'=>'accounts',
                    'limit'=>'LIMIT 1'
                    ),
                array( 
                    'id'=>$params['id']
                    )
            );

    if($notifs['status']=='1' || $notifs['status']=='2')
    {
        $emails=SQLinsert(
                array(
                    'table'=>'emails'
                    ),
                array(
                    'send'=> date("Y-m-d H:i:s"),
                    'domain'=> $params['domain'],
                    'account'=> $params['id'], 
                    'asset'=> $type
                    )
            );

		require 'theme/'.str_replace('.', '-', $params['domain']).'/email_'.$type.'.php';

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