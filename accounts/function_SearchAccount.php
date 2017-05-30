<?php
//Search Account

function SearchAccount ($params=array())
{
    $resultado=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1',
                'query'=>"SELECT *, 
                (select count(*) from `notifications_app` where `to_id`='".$params['id']."' and `status`='0')
                AS `notifs`
                FROM `accounts`
                WHERE `id`='".$params['id']."'
                LIMIT 1"
                )
            );
    if($resultado)
    {
        $account = array();
        $account = $resultado;
        if($networks = SearchNetworks($params['id']))
        {
            $account['networks']=$networks;
        }
        
        return $account;
    }
}
/*
function SearchAccount ($params=array())
{
    global $mysqli;
    
	$sql="
        SELECT * FROM `accounts` 
        WHERE `id` = '".$params['id']."'
        ORDER BY `id` DESC LIMIT 1";

	if (!$resultado = $mysqli->query($sql)) 
    {
        if(isset($_SESSION['debugger']))
        {
            $_SESSION['debugger'][]='SQL:select:accounts:error | '.$mysqli->errno.':'.$mysqli->error;
        }
    }
    else
    {
        if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='SQL:select:accounts:ok';
            }
        if ($resultado->num_rows === 0) 
        {
            if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='mysqli:result:null';
            }
        }
        else
        {
            if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='mysqli:result:ok => SearchNetworks()';
            }
            $account = $resultado->fetch_assoc();
            if($networks= SearchNetworks($params['id']))
            {
                $account['networks']=$networks;
            }
        }
    }
    
    return $account;
}
*/