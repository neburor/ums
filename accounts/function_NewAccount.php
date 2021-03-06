<?php
//New Account
require 'function_hash.php';
require 'function_AddNetwork.php';
require 'function_AddNotifs.php';
require 'function_SendEmail.php';

function NewAccount ($params=array())
{
    $params = array_merge(array(
        'datetime'      => date("Y-m-d H:i:s"),
        'domain'        => UMSDOMAIN,
        'token_hash'    => '',
        'user_hash'     => '',
        'name'          => '',
        'useremail'     => '',
        'password'      => '',
        'pic'           => '',
        'cover'         => '',
        'role'          => '0',
        'form_id'       => '',
        'url_ref'       => ''
    ), $params);

    $resultado=SQLinsert(
            array(
                'table'=>'accounts'
                ),
            array(
                'datetime'  => $params['datetime'],
                'domain'    => $params['domain'],
                'token_hash'=> $params['token_hash'],
                'user_hash' => $params['user_hash'], 
                'name'      => $params['name'], 
                'useremail' => $params['useremail'],
                'password'  => $params['password'],
                'pic'       => $params['pic'],
                'cover'     => $params['cover'],
                'role'      => $params['role'],
                'form_id'   => $params['form_id'],
                'url_ref'   => $params['url_ref']
                )
            );

        AddHash($resultado);
        $Account=SearchAccount(array('id'=>$resultado));
        if($params['type']=='connect')
        {
            $Account['networks']=AddNetwork($Account['id'],$params['network']);
        }
        if($params['autopass'])
        {
            $Account['autopass']='on';
        }
       

        if(($params['useremail'] && 
            AddNotifs(array('type'=>'email','account'=>$Account['id'],'notif'=>$Account['useremail']))
            ) ||
           ($params['network']['email'] && 
            AddNotifs(array('type'=>'email','account'=>$Account['id'],'notif'=>$Account['networks'][$params['network']['net']]['email']))
            )
           ) 
        {
            if($notifs = SearchNotifs($Account['id']))
            {
                $Account['notifs']=$notifs;
            }

            if($params['role']=='0' && Send_email('confirmation','registro',$Account))
            {
                $Account['alert']['warning']="<strong>Bienvenido !</strong> te enviamos un correo, verifica tu bandeja o tus correos no deseados y confirma.";
            }
        }
        return $Account;
}
