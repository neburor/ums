<?php
#Conexion a Mysql DB
include 'databases.php';
include 'mysql_db.php';
include 'profiles.php';
include 'send_confirmation.php';
include 'file_upload.php';
MysqlConnect();

function Logout()
{
    if($_COOKIE['token'])
    {
        unset($_COOKIE['token']);
        setcookie('token', null, -1, '/', UMSDOMAIN);
    }
    if($_SESSION['profile'])
    {
        unset($_SESSION['profile']);
    }

    if(isset($_SESSION['profile']) || isset($_COOKIE['token']))
    {
        $response['alert']['danger'] = 'No se puede cerrar sesión, intente de nuevo.';
    }
    else
    {
        $response['alert']['success'] = 'Sesión cerrada correctamente.';
    }

    return $response;
}

function Login($post= array())
{
    $profile = profiles(array(  // Si no hay perfil identificado se busca o crea
                    'domain'    => UMSDOMAIN,
                    'device'    => $_COOKIE['device'],
                    'email'     => $post['useremail'],
                    'action'    => 'login'
                    ));

    if($profile['id'])
    {   
        if($post['userpass']==$profile['password'])
        {
            $response['alert'] = array('success'=>'Has iniciado sesion correctamente');
            $response['feedback']['useremail'] = 'valid';
            $response['feedback']['userpass'] = 'valid';
            if($post['referer'])
            {
                $response['alert']['success'].=', <a href="'.$post['referer'].'">Regresar</a>';
            }

            $_SESSION['profile']= profiles(array(
                                    'domain'    => UMSDOMAIN,
                                    'device'    => $_COOKIE['device'],
                                    'funnel'    => 'login',
                                    'email'     => $post['useremail']
                                    ));

            if ($post['autologin']) 
            {
                $token = $_SESSION['profile']['token_hash'];
                setcookie("token",$token,time()+7776000,"/", UMSDOMAIN);
            }
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

    return $response;
}

function Signup($post = array())
{
    
    if($post['autopass'] || ($post['pass']!='' && $post['pass']==$post['repass']))
    {
        if($post['autopass'])
        {
            $post['pass']=substr(md5(uniqid(rand())),0,4);
        }

        $profile = profiles(array(  // Si no hay perfil identificado se busca o crea
                    'domain'    => UMSDOMAIN,
                    'device'    => $_COOKIE['device'],
                    'name'      => $post['username'],
                    'email'     => $post['useremail'],
                    'action'    => 'signup'
                    ));
        
        if($profile['funnel']=='signup' || $profile['funnel']=='login')
        {
            $response['alert']=array('danger' => 'Esta cuenta ya esta registrada');
            $response['feedback']['username']  = 'invalid';
            $response['feedback']['useremail'] = 'invalid';
        }
        else
        {
            $profile = profiles(array(  // Si no hay perfil identificado se busca o crea
                    'domain'    => UMSDOMAIN,
                    'device'    => $_COOKIE['device'],
                    'funnel'    => 'signup',
                    'name'      => $post['username'],
                    'email'     => $post['useremail'],
                    'pass'      => $post['pass']
                    ));

            $response['alert']= array('success' => 'Gracias por registrarte, ya puedes iniciar sesion, no olvides confirmar tu correo.');
            if($post['autopass']=='on')
            {
                $response['alert']['success'].= '<br>Tu contraseña es <b>'.$post['pass'].'</b> ';
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
function Settings($post = array())
{
    if(!isset($_SESSION['profile']))
    {
        $response['alert'] = array('danger'=>'Usuario no registrado. Crea tu cuenta <b>GRATIS!</b>');
    }
    else
    {
        #$response['alert'] = array('info'=>'<pre>'.json_encode($post).'</pre>');
        unset($post['formid']);
        unset($post['formtype']);

        if($post['userpass'])
        {
            if($post['userpass']!=$_SESSION['profile']['password'])
            {
                $response['alert']=array('warning' => 'Escriba su contraseña actual.');
                $response['feedback']['userpass']   = 'invalid';
            }
            elseif ($post['pass']!=$post['repass']) 
            {
                $response['alert']=array('warning' => 'La confirmacion de la contraseña no es igual.');
                $response['feedback']['pass']   = 'valid';
                $response['feedback']['repass'] = 'invalid';
            }
            else
            {
                $update =profile_update(array('password'=>$post['pass']),$_SESSION['profile']['id']);
                if($update)
                {
                $response['alert']=array('success' => 'Su contraseña a sido modificada.');
                }
            }

        }
        elseif($post['pass'])
        {
            if($post['pass']!=$post['repass'])
            {
                $response['alert']=array('warning' => 'La confirmacion de la contraseña no es igual.');
                $response['feedback']['pass']   = 'valid';
                $response['feedback']['repass'] = 'invalid';
            }
            else
            {
                $update =profile_update(array('password'=>$post['pass']),$_SESSION['profile']['id']);
                if($update)
                {
                $response['alert']=array('success' => 'Su contraseña a sido asignada.');
                }
            }

        }
        elseif ($post['email']) 
        {
            if($post['email']!=$_SESSION['profile']['email'])
            {
                $update =profile_update(array('email'=>$post['email']),$_SESSION['profile']['id']);
                if($update)
                {
                $response['alert']=array('success' => 'Su correo a sido modificado, necesita confirmarlo.');
                }
            }
            elseif($_SESSION['profile']['notifs']['email']['status']!='valid')
            {
                $update = Send_confirmation();
                $response['alert']=array('info' => 'Le enviamos un correo para confirmarlo, hay que dar clic en el enlace de confirmación.');
            }
            else
            {
                $update = true;
                $response['alert']=array('info' => 'Su correo esta confirmado.');
            }
        }
        elseif($post['pic'] || $post['cover'])
        {
            if($post['pic'])
            {
                $text='Su imagen de perfil ha sido cambiado.';
                $update =profile_update(array('pic'=>str_replace('.png', '', $post['pic'])),$_SESSION['profile']['id']);
            }
            else
            {
                $text='Su imagen de portada ha sido modificada.';
                $update =profile_update(array('cover'=>str_replace('.png', '', $post['cover'])),$_SESSION['profile']['id']);
            }
            
                if($update)
                {
                $response['alert']=array('success' => $text);
                }
        }
        else
        {
            $update =profile_update($post,$_SESSION['profile']['id']); 
            $response['alert'] = array('success'=>'Los cambios han sido guardados.');
        }

    if($update)
    {
        foreach ($post as $key => $value) 
        {
            $_SESSION['profile'][$key]=str_replace('.png', '', $value);
            $response['feedback'][$key]= 'valid';
        }
        
    }
    else
    {
        $response['alert']['warning'].= ' No se han podido guardar los cambios.';
    }

    }

    return $response;
}


function Insert($post = array())
{   
    if($post['funnel']=='signon')
    {
        $post['pass']=substr(md5(uniqid(rand())),0,4);
    }
    if (!isset($_SESSION['profile']))  //Si no hay perfil
    {
        $profile = profiles(array(  // Si no hay perfil identificado se busca o crea
                    'domain'    => UMSDOMAIN,
                    'device'    => $_COOKIE['device'],
                    'funnel'    => $post['funnel'],
                    'name'      => $post['name'],
                    'email'     => $post['email'],
                    'pass'      => $post['pass']
                    ));
    }
    else
    {
        $profile['id']=$_SESSION['profile']['id'];
    }

    $post = array_merge(array(
        'creation_date' => date("Y-m-d H:i:s"),
        'domain'        => UMSDOMAIN,
        'url'           => 'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'),
        'profile_id'    => $profile['id']
        ), $post);

    $formtype=$post['formtype'];

    unset($post['token']);
    unset($post['device']);

    unset($post['formid']);
    unset($post['formtype']);

    unset($post['funnel']);
    unset($post['name']);
    unset($post['email']);
    unset($post['pass']);

    

    $db=DB($post,$formtype);

    $insert = '
    INSERT INTO `'.$db["name"].'`
    (`id`, '.$db["columns"].')
    VALUES (NULL,'.$db["values"].')
    ';
 
    if(mysql_query($insert))
    {
        $response['alert']['success'] = $db['alert']['success'];
    }
    else
    {
        $response['alert']['warning'] = $db['alert']['warning'];
    }

    return $response;
}

function Insert_chat($post = array())
{   
    if($post['funnel']=='signon')
    {
        $post['pass']=substr(md5(uniqid(rand())),0,4);
    }
    if (!isset($_SESSION['profile']))  //Si no hay perfil
    {
        $profile = profiles(array(  // Si no hay perfil identificado se busca o crea
                    'domain'    => UMSDOMAIN,
                    'device'    => $_COOKIE['device'],
                    'funnel'    => $post['funnel'],
                    'name'      => $post['name'],
                    'email'     => $post['email'],
                    'pass'      => $post['pass']
                    ));
    }
    else
    {
        $profile['id']=$_SESSION['profile']['id'];
    }
    if($profile['status']=='new')
    {
        $_SESSION['profile']=$profile;
    }

    $post = array_merge(array(
        'domain'        => UMSDOMAIN,
        'url'           => 'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'),
        'type'          => $post['formtype'],
        'from'          => $profile['id'],
        'to'            => 0,
        'date'          => date("Y-m-d H:i:s")
        ), $post);

    $formtype=$post['formtype'];

    unset($post['token']);
    unset($post['device']);

    unset($post['formid']);
    unset($post['formtype']);
    unset($post['callback']);

    unset($post['funnel']);
    unset($post['name']);
    unset($post['email']);
    unset($post['pass']);


    $db=DB($post);

    $insert = '
    INSERT INTO `chat`
    (`id`, '.$db["columns"].')
    VALUES (NULL,'.$db["values"].')
    ';
 
    if(mysql_query($insert))
    {
        $response['alert']['success'] = 'Gracias por contactarnos, pronto te responderemos';
    }
    else
    {
        $response['alert']['warning'] = 'Disculpa no se guardo tu mensaje, por favor intenta más tarde.';
    }

    return $response;
}
function Insert_comment($post = array())
{   
    if($post['funnel']=='signon')
    {
        $post['pass']=substr(md5(uniqid(rand())),0,4);
    }
    if (!isset($_SESSION['profile']))  //Si no hay perfil
    {
        $profile = profiles(array(  // Si no hay perfil identificado se busca o crea
                    'domain'    => UMSDOMAIN,
                    'device'    => $_COOKIE['device'],
                    'funnel'    => $post['funnel'],
                    'name'      => $post['name'],
                    'email'     => $post['email'],
                    'pass'      => $post['pass']
                    ));
    }
    else
    {
        $profile['id']=$_SESSION['profile']['id'];
    }

    $post = array_merge(array(
        'domain'        => UMSDOMAIN,
        'url'           => 'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'),
        'from'          => $profile['id'],
        'to'            => $post['replyto'],
        'form'          => $post['formtype'],
        'date'          => date("Y-m-d H:i:s")
        ), $post);

    $formtype=$post['formtype'];

    unset($post['token']);
    unset($post['device']);

    unset($post['formid']);
    unset($post['formtype']);
    unset($post['callback']);

    unset($post['funnel']);
    unset($post['name']);
    unset($post['email']);
    unset($post['pass']);
    unset($post['replyto']);


    $db=DB($post);

    $insert = '
    INSERT INTO `comments`
    (`id`, '.$db["columns"].')
    VALUES (NULL,'.$db["values"].')
    ';
 
    if(mysql_query($insert))
    {
        $response['alert']['success'] = 'Gracias por tu comentario.';
    }
    else
    {
        $response['alert']['warning'] = 'Disculpa no se guardo tu comentario, por favor intenta más tarde.';
    }

    return $response;
}
function Insert_likes($post = array())
{   
    if($post['funnel']=='signon')
    {
        $post['pass']=substr(md5(uniqid(rand())),0,4);
    }
    if (!isset($_SESSION['profile']))  //Si no hay perfil
    {
        $profile = profiles(array(  // Si no hay perfil identificado se busca o crea
                    'domain'    => UMSDOMAIN,
                    'device'    => $_COOKIE['device'],
                    'funnel'    => $post['funnel'],
                    'name'      => $post['name'],
                    'email'     => $post['email'],
                    'pass'      => $post['pass']
                    ));
    }
    else
    {
        $profile['id']=$_SESSION['profile']['id'];
    }
    if($profile['status']=='new')
    {
        $_SESSION['profile']=$profile;
    }

    $formtype=$post['formtype'];

    if($formtype=='like')
    {
        $like='1';
    }
    else
    {
        $like='-1';
    }

    $post = array_merge(array(
        'date'          => date("Y-m-d H:i:s"),
        'profile_id'    => $profile['id'],
        'type'          => $post['liketype'],
        'element'       => $post['likeid'],
        'like'          => $like
        ), $post);

    

    unset($post['token']);
    unset($post['device']);

    unset($post['formid']);
    unset($post['formtype']);
    unset($post['callback']);

    unset($post['funnel']);
    unset($post['name']);
    unset($post['email']);
    unset($post['pass']);

    unset($post['likeid']);
    unset($post['liketype']);

    $liked=Search_likes(array(  
                            'profile' => $profile['id'],
                            'type'    => $post['type'],
                            'element' => $post['element']
                            ));

    if($liked)
    {
        if($formtype=='like')
        {
            $updateLike=Update_likes(array(  
                            'id'    => $liked['id'],
                            'like'  => '1'
                            ));
        }
        else
        {
            $updateLike=Update_likes(array(  
                            'id'    => $liked['id'],
                            'like'  => '-1'
                            ));
        }

    }
    else
    {
        $db=DB($post);

        $insert = '
            INSERT INTO `likes`
            (`id`, '.$db["columns"].')
            VALUES (NULL,'.$db["values"].')
            ';
    }
    
 
    if(mysql_query($insert) || $updateLike)
    {
        $response['alert']['success'] = 'Gracias por participar.';
    }
    else
    {
        $response['alert']['warning'] = 'Disculpa no se guardo, por favor intenta más tarde.';
    }

    return $response;
}
function Update_likes($post=array())
{
    $update="
        UPDATE `likes`
        SET `like` = '".$post['like']."' 
        WHERE `id` = '".$post['id']."'
        LIMIT 1";

    return mysql_query($update);
}
function Search_likes($post=array())
{
    $sql=mysql_query("
        SELECT `id`,`like` FROM `likes` 
        WHERE `profile_id` = '".$post['profile']."'
        AND `type`    = '".$post['type']."'
        AND `element` = '".$post['element']."'
        ");
     $rows = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $rows[] = $i;
    }

    return $rows[0];
}
function DB($post=array())
{
    $count=0;
    $columns ='';
    $values ='';

    foreach ($post as $column => $value) 
    {
        $count++;
        if($count>1)
        {
            $columns.= ', ';
            $values.= ', ';
        }

        $columns.=' `'.$column.'`'; 
        $values.=" '" .$value."'"; 
    }

    $db['columns']=$columns;
    $db['values']=$values;

    return $db;
}