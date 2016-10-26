<?php
//Logins

function NewLogin ($params=array())
{
    $resultado=SQLinsert(
            array(
                'table'=>'logins'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'],
                'remote_addr'=> $_SERVER['REMOTE_ADDR'],
                'type'=> $params['type'], 
                'account'=> $params['account']
                )
            );
}
/*
function NewLogin ($params=array())
{
    global $mysqli;
    
	$sql="
        INSERT INTO `logins` 
        (`id`, `datetime`, `domain`, `device`, `type`, `account`) 
        VALUES 
        (NULL, '".date("Y-m-d H:i:s")."', '".UMSDOMAIN."', '".$_SESSION['device']['id']."', '".$params['type']."','".$params['account']."') ";
    
    if (!$resultado = $mysqli->query($sql)) 
    {
       if(isset($_SESSION['debugger']))
        {
            $_SESSION['debugger'][]='SQL:insert:logins:error | '.$mysqli->errno.':'.$mysqli->error;
        }
    }
    else
    {
        if(isset($_SESSION['debugger']))
        {
            $_SESSION['debugger'][]='SQL:insert:logins:ok';
        }
    }
}
*/