<?php
//New Account
require 'function_hash.php';
include 'function_AddNetwork.php';

function NewAccount ($params=array())
{

    $insert="
        INSERT INTO `accounts` 
        (`id`, `datetime`, `domain`, `token_hash`, `user_hash`, `name`, `username`, `password`, `pic`, `cover`, `role`)
        VALUES 
        (NULL, '".date("Y-m-d H:i:s")."','".UMSDOMAIN."', '','', '".$_SESSION['connect']['name']."', '', '', '".$_SESSION['connect']['network']."', '".$_SESSION['connect']['network']."', '0')";

    if(mysql_query($insert))
    {
    	$lastUser=mysql_insert_id();
    	AddHash($lastUser);
    	$Account=SearchAccount(array('id'=>$lastUser));
    	if($params['type']=='connect')
    	{
            $Account['networks']=AddNetwork($Account['id']);
    	}

    	return $Account;

    }
    else
    {
        echo mysql_error();
    }
}