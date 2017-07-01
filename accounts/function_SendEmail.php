<?php
#Send email 
function Send_email($type,$params=array())
{


	$resultado=SQLselect(
            array(
                'table'=>'accounts_notif',
                'limit'=>'LIMIT 1'
                ),
            array( 
                'domain'=>UMSDOMAIN,
                'account'=>$params['id'],
                'type'=>'email'
                )
            );
	if($resultado)
	{
        $emails=SQLinsert(
                array(
                    'table'=>'emails'
                    ),
                array(
                    'send'=> date("Y-m-d H:i:s"),
                    'domain'=> UMSDOMAIN,
                    'account'=> $params['id'], 
                    'asset'=> $type
                    )
            );
        
		require $_SERVER['DOCUMENT_ROOT'].'/ums/theme/'.THEMEDIR.'/email_'.$type.'.php';

		$headers = "MIME-Version: 1.0" . "\n"; 
    	$headers .="Content-type: text/html; charset=utf-8" . "\n";
    	$headers .="From: ".UMSDOMAIN." <contacto@".UMSDOMAIN.">" . "\r\n";
    	$headers .="X-Sender: <x-sender@".UMSDOMAIN.">\n" . "\r\n";


     	if (mail($resultado['notif'],$subjet,$cuerpo,$headers))
     	{

     		return true;
     	}
     	else
     	{
     		return false;
     	}
	}   
}