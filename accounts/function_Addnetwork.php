<?php
// AddNetwork

function AddNetwork ($id,$params)
{
    
    $resultado=SQLinsert(
            array(
                'table'=>'accounts_sn'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'account'=> $id,
                'network'=> $params['net'], 
                'network_id'=> $params['id'], 
                'name'=> $params['name'],
                'email'=> $params['email'],
                'screenname'=> $params['screenname'],
                'url'=> $params['url'],
                'pic'=> $params['pic'],
                'cover'=> $params['cover'],
                'cover_y'=> $params['cover_y'],
                'cover_x'=> $params['cover_y']
                )
            );
    if($resultado)
    {
         return SearchNetworks($id);
    }
   
}
/*
function AddNetwork ($id)
{
    global $mysqli;
    
    $sql="
        INSERT INTO `accounts_sn` 
        (`id`, `datetime`, `domain`,`account`, `network`, `network_id`, `name`, `email`, `screenname`, `url`, `pic`, `cover`, `cover_y`, `cover_x`) 
        VALUES 
        (NULL, '".date("Y-m-d H:i:s")."', '".UMSDOMAIN."', '".$id."', '".$_SESSION['connect']['network']."', '".$_SESSION['connect']['id']."', '".$_SESSION['connect']['name']."', '".$_SESSION['connect']['email']."', '".$_SESSION['connect']['screenname']."', '".$_SESSION['connect']['url']."', '".$_SESSION['connect']['pic']."', '".$_SESSION['connect']['cover']."', '".$_SESSION['connect']['cover_y']."', '".$_SESSION['connect']['cover_x']."')";

    if (!$resultado = $mysqli->query($sql)) 
    {
       if(isset($_SESSION['debugger']))
        {
            $_SESSION['debugger'][]='SQL:insert:accounts_sn:error | '.$mysqli->errno.':'.$mysqli->error;
        }
    }
    else
    {
        if(isset($_SESSION['debugger']))
        {
            $_SESSION['debugger'][]='SQL:insert:accounts_sn:ok';
        }

        return SearchNetworks($id);
    }
}
*/