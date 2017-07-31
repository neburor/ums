<?php
//Tracking Searchs
$resultado=SQLinsert(
            array(
                'table'=>'tracking_searchs'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'],
                'account'=> $_SESSION['logged']['id'],
                'url'=> strtok($_SERVER['HTTP_REFERER'],'?'),
                'query'=>$_GET['q']
                )
            );