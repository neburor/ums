<?php
//Functions Profile APP
function NotifApp($params=array())
{

	if(isset($_SESSION['logged']))
	{
        $resultado=SQLupdate(
            array(
                'table'=>'notifications_app'
                ),
            $params,
            array(
                'status'=>'1'
                )
            );
        if($resultado)
        {
            UpdateNotif();
        }
    }
}
function UpdateNotif()
{
    $resultado=SQLselect(
            array(
                'table'=>'notifications_app',
                'query'=>"
                SELECT 
                count(*) 
                FROM `notifications_app` 
                WHERE 
                `to_id`='".$_SESSION['logged']['id']."' 
                AND `status`='0'
                "
                )
            );
    $_SESSION['logged']['notifs_app']=$resultado[0]['count(*)'];
}