<?php
#Funtions DB Logins
include 'ums/login/function_logins.php';
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
            include 'ums/accounts/function_NewAccount.php';
            include 'ums/accounts/function_SearchAccount.php';
            include 'ums/accounts/function_SearchNetworks.php';
            $Account=NewAccount(array(
                                    'name'          => $post['name'],
                                    'useremail'     => $post['useremail'],
                                    'password'      => $post['pass'],
                                    'pic'           => 'avatar',
                                    'autopass'      => $post['autopass'],
                                    'form_id'       => $post['formid'],
                                    'url_ref'       => strtok($_SERVER['HTTP_REFERER'],'?')
                                ));
            
            if($Account)
            {
                #include 'ums/accounts/function_hash.php';
                AddHash($Account['id']);
                if($post['autopic'])
                {
                    $avatars=scandir("ums/theme/".THEMEDIR."/avatars/");
                    $rand=rand(2,count($avatars)-1);
                    $post['pic']=$avatars[$rand];
                }
                AddAvatar($Account['id'],URLTHEME.'avatars/'.$post['pic']);

                if($post['autologin'])
                {    
                   
                    if($_SESSION['logged']=$Account)
                    {
                        NewLogin(array(
                            'type'=>'email',
                            'account'=>$Account['id'],
                            'form_id'=>$post['formid'],
                            'url'=>strtok($_SERVER['HTTP_REFERER'],'?')
                        ));

                        #include 'ums/accounts/function_SearchNetworks.php';
                        if($networks = SearchNetworks($Account['id']))
                        {
                            $_SESSION['logged']['networks']=$networks;
                        }

                    $_SESSION['logged']['login']='email';
                        

                       setcookie("token",$_SESSION['logged']['token_hash'],time()+7776000,"/", UMSDOMAIN);

                        if (strpos($post['callback'], '/app/') !== false) 
                        {
                            $reff=strtok($_SERVER['HTTP_REFERER'],'?') . '#'.$post['callback'];
                        }
                        elseif(strpos($post['callback'], 'edit') !== false)
                        {
                            $reff = $_SERVER['HTTP_REFERER'] .'&tab='. $post['formid'] . '#' . $post['callback'];
                        }
                        else
                        {
                            $reff=strtok($_SERVER['HTTP_REFERER'],'?') . '?tab='. $post['formid'] . '#' . $post['callback'];
                        }

                        header("Location: " . $reff);

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

                include 'ums/accounts/function_SearchNetworks.php';
                include 'ums/accounts/function_SearchAccount.php';

                /*$notifs=SQLselect(
                            array(
                                'table'=>'notifications_app'
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
                }*/
                $Account=SearchAccount($resultado);
                NewLogin(array(
                    'type'=>'email',
                    'account'=>$Account['id'],
                    'form_id'=>$post['formid'],
                    'url'=>strtok($_SERVER['HTTP_REFERER'],'?')
                ));
                $_SESSION['logged']=$Account;
                $_SESSION['logged']['login']='email';

                if ($post['autologin']) 
                {
                    setcookie("token",$_SESSION['logged']['token_hash'],time()+7776000,"/", UMSDOMAIN);
                }

                if (strpos($post['callback'], '/app/') !== false) 
                {
                    $reff = strtok($_SERVER['HTTP_REFERER'],'?') . '#'.$post['callback'];
                }
                elseif(strpos($post['callback'], 'edit') !== false)
                {
                    $reff = $_SERVER['HTTP_REFERER'] .'&tab='. $post['formid'] . '#' . $post['callback'];
                    
                }
                else
                {
                    $reff= strtok($_SERVER['HTTP_REFERER'],'?') .'?tab='. $post['formid'] . '#' . $post['callback'];
                }

               header("Location: " .  $reff);
            }
            else
            {
                $response['alert'] = array('warning'=>'La contraseña no es correcta.');
                $response['feedback']['useremail']   = 'valid';
                $response['feedback']['userpass']   = 'invalid';

                ErrorLogin(array(
                'type'=> 'email', 
                'error'=> 'La contraseña no es correcta.',
                'form_id'=> $post['formid'],
                'url'=> strtok($_SERVER['HTTP_REFERER'],'?')
                ));
            }
        }
        else
        {
            $response['alert'] = array('danger'=>'Usuario no registrado. Crea tu cuenta <b>GRATIS!</b>');
            $response['feedback']['useremail']   = 'invalid';
            $response['feedback']['userpass']   = 'invalid';

            ErrorLogin(array(
                'type'=> 'email', 
                'error'=> 'Usuario no registrado.',
                'form_id'=> $post['formid'],
                'url'=> strtok($_SERVER['HTTP_REFERER'],'?')
                ));
        }
    }

    return $response;
}
function Recovery($post= array())
{
    if(!isset($_SESSION['logged']))
    {
        require 'ums/accounts/function_SendEmail.php';
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
        if($resultado && Send_email('recovery',$resultado))
        {
            $response['alert'] = array('success'=>'Se ha enviado tu contraseña por correo, verifica tu bandeja y correos no deseados.');   
        }
        else
        {
            $response['alert'] = array('danger'=>'Usuario no registrado. Crea tu cuenta <b>GRATIS!</b>');
            $response['feedback']['useremail']   = 'invalid';
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