<?php
#Send email
function Send_email($type,$params=array())
{
		require 'theme/'.str_replace('.', '-', $params['domain']).'/email_'.$type.'.php';

		$headers = "MIME-Version: 1.0" . "\n"; 
    	$headers .="Content-type: text/html; charset=utf-8" . "\n";
    	$headers .="From: ".$params['domain']." <contacto@".$params['domain'].">" . "\r\n";
    	$headers .="X-Sender: <x-sender@".$params['domain'].">\n" . "\r\n";

     	if (mail($params['email'],$subjet,$cuerpo,$headers))
     	{
     		return true;
     	}
     	else
     	{
     		return false;
     	}	
}