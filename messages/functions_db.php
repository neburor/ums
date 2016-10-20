<?php
//Functions Messages
function InsertMessage($params=array())
{
	if(isset($_SESSION['logged']))
	{
		$insert = "
    				INSERT INTO `messages`
    					(`id`,`datetime`,`domain`,`url`,`form`,`from_id`,`to_id`,`message` )
    				VALUES 
    					(NULL,'".date("Y-m-d H:i:s")."', '".UMSDOMAIN."', '".'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?')."', '".$params['formtype']."', '".$_SESSION['logged']['id']."', '0', '".$params['message']."')
    				";

    	if(mysqli_query($insert))
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
    $sql=mysqli_query("
        SELECT * FROM `messages` 
        WHERE `from_id` = '".$account."'
        OR `to_id` = '".$account."'
        ORDER BY `id` ASC");
     $rows = array();
        
    while($i = mysqli_fetch_assoc($sql)) 
    {
        $rows[] = $i;
    }

    return $rows;
}