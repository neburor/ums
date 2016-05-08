<?php 
#Profiles
function profiles ($params = array()) 
{
    $params = array_merge(array(
        'domain'    => null,
        'token'     => null,
        'device'    => null,
        'funnel'    => null,
        'email'     => null
    ), $params);

    if($params['funnel']==null && !$params['action'])//Si no mandan funnel, y no hay action(Signup,Login) se le asigna el primer paso
    {
        $params['funnel']='logon';
    }

    if($params['token']!=null || $params['device']!=null || $params['email']!=null) //Se procede a buscar
    {
        if($params['token']!=null)//Prioridad para token al buscar perfil
        {
            $profile=profile_search('token',$params);
        }
        elseif($params['device']!=null)//Buscar por device
        {
            $profile=profile_search('device',$params);

            if($params['email'] && $profile['email']!=$params['email'])//Si los email son distintos
            {
                $profile=profile_search('email',$params);
            }
        }
        else//Buscar por email si no hay token ni device
        {
            $profile=profile_search('email',$params);
        }

        if($profile) 
        {   
            if($profile['status']!='new')//Si hay perfil y que no sea nuevo, se actualiza su informacion
            {
                if(!$params['action'])
                {
                    device($profile['id'],$params);//Si no hay device, se crea, si hay se registra la actividad
                }
                
                $update=funnel($params,$profile);// Verificar si hay que actualizar con respecto del funnel
        
                if($update)
                {   
                    if(profile_update($update,$profile['id']))//Actualizar el perfil
                    {

                        $profile['status']="update";
                    }  
                }
            }    
        }
    }
    else //No hay elementos para buscar, se crea uno 
    {
        $profile=profile_new(array(
                    'domain'        => $params['domain'],
                    'funnel'        => $params['funnel']
                    ));
    }
    return $profile;
}
function profile_search ($search,$params = array())
{
    if($search=='twitter')
    {
        $search_param="`twitter_id` = '".$params['id']."' LIMIT 1";
    }
    if($search=='facebook')
    {
        $search_param="`facebook_id` = '".$params['id']."' LIMIT 1";
    }
    if($search=='token')
    {
        $search_param="`token_hash` = '".$params['token']."' LIMIT 1";
    }
    if($search=='device')
    {
        $device_id=device(false,$params);
        $sql=mysql_query("
        SELECT * FROM `device_activity` 
        WHERE `device_id` = '".$device_id."' 
        ORDER BY `id` DESC LIMIT 1");

        $row = array();
        
        while($i = mysql_fetch_assoc($sql)) 
        {
            $row[] = $i;
        }

        $search_param="`id` = '".$row[0]['profile_id']."'";
        
    }
    if($search=='email')
    {
        $search_param="`email` = '".$params['email']."'";
    }
    $sql=mysql_query("
        SELECT * FROM `profiles` 
        WHERE `domain` = '".$params['domain']."' 
        AND ".$search_param."");
    $row = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $row[] = $i;
    }

    if(count($row)==1)
    {
        $row[0]['search']=$search;
    }
    elseif(count($row)==0 && $search=='email' && !$params['action'])
    {   
         $row[0]=profile_new($params);
    }
    return $row[0];
}
function profile_update ($updates=array(),$profile_id)
{
    $count=0;
    $sets ='';

    foreach ($updates as $column => $value) 
    {
        $count++;
        if($count>1)
        {
            $sets.= ', ';
        }

        $sets.='`'.$column.'` = "'.$value.'"'; 
    }

    $update="
        UPDATE `profiles`
        SET ".$sets." 
        WHERE `id` = '".$profile_id."'
        LIMIT 1";

    if(mysql_query($update))
    {
        return true;
    }
    else
    {
        return false;
    }
}
function profile_new ($params = array())
{
    $token = strtoupper(substr(md5($_SERVER['REQUEST_TIME']), 0,12));
    $insert="
        INSERT INTO `profiles` 
        (`id`, `creation_date`, `domain`, `token_hash`, `funnel`, `name`, `email`, `password`, `facebook_id`, `twitter_id`) 
        VALUES (NULL, '".date("Y-m-d H:i:s")."', '".$params['domain']."', '".$token."','".$params['funnel']."', '".$params['name']."', '".$params['email']."', '".$params['pass']."', '".$params['facebook_id']."', '".$params['twitter_id']."')";

    if(mysql_query($insert))
    {
        $params['id']=mysql_insert_id();
        device($params['id'],$params);// Registro actividad en device
        funnel_activity($params);

        $sql=mysql_query("
            SELECT * FROM `profiles` 
            WHERE `domain` = '".$params['domain']."' 
            AND `id` = '".$params['id']."'
            LIMIT 1");

        $row = array();
        
        while($i = mysql_fetch_assoc($sql)) 
        {
            $row[] = $i;
        }   
        
        $profile=$row[0];
        $profile['status']='new';
    }

    return $profile;
}
function device ($profile_id,$params=array())
{
    if(!$params['device'] || $params['device']=='') // si no hay device, se crea uno
    {   
        $params['device'] = md5($_SERVER['REQUEST_TIME_FLOAT']);
        $insert="
        INSERT INTO `devices` 
        (`id`, `creation_date`, `domain`, `device_hash`, `user_agent`, `remote_addr`, `request_uri`) 
        VALUES (NULL, '".date("Y-m-d H:i:s")."', '".$params['domain']."', '".$params['device']."', '".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['REQUEST_URI']."') ";
        if(mysql_query($insert))
        {
            $device_id=mysql_insert_id();
            setcookie("device",$params['device'],time()+7776000,"/", UMSDOMAIN);
        }
    }
    elseif($params['device'])// Si hay device, se busca su id
    {
        $sql=mysql_query("
            SELECT * FROM `devices` 
            WHERE `device_hash` = '".$params['device']."'
            LIMIT 1");

        $row = array();
        
        while($i = mysql_fetch_assoc($sql)) 
        {
            $row[] = $i;
        }

        if(count($row)==1)
        {
            $device_id=$row[0]['id'];
        }
    }
    
    if($profile_id && $device_id)// Si hay profile y device IDs, se registra actividad
    {
        $sql=mysql_query("
        SELECT * FROM `device_activity` 
        WHERE `device_id` = '".$device_id."' 
        ORDER BY `id` DESC LIMIT 1");

        $row = array();
        
        while($i = mysql_fetch_assoc($sql)) 
        {
            $row[] = $i;
        }

        if($profile_id!=$row[0]['profile_id'])
        {
            $insert="
                INSERT INTO `device_activity` 
                (`id`, `creation_date`, `domain`, `profile_id`, `device_id`) 
                VALUES (NULL, '".date("Y-m-d H:i:s")."', '".$params['domain']."', '".$profile_id."', '".$device_id."')";
            mysql_query($insert);
        }
        
    }
    return $device_id;  
}
function funnel ($params=array(),$profile=array())
{
    if($params['funnel']!='login')
    {
        if($params['funnel']!='signin')
        {
            if($params['funnel']!='signup')
            {
                if($params['funnel']!='signon')
                {
                    if($params['funnel']!='logon')
                    {

                    }
                    else
                    {
                        $update['funnel']='logon';
                        if($params['name'] && $profile['name']=='')
                        {
                            $update['name']=$params['name'];
                        }
                        if($params['email'] && $profile['email']=='')
                        {
                            $update['email']=$params['email'];
                        }
                    }
                }
                elseif ($profile['funnel']!='signon') 
                {
                     $update['funnel']='signon';
                    if($params['name'] && $profile['name']=='')
                    {
                        $update['name']=$params['name'];
                    }
                    if($params['email'] && $profile['email']=='')
                    {
                        $update['email']=$params['email'];
                    }
                    if($params['pass'] && $profile['password']=='')
                    {
                        $update['password']=$params['pass'];
                    }
                }
            }
            elseif ($profile['funnel']!='signup') 
            {
                $update['funnel']='signup';
                if($params['name'] && $profile['name']=='')
                {
                    $update['name']=$params['name'];
                }
                if($params['email'] && $profile['email']=='')
                {
                    $update['email']=$params['email'];
                }
                if($params['pass'])
                {
                    $update['password']=$params['pass'];
                }
            }
        }
        elseif ($profile['funnel']!='signin') {
            $update['funnel']='signin';
        }
    }
    elseif ($profile['funnel']!='login') 
    {
        $update['funnel']='login';
    }

    if($update['funnel'])
    {
        $profile['funnel']=$params['funnel'];
        $fstate=funnel_activity($profile);
    }
    return $update;
}
function funnel_activity($profile=array())
{
    $insert="
        INSERT INTO `funnel_activity` 
        (`id`, `creation_date`, `domain`, `profile_id`, `funnel`) 
        VALUES (NULL, '".date("Y-m-d H:i:s")."', '".$profile['domain']."', '".$profile['id']."', '".$profile['funnel']."')";

    if(mysql_query($insert))
    {
        $response=true;
    }
    else 
    {
        $response=false;
    }

    return $response;
}