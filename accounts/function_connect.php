<?php
//Login
require '../mysql_db.php';
require '../login/function_logins.php';
require 'function_SearchAccount.php';
require 'function_SearchNetworks.php';
require 'function_NewAccount.php';
require 'function_UpdateNetwork.php';

function ConnectAccount ($params=array())
{
    $resultado=SQLselect(
            array(
                'table'=>'accounts_sn',
                'limit'=>'LIMIT 1'
                ),
            array(
                'domain'=>UMSDOMAIN,
                'network'=>$params['network']['net'],
                'network_id'=>$params['network']['id']
                )
            );

    if($resultado)
    {
        if(($params['network']['pic']!=$resultado['pic']) || ($params['network']['cover']!=$resultado['cover']))
        {
            UpdateNetwork($resultado['id'],$params);
        }
        $ConnectAccount=SearchAccount(array('id'=>$resultado['account']));
    }
    else
    {
        $ConnectAccount=NewAccount($params);
    }

    if($ConnectAccount)
    {
        NewLogin(array( 'account'=> $ConnectAccount['id'],
                    'type'=>$params['network']['net'],
                    'form_id'=>$params['form_id'],
                    'url'=>$params['url_ref']
                    ));
    }
    

    return $ConnectAccount;
}