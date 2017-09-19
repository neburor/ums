<?php
#Sharer
session_start();

include '../mysql_db.php';
require '../config.php';

$resultado=SQLinsert(
            array(
                'table'=>'tracking_clicks'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'],
                'account'=> $_SESSION['logged']['id'],
                'url'=> strtok($_SERVER['HTTP_REFERER'],'?'),
                'source'=>$_GET['source'],
                'click'=>$_GET['click'],
                'btn'=>$_GET['btn']
                )
            );

if($resultado)
{
	header("Location: ".$_GET['url']);
}