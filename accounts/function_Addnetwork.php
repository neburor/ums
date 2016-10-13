<?php
// AddNetwork
function AddNetwork ($id)
{
    $insert="
        INSERT INTO `accounts_sn` 
        (`id`, `datetime`, `account`, `network`, `network_id`, `name`, `email`, `screenname`, `url`, `pic`, `cover`, `cover_y`, `cover_x`) 
        VALUES 
        (NULL, '".date("Y-m-d H:i:s")."', '".$id."', '".$_SESSION['connect']['network']."', '".$_SESSION['connect']['id']."', '".$_SESSION['connect']['name']."', '".$_SESSION['connect']['email']."', '".$_SESSION['connect']['screenname']."', '".$_SESSION['connect']['url']."', '".$_SESSION['connect']['pic']."', '".$_SESSION['connect']['cover']."', '".$_SESSION['connect']['cover_y']."', '".$_SESSION['connect']['cover_x']."')";

    if(mysql_query($insert))
    {
    	return SearchNetworks($id);
    }
    else		
    {
    	echo mysql_error(); 
    }
}