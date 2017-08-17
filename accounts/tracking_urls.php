<?php
//Tracking Urls
if(isset($_SESSION['device']))
    {
        $resultado=SQLinsert(
            array(
                'table'=>'tracking_urls'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'],
                'account'=> $_SESSION['logged']['id'],
                'url'=> 'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'),
                )
            );
    }