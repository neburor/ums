<?php
//Update Network
function UpdateNetwork ($id)
{
	$resultado=SQLupdate(
            array(
                'table'=>'accounts_sn'
                ),
            array(
                'id'=>$id
                ),
            array(
            	'pic'=>$_SESSION['connect']['pic'],
            	'cover'=>$_SESSION['connect']['cover']
            	)
            );
}