<?php
#emails

$resultado=SQLupdate(
        array(
            'table'=>'emails'
            ),
        array(
            'id'=>$_GET['email'],
            'click'=>'0000-00-00 00:00:00'
            ),
        array(
            'click'=> date("Y-m-d H:i:s")
            )
        );
