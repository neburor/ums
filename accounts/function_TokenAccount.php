<?php
//Search Token
include 'function_SearchNetworks.php';
require 'function_SearchContacts.php';
include 'function_SearchAccount.php';
function TokenAccount ($token)
{
    $resultado=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1'
                ),
            array(
                'token_hash'=>$token
                )
            );
    if($resultado)
    {
        /*$account = array();
        $account = $resultado;
        if($networks = SearchNetworks($resultado['id']))
        {
            $account['networks']=$networks;
        }*/
        $Account=SearchAccount($resultado);
        
        return $Account;
    }
}