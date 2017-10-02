<?php
//Logins

function NewLogin ($params=array())
{
    $resultado=SQLinsert(
            array(
                'table'=>'logins'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'],
                'remote_addr'=> $_SERVER['REMOTE_ADDR'],
                'type'=> $params['type'], 
                'account'=> $params['account'],
                'form_id'=> $params['form_id'],
                'url'=> $params['url']
                )
            );
}
