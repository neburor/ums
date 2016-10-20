<?php
//HASH
function AddHash($id)
{
  global $mysqli;
  
	$token_hash = substr(md5($_SERVER['REQUEST_TIME'].$id), 0,18);
	$user_hash = strtoupper(substr(md5($id.$_SERVER['REQUEST_TIME']), 0,6));
 	$sql="
        UPDATE `accounts`
        SET `token_hash` = '".$token_hash."',
        	`user_hash` = '".$user_hash."' 
        WHERE `id` = '".$id."'
        LIMIT 1";

  if (!$resultado = $mysqli->query($sql)) 
    {
       if(isset($_SESSION['debugger']))
        {
            $_SESSION['debugger'][]='SQL:update:accounts:error | '.$mysqli->errno.':'.$mysqli->error;
        }
    }
    else
    {
        if(isset($_SESSION['debugger']))
        {
            $_SESSION['debugger'][]='SQL:update:accounts:ok | AddHash';
        }

    }
}