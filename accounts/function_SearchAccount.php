<?php
//Search Account

function SearchAccount ($params=array())
{
    $resultado=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1',
                'query'=>"SELECT *, 
                (select count(*) from `notifications_app` where `to_id`='".$params['id']."' and `status`='0')
                AS `notifs_app`
                FROM `accounts`
                WHERE `id`='".$params['id']."'
                LIMIT 1"
                )
            );
    if($resultado)
    {
        $account = array();
        $account = $resultado;
        if($notifs = SearchNotifs($params['id']))
        {
            $account['notifs']=$notifs;
        }
        if($networks = SearchNetworks($params['id']))
        {
            $account['networks']=$networks;
        }
        // if($contact = SearchContacts($params['id']))
        // {
        //     $account['contact']=$contact;
        // }

        return $account;
    }
}
function SearchNotifs($id)
{
    $resultado=SQLselect(
            array(
                'table'=>'accounts_notif'
                ),
            array(
                'account'=>$id
                )
            );

    if($resultado)
    {
        foreach ($resultado as $key => $value) 
        {
            $notifs[$value['type']]=$value;
        }

        return $notifs; 
    }
    else
    {
        return false;
    }
}