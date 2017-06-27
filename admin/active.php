<?php
#Archive
$data = explode(":", $dataForm['content']);
if($data[0]=='message')
{
	$result=SQLupdate(
            array(
                'table'=>'messages',
                'limit'=>' '
                ),
            array(
                'from_id'=>$data[1],
                'status'=>'0'
                ),
            array(
                'status'=>'1'
                )
            );
    if($result)
    {
         $response['alert']['warning']='Se activo el mensaje.';
    }
    else
    {
         $response['alert']['warning']='No se activo el mensaje.';
    }
}
elseif($data[0]=='comment')
{
 
        $active=SQLupdate(
            array(
                'table'=>'comments'
                ),
            array(
                'id'=>$data[1],
                'status'=>'0'
                ),
            array(
                'status'=>'1'
                )
            );
       
        if($data[2] && $data[3])
        {
            $notif=SQLinsert(
                array(
                    'table'=>'notifications_app'
                    ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> $dataForm['domain'],
                    'from_id'=> $data[2], 
                    'to_id'=> $data[3],
                    'asset'=> 'comment', 
                    'asset_id'=> $data[1],
                    'status'=> '0'
                    )
                );

            $notifs=SQLselect(
            array(
                'table'=>'accounts_notif',
                'limit'=>'LIMIT 1'
                ),
            array( 
                'account'=>$data[3],
                'type'=>'email'
                )
            );
            if($notifs['status']=='1')
            {

                $from=SQLselect(
            array(
                'table'=>'accounts',
                'query'=>"SELECT 
    accounts.`name`,
    accounts_sn.`pic` AS `pic`,
    (select `comment` from `comments` where `id`= ".$data[1].") 
 AS `comment`
    FROM `accounts` 
        INNER JOIN `accounts_sn`
            ON accounts.`id` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
    WHERE accounts.`id` = '".$data[2]."'
    LIMIT 1"
                )
            );
            /*    $to=SQLselect(
            array(
                'table'=>'accounts',
                'query'=>"SELECT 
    accounts.`name`,
    accounts_sn.`pic` AS `pic`
    FROM `accounts` 
        INNER JOIN `accounts_sn`
            ON accounts.`id` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
    WHERE accounts.`id` = '".$data[3]."'
    LIMIT 1"
                )
            );*/

                $page = explode(",", $dataForm['source']);

                include 'function_SendEmail.php';
                if(Send_email('reply',array(
                                'domain'    => $dataForm['domain'],
                                'id'        => $data[3],
                                'email'     => $notifs['notif'],
                                'url'       => $page[0],
                                'title'     => $page[1],
                                'from_name' => $from[0]['name'],
                                'from_pic'  => $from[0]['pic'],
                                'from_comment'=> $from[0]['comment'],
                                'url_reply' => $page[0].'?replycomment='.$data[1].'#comment_'.$data[1]
                            )))
                {
                    $response['alert']['success']='Se envio correo.';
                }
                else
                {
                    $response['alert']['warning']='No se envio el correo.';
                }
            }
            else
            {
                $response['alert']['warning']='No esta confirmado el correo.';
            }
            
        }
        else
        {
            $response['alert']['success']='Se activo el comentario.';
        }

}
echo json_encode($response);