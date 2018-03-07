<?php
#Send email 
function Send_email($asset,$campaign,$params=array())
{


	// $resultado=SQLselect(
 //            array(
 //                'table'=>'accounts_notif',
 //                'limit'=>'LIMIT 1'
 //                ),
 //            array( 
 //                'domain'=>UMSDOMAIN,
 //                'account'=>$params['id'],
 //                'type'=>'email'
 //                )
 //            );
    if($params['useremail']){
        $notif=$params['useremail'];
    }else{
        foreach ($params['notifs'] as $key => $value) {
            if($key=='email'){
            $notif=$value['notif'];
            }
        }   
    }
	if($notif)
	{
        include 'templates.php';

        

        $emails=SQLinsert(
                array(
                    'table'=>'emails'
                    ),
                array(
                    'send'=> date("Y-m-d H:i:s"),
                    'domain'=> UMSDOMAIN,
                    'account'=> $params['id'], 
                    'asset'=> $asset,
                    'campaign'=> $campaign
                    )
            );

        $params['email']=$notif;
        $params['emailid']=$emails;
        $Template=Template($asset,$params);
        
		#require $_SERVER['DOCUMENT_ROOT'].'/ums/theme/'.THEMEDIR.'/email_'.$asset.'.php';

		$headers = "MIME-Version: 1.0" . "\n"; 
    	$headers .="Content-type: text/html; charset=utf-8" . "\n";
    	$headers .="From: ".$Template['from']." <contacto@".UMSDOMAIN.">" . "\r\n";
    	$headers .="X-Sender: <x-sender@".UMSDOMAIN.">\n" . "\r\n";


     	if (mail($notif,$Template['subject'],$Template['content'],$headers))
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
     		return true;
     	}
     	else
     	{
     		return false;
     	}
	}   
}