<?php
//Logins
function NewLogin ($params=array())
{

	$insert="
        INSERT INTO `logins` 
        (`id`, `datetime`, `domain`, `device`, `type`, `account`) 
        VALUES 
        (NULL, '".date("Y-m-d H:i:s")."', '".UMSDOMAIN."', '".$_SESSION['device']['id']."', '".$params['type']."','".$params['account']."') ";
    
    if(!mysql_query($insert))
    {
        echo mysql_error();
    }
}
