<?php
//Update Network
function UpdateNetwork ($id,$params)
{
	$resultado=SQLupdate(
            array(
                'table'=>'accounts_sn'
                ),
            array(
                'id'=>$id
                ),
            array(
            	'pic'=>$params['network']['pic'],
            	'cover'=>$params['network']['cover']
            	)
            );
}