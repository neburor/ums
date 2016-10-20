<?php
//New Account
require 'function_hash.php';
include 'function_AddNetwork.php';

function NewAccount ($params=array())
{
    global $mysqli;

    $sql="
        INSERT INTO `accounts` 
        (`id`, `datetime`, `domain`, `token_hash`, `user_hash`, `name`, `username`, `password`, `pic`, `cover`, `role`)
        VALUES 
        (NULL, '".date("Y-m-d H:i:s")."','".UMSDOMAIN."', '','', '".$_SESSION['connect']['name']."', '', '', '".$_SESSION['connect']['network']."', '".$_SESSION['connect']['network']."', '0')";

    if (!$resultado = $mysqli->query($sql)) 
    {
       if(isset($_SESSION['debugger']))
        {
            $_SESSION['debugger'][]='SQL:insert:accounts:error | '.$mysqli->errno.':'.$mysqli->error;
        }
    }
    else
    {
        if(isset($_SESSION['debugger']))
        {
            $_SESSION['debugger'][]='SQL:insert:accounts:ok';
        }
        $lastUser=$mysqli->insert_id;
        AddHash($lastUser);
        $Account=SearchAccount(array('id'=>$lastUser));
        if($params['type']=='connect')
        {
            $Account['networks']=AddNetwork($Account['id']);
        }
        return $Account;
    }
}