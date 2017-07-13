<?php
#Email click tracking

$route = explode(":", $_GET['app']);


if($route[0]=='comment')
{
    $_SESSION['feedback']['commentreply']=$route[2];
}
if($route[0]=='message')
{
    $_SESSION['feedback']['messagereply']=$route[2];
}

if(isset($route[1]) && $route[1]!=0)
{
    NotifApp(
        array(
            'to_id'=>$_SESSION['logged']['id'],
            'id'=>$route[1]
            )
        );
}