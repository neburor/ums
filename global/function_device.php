<?php
//Devices

function NewDevice ()
{
    $device_hash = md5($_SERVER['REQUEST_TIME_FLOAT']);
    setcookie("device",$device_hash,time()+7776000,"/", UMSDOMAIN);
    if(isset($_COOKIE['device']))
    {
        $resultado=SQLinsert(
            array(
                'table'=>'devices'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device_hash'=> $device_hash,
                'user_agent'=> $_SERVER['HTTP_USER_AGENT'], 
                'remote_addr'=> $_SERVER['REMOTE_ADDR'], 
                'request_uri'=> $_SERVER['REQUEST_URI']
                )
            );
        if($resultado)
        {
            $_SESSION['device']['id']=$resultado;
            $_SESSION['device']['hash']=$device_hash;
        }
    }
    
}
function SearchDevice ()
{
    $resultado=SQLselect(
            array(
                'table'=>'devices',
                'limit'=>'LIMIT 1'
                ),
            array(
                'domain'=>UMSDOMAIN,
                'device_hash'=> $_COOKIE['device']
                )
            );
    if($resultado)
    {
        $_SESSION['device']['id']=$resultado['id'];
        $_SESSION['device']['hash']=$resultado['device_hash'];
    }
    else
    {
        NewDevice ();
    }

}
// function NewDevice ()
// {
//     $device_hash = md5($_SERVER['REQUEST_TIME_FLOAT']);
//     $resultado=SQLinsert(
//             array(
//                 'table'=>'devices'
//                 ),
//             array(
//                 'datetime'=> date("Y-m-d H:i:s"),
//                 'domain'=> UMSDOMAIN,
//                 'device_hash'=> $device_hash,
//                 'user_agent'=> $_SERVER['HTTP_USER_AGENT'], 
//                 'remote_addr'=> $_SERVER['REMOTE_ADDR'], 
//                 'request_uri'=> $_SERVER['REQUEST_URI']
//                 )
//             );
//     if($resultado)
//     {
//         $_SESSION['device']['id']=$resultado;
//         $_SESSION['device']['hash']=$device_hash;
//         setcookie("device",$device_hash,time()+7776000,"/", UMSDOMAIN);
//     }
// }
// function SearchDevice ()
// {
//     $resultado=SQLselect(
//             array(
//                 'table'=>'devices',
//                 'limit'=>'LIMIT 1'
//                 ),
//             array(
//                 'domain'=>UMSDOMAIN,
//                 'device_hash'=> $_COOKIE['device']
//                 )
//             );
//     if($resultado)
//     {
//         $_SESSION['device']['id']=$resultado['id'];
//         $_SESSION['device']['hash']=$resultado['device_hash'];
//     }

// }