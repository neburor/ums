<?php
#Email click tracking

$route = explode(":", $_GET['app']);

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

            if($route[0]=='comment')
            {
                $_SESSION['feedback']['commentreply']=$route[3];
            }
            if($route[0]=='message')
            {
                $_SESSION['feedback']['messagereply']=$route[3];
            }

            if(isset($route[2]) && $route[2]!=0)
            {
                NotifApp(
                    array(
                        'to_id'=>$confirmToken['id'],
                        'id'=>$route[2]
                        )
                    );
            }    
        }
    }