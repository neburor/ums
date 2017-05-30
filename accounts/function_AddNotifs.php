<?php
// AddNotifs
function AddNotifs ($params=array())
{
    $params = array_merge(array(
        'datetime'      => date("Y-m-d H:i:s"),
        'domain'        => UMSDOMAIN,
        'account'    	=> '',
        'type'     		=> '',
        'notif'     	=> '',
        'status'        => '0'
    ), $params);

    $resultado=SQLinsert(
            array(
                'table'=>'accounts_notif'
                ),
            array(
                'datetime'  => $params['datetime'],
                'domain'    => $params['domain'],
                'account'	=> $params['account'],
                'type' 		=> $params['type'], 
                'notif' 	=> $params['notif'], 
                'status'    => $params['status']
                )
            );
    if($resultado)
    {
    	return true;
    }
    else
    {
    	return false;
    }
}