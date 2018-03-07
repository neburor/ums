<?php
#Email click tracking
//[0]Type:[1]tokenhash:[2]emailid:[3]notifid:[4]assetid
$route = explode(":", $_GET['email']);

if( strlen($route[1])==18 && 
    preg_match('#^[a-zA-Z0-9]*$#',$route[1]))
    {
        if(!isset($_SESSION['logged']))
        {
            $confirmToken=SQLselect(
                array(
                    'table'=>'accounts',
                    'limit'=>'LIMIT 1'
                    ),
                array(
                    'token_hash'=>$route[1]
                    )
                );
        }
        else
        {
            $confirmToken=$_SESSION['logged'];
        }
        if($confirmToken && $confirmToken['token_hash']==$route[1])
        {
            if($route[0]=='open')
            {
                $update=SQLupdate(
                    array(
                        'table'=>'emails',
                        ),
                    array(
                        'id'=>$route[2],
                        'account'=>$confirmToken['id'],
                        'open'=>'0000-00-00 00:00:00'
                        ),
                    array(
                        'open'=>date("Y-m-d H:i:s")
                        )
                );
                if($route[3]=='confirmation')
                {
                    $update=SQLupdate(
                        array(
                            'table'=>'accounts_notif'
                            ),
                        array(
                            'account'=>$confirmToken['id'],
                            'status'=>'0'
                            ),
                        array(
                            'status'=>'2'
                            )
                    );

                    if(isset($_SESSION['logged']) && $_SESSION['logged']['id']==$confirmToken['id'])
                    {
                        $_SESSION['logged']['notifs']['email']['status']='2';
                    }   
                }
            header("Location: ".URLTHEME."pixel.jpg");
            }
            else
            {
                $update=SQLupdate(
                    array(
                        'table'=>'emails',
                        ),
                    array(
                        'id'=>$route[2],
                        'account'=>$confirmToken['id'],
                        'click'=>'0000-00-00 00:00:00'
                        ),
                    array(
                        'click'=>date("Y-m-d H:i:s")
                        )
                );

                if($route[0]=='confirmation')
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
                if($route[0]=='comment')
                {
                    $_SESSION['feedback']['commentreply']=$route[4];
                }
                if($route[0]=='message')
                {
                    $_SESSION['feedback']['messagereply']=$route[4];
                }

                if(isset($route[3]) && $route[3]!=0)
                {
                    NotifApp(
                            array(
                                'to_id'=>$confirmToken['id'],
                                'id'=>$route[3]
                                )
                            );
                }
            }  
        }
    }