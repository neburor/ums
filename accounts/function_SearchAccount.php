<?php
//Search Account
function SearchAccount ($params=array())
{
	$sql=mysql_query("
        SELECT * FROM `accounts` 
        WHERE `network` = '".$search."'
        AND  `network_id` = '".$params['id']."'
        ORDER BY `id` DESC LIMIT 1");
}