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
        include 'theme/'.str_replace('.', '-', $params['domain']).'/config.php';
        include 'admin_templates.php';

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
                    'campaign'=>$params['template']
                    )
            );

		#require 'theme/'.str_replace('.', '-', $params['domain']).'/'.$params['template'].'.php';

        if(!isset($params['name']))
        {
            $params['name']=$account['name'];
        }

        $params['email']=$notifs['notif'];
        $params['emailid']=$emails;
        $params['token_hash']=$account['token_hash'];
        $Template=Template($params);

		$headers = "MIME-Version: 1.0" . "\n"; 
    	$headers .="Content-type: text/html; charset=utf-8" . "\n";
    	$headers .="From: ".$Template['from']." <contacto@".$params['domain'].">" . "\r\n";
    	$headers .="X-Sender: <x-sender@".$params['domain'].">\n" . "\r\n";
        
        

     	if (mail($notifs['notif'],$Template['subject'],$Template['content'],$headers))
     	{
            $update=SQLupdate(
                array(
                    'table'=>'emails'
                    ),
                array(
                    'id'=> $emails
                    ),
                array(    
                    'template' => $Template['id']
                    )
            );
     		$response='Correo enviado. ';
     	}
     	else
     	{
     		$response='Correo no enviado. ';
     	}
    }
    else
    {
        $response='Correo no confirmado. ';
    }	

    return $response;
}