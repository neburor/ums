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
        'url'           => 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
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

function DB($post=array(), $formtype)
{
    global $DB;
    $db['name']=$DB[$formtype]['dbname'];
    $db['alert']['success']=$DB[$formtype]['success'];
    $db['alert']['warnning']=$DB[$formtype]['warning'];
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