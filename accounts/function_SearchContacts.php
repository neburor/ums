<?php
//Search networks

function SearchContacts ($account)
{
    $resultado=SQLselect(
            array(
                'table'=>'accounts_contacts',
                'query'=>'
                    SELECT * 
                        FROM `accounts_contact` a 
                        WHERE 
                        a.`datetime` = ( SELECT MAX(`datetime`) FROM `accounts_contact` WHERE `type` = a.`type`) 
                        AND a.`account` = "'.$account.'" GROUP BY a.`type`
                '));

    if($resultado)
    {
        foreach ($resultado as $key => $value) 
        {
            $contacts[$value['type']]=$value['data'];
        }

        return $contacts; 
    }
    else
    {
        return false;
    }
}