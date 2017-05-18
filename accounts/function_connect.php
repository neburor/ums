<?php
//Login
require '../mysql_db.php';
require '../login/function_logins.php';
require 'function_SearchAccount.php';
require 'function_SearchNetworks.php';
require 'function_NewAccount.php';
require 'function_UpdateNetwork.php';

function ConnectAccount ()
{
    $resultado=SQLselect(
            array(
                'table'=>'accounts_sn',
                'limit'=>'LIMIT 1'
                ),
            array(
                'domain'=>UMSDOMAIN,
                'network'=>$_SESSION['connect']['network'],
                'network_id'=>$_SESSION['connect']['id']
                )
            );

    if($resultado)
    {
        if(($_SESSION['connect']['pic']!=$resultado['pic']) || ($_SESSION['connect']['cover']!=$resultado['cover']))
        {
            UpdateNetwork($resultado['id']);
        }
        $ConnectAccount=SearchAccount(array('id'=>$resultado['account']));
    }
    else
    {
        $ConnectAccount=NewAccount(array('type'=>'connect'));
    }

    if($ConnectAccount)
    {
        NewLogin(array( 'account'=> $ConnectAccount['id'],
                    'type'=>$_SESSION['connect']['network']
                    ));
    }
    

    return $ConnectAccount;
}
/*
function ConnectAccount ()
{
	GLOBAL $mysqli;
	
	$sql="
        SELECT * FROM `accounts_sn` 
        WHERE `domain` = '".UMSDOMAIN."'
        AND `network` = '".$_SESSION['connect']['network']."'
        AND  `network_id` = '".$_SESSION['connect']['id']."'
        ORDER BY `id` DESC LIMIT 1
        ";

	if (!$resultado = $mysqli->query($sql)) 
    {
        if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='SQL:select:account_sn:error | '.$mysqli->errno.':'.$mysqli->error;
            }
    }
    else
    {
        if(isset($_SESSION['debugger']))
            {
                $_SESSION['debugger'][]='SQL:select:accounts_sn:ok';
            }
        if ($resultado->num_rows === 0) 
        {
        	if(isset($_SESSION['debugger']))
			{
				$_SESSION['debugger'][]='mysqli:result:null => NewAccount()';
			}
			$ConnectAccount=NewAccount(array('type'=>'connect'));
        }
        else
        {
        	if(isset($_SESSION['debugger']))
			{
				$_SESSION['debugger'][]='mysqli:result:ok => SearchAccount()';
			}
			$accounts_sn = $resultado->fetch_assoc();
			$ConnectAccount=SearchAccount(array('id'=>$accounts_sn['account']));
        }
    }

	NewLogin(array(	'account'=>	$ConnectAccount['id'],
					'type'=>$_SESSION['connect']['network']
					));

	return $ConnectAccount;
}
*/