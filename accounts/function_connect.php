<?php
//Login
require '../mysql_db.php';
MysqlConnect();

function ConnectAccount ()
{
$sql=mysql_query("
        SELECT * FROM `accounts_sn` 
        WHERE `network` = '".$_SESSION['connect']['network']."'
        AND  `network_id` = '".$_SESSION['connect']['id']."'
        ORDER BY `id` DESC LIMIT 1
        ");
$row = array();
        
while($i = mysql_fetch_assoc($sql)) 
{
	$row[] = $i;
}

if($row[0]['account'])
{
	require 'function_SearchAccount.php';

	$ConnectAccount=SearchAccount(array('id'=>$row[0]['account']));
}
else
{
	require 'function_NewAccount.php';

	$ConnectAccount=NewAccount(array('type'=>'connect'));
}

	return $ConnectAccount;
}



