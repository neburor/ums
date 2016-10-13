<?php
//Search networks
function SearchNetworks ($account)
{
	$sql=mysql_query("
        SELECT * FROM `accounts_sn` 
        WHERE `account` = '".$account."'");
    $row = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $row[$i['network']] = $i;
    }

    if(count($row)==0)
    {
        return false;
    }
    else
    {
        return $row;
    }
}