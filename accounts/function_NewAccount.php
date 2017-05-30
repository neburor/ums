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
        'role'          => '0'
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
                'role'      => $params['role']
                )
            );

        AddHash($resultado);
        $Account=SearchAccount(array('id'=>$resultado));
        if($params['type']=='connect')
        {
            $Account['networks']=AddNetwork($Account['id'],$params['network']);
        }
       

        if(($params['useremail'] && 
            AddNotifs(array('type'=>'email','account'=>$Account['id'],'notif'=>$Account['useremail']))
            ) ||
           ($params['network']['email'] && 
            AddNotifs(array('type'=>'email','account'=>$Account['id'],'notif'=>$Account['networks'][$params['network']['net']]['email']))
            )
           ) 
        {
            if($params['role']=='0' && Send_email('confirmation',$Account))
            {
                $Account['alert']['warning']="<strong>Bienvenido !</strong> te enviamos un correo, verifica tu bandeja o tus correos no deseados y confirma.";
            }
        }
        return $Account;
}


/*function NewAccount ($params=array())
{
    $resultado=SQLinsert(
            array(
                'table'=>'accounts'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'token_hash'=> '',
                'user_hash'=> '', 
                'name'=> $_SESSION['connect']['name'], 
                'useremail'=> '',
                'password'=>'',
                'pic'=>$_SESSION['connect']['network'],
                'cover'=>$_SESSION['connect']['network'],
                'role'=>'0'
                )
            );

        AddHash($resultado);
        $Account=SearchAccount(array('id'=>$resultado));
        if($params['type']=='connect')
        {
            $Account['networks']=AddNetwork($Account['id']);
        }
        return $Account;
}
*/