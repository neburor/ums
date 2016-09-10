<?php
//HASH
function AddHash($id)
{
	$token_hash = substr(md5($_SERVER['REQUEST_TIME'].$id), 0,18);
	$user_hash = strtoupper(substr(md5($id.$_SERVER['REQUEST_TIME']), 0,6));
 $update="
        UPDATE `accounts`
        SET `timestamp`	= NULL,
        	`token_hash` = '".$token_hash."',
        	`user_hash` = '".$user_hash."' 
        WHERE `id` = '".$id."'
        LIMIT 1";
}