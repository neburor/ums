<?php
//Devices
function NewDevice ()
{
	$device_hash = md5($_SERVER['REQUEST_TIME_FLOAT']);
    $insert="
        INSERT INTO `devices` 
        (`id`, `datetime`, `domain`, `device_hash`, `user_agent`, `remote_addr`, `request_uri`) 
        VALUES 
        (NULL, '".date("Y-m-d H:i:s")."', '".UMSDOMAIN."', '".$device_hash."', '".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['REQUEST_URI']."') ";
        if(mysql_query($insert))
        {
            $_SESSION['device']['id']=mysql_insert_id();
            $_SESSION['device']['hash']=$device_hash;
            setcookie("device",$device_hash,time()+7776000,"/", UMSDOMAIN);
        }
        else
        {
            echo mysql_error();
        }
}
function SearchDevice ()
{
    $sql=mysql_query("
        SELECT * FROM `devices` 
        WHERE `device_hash` = '".$_COOKIE['device']."'
        ORDER BY `id` DESC LIMIT 1");

    $row = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $row[] = $i;
    }

    if($row[0])
    {
        $_SESSION['device']['id']=$row[0]['id'];
        $_SESSION['device']['hash']=$row[0]['device_hash'];
    }
}