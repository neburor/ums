<?php
#Funtions DB Accounts
function Settings($post=array())
{

    unset($post['formid']);
    unset($post['formtype']);

    if($post['userpass'])
    {
        if($post['userpass']!=$_SESSION['logged']['password'])
        {
            $response['alert']=array('warning' => 'Escriba su contraseña actual.');
            $response['feedback']['userpass']   = 'invalid';
        }
        elseif ($post['newpass']!=$post['repass']) 
        {
            $response['alert']=array('warning' => 'La confirmacion de la contraseña no es igual.');
            $response['feedback']['pass']   = 'valid';
            $response['feedback']['repass'] = 'invalid';
        }
        else
        {
            $response = profile_update(array('password'=>$post['newpass']),$_SESSION['logged']['id']);
        }
    }
    elseif($post['pic'])
    {
        $response= pic_update($post,$_SESSION['logged']['id']);
    }
    elseif($post['notif'])
    {
        $response= notif_update($post,$_SESSION['logged']['id']);
    }
    else
    {
        $response= profile_update($post,$_SESSION['logged']['id']); 
    }

    return $response; 
}
function pic_update($params=array(),$account)
{
    foreach ($params as $column => $value) {
        if(array_key_exists($column, $_SESSION['logged']['networks']['avatar']) && (URLTHEME.'avatars/'.$value != $_SESSION['logged']['networks']['avatar'][$column]))
        {
            $columns[$column]= URLTHEME.'avatars/'.$value;
        }
    }
    if($columns)
    {
        $resultado=SQLupdate(
                        array(
                            'table'=>'accounts_sn'
                            ),
                        array(
                            'id'=>$account
                            ),
                        $columns
                        );
        if($resultado)
        {
            foreach ($columns as $key => $value) {
                $_SESSION['logged']['networks']['avatar'][$key]=$value;
            }
            $response['alert'] = array('success'=>'Los cambios han sido guardados.');
        }
        else 
        {
            $response['alert'] = array('danger'=>'No se guardaron los cambios, intente mas tarde.');
        }
    }
    else
    {
        $response['alert'] = array('warning'=>'No hay cambios para guardar.');
    }  
    
    return $response;
}
function notif_update($params=array(),$account)
{
    foreach ($params as $column => $value) {
        if(array_key_exists($column, $_SESSION['logged']['notifs']['email']) && ($value != $_SESSION['logged']['notifs']['email'][$column]))
        {
            $columns[$column]=$value;
        }
    }
    if($columns)
    {
        $resultado=SQLupdate(
                        array(
                            'table'=>'accounts_notif'
                            ),
                        array(
                            'id'=>$account
                            ),
                        $columns
                        );
        if($resultado)
        {
            foreach ($columns as $key => $value) {
                $_SESSION['logged']['notifs']['email'][$key]=$value;
            }
            $response['alert'] = array('success'=>'Los cambios han sido guardados.');
        }
        else 
        {
            $response['alert'] = array('danger'=>'No se guardaron los cambios, intente mas tarde.');
        }
    }
    else
    {
        $response['alert'] = array('warning'=>'No hay cambios para guardar.');
    }  
    
    return $response;
}
function profile_update($params=array(),$account)
{
    foreach ($params as $column => $value) {
        if(array_key_exists($column, $_SESSION['logged']) && ($value != $_SESSION['logged'][$column]))
        {
            $columns[$column]=$value;
        }
    }
    if($columns)
    {
        $resultado=SQLupdate(
                        array(
                            'table'=>'accounts'
                            ),
                        array(
                            'id'=>$account
                            ),
                        $columns
                        );
        if($resultado)
        {
            foreach ($columns as $key => $value) {
                $_SESSION['logged'][$key]=$value;
            }
            $response['alert'] = array('success'=>'Los cambios han sido guardados.');
        }
        else 
        {
            $response['alert'] = array('danger'=>'No se guardaron los cambios, intente mas tarde.');
        }
    }
    else
    {
        $response['alert'] = array('warning'=>'No hay cambios para guardar.');
    }  
    
    return $response;
}