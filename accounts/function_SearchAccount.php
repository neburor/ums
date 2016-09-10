<?php
//Search Account
function SearchAccount ($params=array())
{
	$sql=mysql_query("
        SELECT * FROM `accounts` 
        WHERE `id` = '".$params['id']."'
        ORDER BY `id` DESC LIMIT 1");

	$row = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $row[] = $i;
    }

    return $row[0];
}