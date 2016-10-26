<?php
//Functions Messages
function InsertComment($params=array())
{
    $params = array_merge(array(
        'inid'=> '0',
        'toid'=> '0'
    ), $params);

	if(isset($_SESSION['logged']))
	{
        $resultado=SQLinsert(
            array(
                'table'=>'comments'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'],
                'url'=> 'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'),
                'form'=> $params['formtype'], 
                'from_id'=> $_SESSION['logged']['id'], 
                'to_id'=> $params['toid'],
                'in_id'=> $params['inid'],
                'comment'=> $params['comment']
                )
            );

    	if($resultado)
    	{
        	$response['alert']['success'] = 'Gracias por tu comentario.';
    	}
    	else
    	{
        	$response['alert']['warning'] = 'Disculpa no se guardo tu comentario, por favor intenta más tarde.';
    	}
    	return $response;
	}
	else
	{

	}		
}
function ListComments($url)
{
    if(isset($_SESSION['logged']))
    {
        $liked="`account` = '".$_SESSION['logged']['id']."'";
    }
    else
    {
        $liked="`device` = '".$_SESSION['device']['id']."' AND `account` = '0'";
    }
    $resultado=SQLselect(
            array(
                'table'=>'comments',
                'query'=>"SELECT 
    comments.`id`,
    comments.`datetime`,
    comments.`from_id`,
    comments.`to_id`,
    comments.`in_id`,
    comments.`comment`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`,
    Case accounts.`name`
        When comments.`to_id` = accounts.`id`
        Then (SELECT accounts.`name` FROM `accounts` WHERE comments.`to_id` = accounts.`id`)
    END
    AS `to_name`,
 (select count(*) from `likes` where `asset`= 'comment' and `asset_id` = comments.`id` and `like` = '1') 
 AS `likes`,
 (select `like` from `likes` where `asset`= 'comment' and `asset_id` = comments.`id` and ".$liked." ORDER BY `id` DESC LIMIT 1) 
 AS `liked`
    FROM `comments` 
        INNER JOIN `accounts`
            ON comments.`from_id` = accounts.`id`
            OR comments.`to_id` = accounts.`id`
        INNER JOIN `accounts_sn`
            ON comments.`from_id` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
    WHERE comments.`url` = '".$url."'
    AND (comments.`status`='1' || comments.`status`='2')
    GROUP BY comments.`id`
    ORDER BY comments.`id`
    DESC"
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