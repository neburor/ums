<?php
//New Account
require 'function_hash.php';
require 'function_SearchAccount.php';

function NewAccount ($params=array())
{

    $insert="
        INSERT INTO `accounts` 
        (`id`, `datetime`, `timestamp`, `domain`, `token_hash`, `user_hash`, `name`, `username`, `password`, `pic`, `cover`, `role`)
        VALUES 
        (NULL, '".date("Y-m-d H:i:s")."', '".CURRENT_TIMESTAMP."','".UMSDOMAIN."', '','', '".$_SESSION['connect']['name']."', '', '', '".$_SESSION['connect']['network']."', '".$_SESSION['connect']['network']."', '0')";

    if(mysql_query($insert))
    {
    	$lastUser=mysql_insert_id();
    	AddHash($lastUser);
    	$Account=SearchAccount(array('id'=>$lastUser));
    	if($params['type']=='connect')
    	{
    		include 'function_AddNetwork.php';
    		Addnetwork($Account['id']);
    	}

    	return $Account;

    }
}