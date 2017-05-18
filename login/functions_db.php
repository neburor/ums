<?php
#Funtions DB Logins
include 'function_logins.php';
function Signup($post=array())
{
    if($post['autopass'] || ($post['pass']!='' && $post['pass']==$post['repass']))
    {
        if($post['autopass'])
        {
            $post['pass']=substr(md5(uniqid(rand())),0,4);
        }

        $resultado=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1'
                ),
            array(
                'domain'=>UMSDOMAIN,
                'useremail'=> $post['useremail']
                )
            );
        if($resultado)
        {
            $response['alert']=array('danger' => 'Este correo ya esta en uso.');
            $response['feedback']['useremail'] = 'invalid';
        }
        else
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
                    'name'=> $post['name'], 
                    'useremail'=> $post['useremail'],
                    'password'=>$post['pass'],
                    'pic'=>'avatar',
                    'cover'=>'',
                    'role'=>'0'
                    )
            );
            if($resultado)
            {
                include 'ums/accounts/function_hash.php';
                AddHash($resultado);
                AddAvatar($resultado,URLTHEME.DIRAVATARS.'/'.$post['pic']);

                if($post['autologin'])
                {    
                    $account=SQLselect(
                            array(
                                'table'=>'accounts',
                                'limit'=>'LIMIT 1'
                                ),
                            array(
                                'domain'=>UMSDOMAIN,
                                'id'=> $resultado
                                )
                            );
                    if($account)
                    {
                        NewLogin(array('type'=>'email','account'=>$account['id']));
                        $_SESSION['logged']=$account;

                        include 'ums/accounts/function_SearchNetworks.php';
                        if($networks = SearchNetworks($account['id']))
                        {
                            $_SESSION['logged']['networks']=$networks;
                        }

                       setcookie("token",$_SESSION['logged']['token_hash'],time()+7776000,"/", UMSDOMAIN);

                       header("Location: " . strtok($_SERVER['HTTP_REFERER'],'?') . '?tab='. $post['callback'] . '#' . $post['callback']);

                    }
                    else
                    {
                        $response['alert']['warning'].= 'Error al iniciar sesion automaticamente. Te enviamos un correo con las indicaciones.';
                    }
                }
                else
                {
                    $response['alert']= array('success' => 'Gracias por registrarte, ya puedes iniciar sesion, no olvides confirmar tu correo.');
                    if($post['autopass']=='on')
                    {
                        $response['alert']['success'].= '<br>Tu contraseña es <b>'.$post['pass'].'</b> ';
                    }
                }
            }
        } 
    }
    elseif($post['pass']=='')
    {
        $response['alert']=array('warning' => 'Nescesita especificar una contraseña o indique que se genere automaticamente.');
        $response['feedback']['pass']   = 'invalid';
    }
    elseif ($post['pass']!=$post['repass']) 
    {
        $response['alert']=array('warning' => 'La confirmacion de la contraseña no es igual.');
        $response['feedback']['pass']   = 'valid';
        $response['feedback']['repass'] = 'invalid';
    }
   
   return $response;
}
function Login($post= array())
{
    if(!isset($_SESSION['logged']))
    {
        $resultado=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1'
                ),
            array(
                'domain'=>UMSDOMAIN,
                'useremail'=> $post['useremail']
                )
            );
        if($resultado)
        {
            if($post['userpass']==$resultado['password'])
            {
                $response['alert'] = array('success'=>'Has iniciado sesion correctamente');
                $response['feedback']['useremail'] = 'valid';
                $response['feedback']['userpass'] = 'valid';

                NewLogin(array('type'=>'email','account'=>$resultado['id']));
                $_SESSION['logged']=$resultado;

                $notifs=SQLselect(
                            array(
                                'table'=>'notifications'
                                ),
                            array(
                                'to_id'=> $resultado['id'],
                                'status'=>'0'
                                )
                            );
                if($notifs)
                {
                    $_SESSION['logged']['notif']=count($notifs);
                }

                include 'ums/accounts/function_SearchNetworks.php';
                if($networks = SearchNetworks($resultado['id']))
                {
                    $_SESSION['logged']['networks']=$networks;
                }

                if ($post['autologin']) 
                {
                    setcookie("token",$_SESSION['logged']['token_hash'],time()+7776000,"/", UMSDOMAIN);
                }

               header("Location: " . strtok($_SERVER['HTTP_REFERER'],'?') . '?tab='. $post['callback'] . '#' . $post['callback']);
            }
            else
            {
                $response['alert'] = array('warning'=>'La contraseña no es correcta, <a href="" class="alert-link">Enviarme mi contraseña por correo</a>');
                $response['feedback']['useremail']   = 'valid';
                $response['feedback']['userpass']   = 'invalid';
            }
        }
        else
        {
            $response['alert'] = array('danger'=>'Usuario no registrado. Crea tu cuenta <b>GRATIS!</b>');
            $response['feedback']['useremail']   = 'invalid';
            $response['feedback']['userpass']   = 'invalid';
        }
    }

    return $response;
}
function AddAvatar($account,$avatar)
{
    $resultado=SQLinsert(
            array(
                'table'=>'accounts_sn'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'account'=> $account,
                'network'=> 'avatar', 
                'network_id'=> '', 
                'name'=> '',
                'email'=> '',
                'screenname'=> '',
                'url'=> '',
                'pic'=> $avatar,
                'cover'=> '',
                'cover_y'=> '',
                'cover_x'=> ''
                )
            );
}