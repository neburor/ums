<?php
//Login
require '../mysql_db.php';
require '../login/function_logins.php';
require 'function_SearchAccount.php';
require 'function_SearchNetworks.php';
require 'function_NewAccount.php';

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
		$ConnectAccount=SearchAccount(array('id'=>$row[0]['account']));
	}
	else
	{
		$ConnectAccount=NewAccount(array('type'=>'connect'));
	}

	NewLogin(array(	'account'=>	$ConnectAccount['id'],
					'type'=>$_SESSION['connect']['network']
					));


	return $ConnectAccount;
}



