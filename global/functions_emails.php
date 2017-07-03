<?php
#Email click tracking

if(isset($_GET['confirmation'])){
    $route = explode(":", $_GET['confirmation']);
}elseif (isset($_GET['recovery'])) {
    $route = explode(":", $_GET['recovery']);
}

if( strlen($route[0])==18 && 
        preg_match('#^[a-zA-Z0-9]*$#',$route[0]) && 
        preg_match('#^[0-9]*$#',$route[1]))
    {
        $confirmToken=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1'
                ),
            array(
                'token_hash'=>$route[0]
                )
            );
        if($confirmToken && $confirmToken['token_hash']==$route[0])
        {
            $update=SQLupdate(
                    array(
                        'table'=>'emails',
                        ),
                    array(
                        'id'=>$route[1],
                        'account'=>$confirmToken['id'],
                        'click'=>'0000-00-00 00:00:00'
                        ),
                    array(
                        'click'=>date("Y-m-d H:i:s")
                        )
            );
        }

        if(isset($_GET['confirmation']))
        {
            $update=SQLupdate(
                array(
                    'table'=>'accounts_notif'
                    ),
                array(
                    'account'=>$confirmToken['id']
                    ),
                array(
                    'status'=>'1'
                    )
                );
            if($update)
            {
                $_SESSION['feedback']['top']['alerts']['success']=" Tu correo ha sido confirmado correctamente.";
            }
        }
    }
