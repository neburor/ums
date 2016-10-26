<?php
//Functions Messages
function InsertMessage($params=array())
{
	if(isset($_SESSION['logged']))
	{
        $resultado=SQLinsert(
            array(
                'table'=>'messages'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'],
                'url'=> 'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'),
                'form'=> $params['formtype'], 
                'from_id'=> $_SESSION['logged']['id'], 
                'to_id'=> '0',
                'message'=> $params['message']
                )
            );

    	if($resultado)
    	{
        	$response['alert']['success'] = 'Gracias por contactarnos, pronto te responderemos.';
    	}
    	else
    	{
        	$response['alert']['warning'] = 'Disculpa no se guardo tu mensaje, por favor intenta más tarde.';
    	}
    	return $response;
	}
	else
	{

	}		
}
function ListMessages($account)
{
    $resultado=SQLselect(
            array(
                'table'=>'messages',
                'query'=>"SELECT * FROM `messages` WHERE `domain` = '".UMSDOMAIN."' AND (`from_id` = '".$account."' OR `to_id` = '".$account."') ORDER BY `id` ASC"
                )
            );

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return null;
    }
}