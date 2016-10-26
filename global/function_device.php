<?php
//Devices

function NewDevice ()
{
    $device_hash = md5($_SERVER['REQUEST_TIME_FLOAT']);
    $resultado=SQLinsert(
            array(
                'table'=>'devices'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device_hash'=> $device_hash,
                'user_agent'=> $_SERVER['HTTP_USER_AGENT'], 
                'remote_addr'=> $_SERVER['REMOTE_ADDR'], 
                'request_uri'=> $_SERVER['REQUEST_URI']
                )
            );
    if($resultado)
    {
        $_SESSION['device']['id']=$resultado;
        $_SESSION['device']['hash']=$device_hash;
        setcookie("device",$device_hash,time()+7776000,"/", UMSDOMAIN);
    }
}
function SearchDevice ()
{
    $resultado=SQLselect(
            array(
                'table'=>'devices',
                'limit'=>'LIMIT 1'
                ),
            array(
                'domain'=>UMSDOMAIN,
                'device_hash'=> $_COOKIE['device']
                )
            );
    if($resultado)
    {
        $_SESSION['device']['id']=$resultado['id'];
        $_SESSION['device']['hash']=$resultado['device_hash'];
    }

}
/*
function NewDevice ()
{
    global $mysqli;
    $device_hash = md5($_SERVER['REQUEST_TIME_FLOAT']);
    $sql="
        INSERT INTO `devices` 
        (`id`, `datetime`, `domain`, `device_hash`, `user_agent`, `remote_addr`, `request_uri`) 
        VALUES 
        (NULL, '".date("Y-m-d H:i:s")."', '".UMSDOMAIN."', '".$device_hash."', '".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['REQUEST_URI']."') ";
        if (!$resultado = $mysqli->query($sql)) 
        {
            if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='SQL:insert:device:error | '.$mysqli->errno.':'.$mysqli->error;
            }
        }
        else
        {
            if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='SQL:insert:device:ok';
            }
            $_SESSION['device']['id']=$mysqli->insert_id;
            $_SESSION['device']['hash']=$device_hash;
            setcookie("device",$device_hash,time()+7776000,"/", UMSDOMAIN);
        }
}
function SearchDevice ()
{
    global $mysqli;
    $sql="
        SELECT * FROM `devices` 
        WHERE `domain` = '".UMSDOMAIN."'
        AND `device_hash` = '".$_COOKIE['device']."'
        ORDER BY `id` DESC LIMIT 1";

    if (!$resultado = $mysqli->query($sql)) 
    {
        if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='SQL:select:device:error | '.$mysqli->errno.':'.$mysqli->error;
            }
    }
    else
    {
        if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='SQL:select:device:ok';
            }
        $device = $resultado->fetch_assoc();
        $_SESSION['device']['id']=$device['id'];
        $_SESSION['device']['hash']=$device['device_hash'];
    }
}
*/