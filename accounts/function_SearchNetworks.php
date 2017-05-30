<?php
//Search networks

function SearchNetworks ($account)
{
    $resultado=SQLselect(
            array(
                'table'=>'accounts_sn'
                ),
            array(
                'account'=>$account
                )
            );

    if($resultado)
    {
        foreach ($resultado as $key => $value) 
        {
            $networks[$value['network']]=$value;
        }

        return $networks; 
    }
    else
    {
        return false;
    }
}
/*
function SearchNetworks ($account)
{
    global $mysqli;

	$sql="
        SELECT * FROM `accounts_sn` 
        WHERE `account` = '".$account."'";
    if (!$resultado = $mysqli->query($sql)) 
    {
        if(isset($_SESSION['debugger']))
        {
            $_SESSION['debugger'][]='SQL:select:accounts_ns:error | '.$mysqli->errno.':'.$mysqli->error;
        }
    }
    else
    {
        if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='SQL:select:accounts_ns:ok';
            }
        if ($resultado->num_rows === 0) 
        {
            if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='mysqli:result:null';
            }
            return false;
        }
        else
        {
            if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='mysqli:result:ok';
            }
            while ($network = $resultado->fetch_assoc()) 
            {
                $networks[$network['network']]=$network;
            }

             return $networks;  
        }
    }
}
*/