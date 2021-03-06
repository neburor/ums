<?php
#Reply


$route = explode(":", $dataForm['route']);
if($dataForm['message'])
{
    $InsertarMensaje=SQLinsert(
            array(
                'table'=>'messages'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> $dataForm['domain'],
                'device'=> $_SESSION['device']['id'],
                'url'=> 'http://ums.hostingmex.com.mx',
                'form'=> $dataForm['formtype'], 
                'from_id'=> $_SESSION['id'], 
                'to_id'=> $dataForm['toid'],
                'message'=> $dataForm['message'],
                'status'=> '1'
                )
            );

        if($InsertarMensaje)
        {
            $messages=SQLselect(
                array(
                    'table'=>'messages',
                    'order'=>'ASC',
                    'limit'=>' '
                    ),
                array(
                    'from_id'=>$dataForm['toid'],
                    'status'=>'0'
                    )
                );

            $archive=SQLupdate(
                array(
                    'table'=>'messages',
                    'limit'=>' '
                    ),
                array(
                    'from_id'=>$dataForm['toid'],
                    'status'=>'0'
                    ),
                array(
                    'status'=>'1'
                    )
                );
            $notif=SQLinsert(
                array(
                    'table'=>'notifications_app'
                    ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> $dataForm['domain'],
                    'from_id'=> $_SESSION['id'], 
                    'to_id'=> $dataForm['toid'],
                    'asset'=> 'message', 
                    'asset_id'=> $InsertarMensaje,
                    'status'=> '0'
                    )
                );

            if($archive && $notif){
                $from=SQLselect(
                    array(
                    'table'=>'accounts',
                    'query'=>"SELECT 
                        accounts.`name`,
                        accounts_sn.`pic` AS `pic`
                        FROM `accounts` 
                        INNER JOIN `accounts_sn`
                            ON accounts.`id` = accounts_sn.`account` 
                            AND accounts.`pic` = accounts_sn.`network`
                        WHERE accounts.`id` = '".$dataForm['toid']."'
                        LIMIT 1"
                        )
                );

                include 'function_SendEmail.php';
                $response=Send_email(
                            array(
                                'asset'     => 'message',
                                'asset_id'  => $InsertarMensaje,
                                'template'  => 'message_reply',
                                'notifapp'  => $notif,
                                'domain'    => $dataForm['domain'],
                                'id'        => $dataForm['toid'],
                                'message'   => $dataForm['message'],
                                'name'      => $from[0]['name'],
                                'pic'       => $from[0]['pic'],
                                'messages'  => $messages
                                )
                            );       
            }elseif(!$archive){

                $response['alert']['warning']='No archivado.';
            }elseif(!$notif)
            {
                $response['alert']['warning']='Notificacion no generada.';
            }
        }else{
            $response['alert']['warning']='No se guardo el mensaje.';
        }

}
if($dataForm['comment'])
{
    include 'function_SendEmail.php';
    $response='';

    if($route[3]==0 && $route[4]==0)
    {
        $in_id=$route[0];
        $to_comm=$route[0];
    }
    else
    {
        $in_id=$route[4];
        $to_comm=$route[3];
    }

    $comment=SQLselect(
                array(
                    'table'=>'comments',
                    'limit'=>'LIMIT 1'
                    ),
                array(
                    'id'=>$route[0]
                    )
            );
    if($comment['comment']!=$dataForm['comment'])
    {
        $edit=SQLupdate(
                array(
                    'table'=>'comments'
                    ),
                array(
                    'id'=>$route[0],
                    'status'=>'0'
                    ),
                array(
                    'comment'=>$dataForm['comment'],
                    'status'=>'3'
                    )
                );
        if($edit)
        {
            $response.='Comentario editado. ';
        }
        $edit_comment=$dataForm['comment'];
    }

    if($dataForm['reply']!='')
    {
        if($dataForm['publish']=='false')
        {
            $ReplyStatus='4';
            $CommentStatus='4';
        }
        else
        {
            $ReplyStatus='2';
            $CommentStatus='1';
        }

        $InsertarComentario=SQLinsert(
            array(
                'table'=>'comments'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> $dataForm['domain'],
                'device'=> $_SESSION['device']['id'],
                'url'=> $dataForm['url'],
                'form'=> $dataForm['formtype'], 
                'from_id'=> $_SESSION['id'], 
                'to_id'=> $route[1], 
                'in_id'=> $in_id,
                'to_comm'=> $to_comm,
                'comment'=> $dataForm['reply'],
                'status'=> $ReplyStatus
                )
            );
        if($InsertarComentario)
        {
                $active=SQLupdate(
                array(
                    'table'=>'comments'
                    ),
                array(
                    'id'=>$route[0],
                    'status'=>'0'
                    ),
                array(
                    'status'=>$CommentStatus
                    )
                );
            

            
             $notifapp=SQLinsert(
                array(
                    'table'=>'notifications_app'
                    ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> $dataForm['domain'],
                    'from_id'=> $_SESSION['id'], 
                    'to_id'=> $route[1],
                    'asset'=> 'comment', 
                    'asset_id'=> $InsertarComentario,
                    'status'=> '0'
                    )
                );
            if($notifapp)
            {
                
                $from=SQLselect(
                    array(
                    'table'=>'accounts',
                    'query'=>"SELECT 
                        accounts.`name`,
                        accounts_sn.`pic` AS `pic`,
                        (select `comment` from `comments` where `id`= ".$route[0].") 
                        AS `comment`
                        FROM `accounts` 
                        INNER JOIN `accounts_sn`
                            ON accounts.`id` = accounts_sn.`account` 
                            AND accounts.`pic` = accounts_sn.`network`
                        WHERE accounts.`id` = '".$route[1]."'
                        LIMIT 1"
                        )
                );

                
                $response.=Send_email(
                            array(
                                'asset'     => 'comment',
                                'asset_id'  => $InsertarComentario,
                                'template'  => 'comment_reply',
                                'notifapp'  => $notifapp,
                                'domain'    => $dataForm['domain'],
                                'id'        => $route[1],
                                'url'       => $dataForm['url'],
                                'title'     => $dataForm['title'],
                                'name'      => $from[0]['name'],
                                'pic'       => $from[0]['pic'],
                                'comment'   => $from[0]['comment'],
                                'edit_comment'=> $edit_comment,
                                'from_name' => 'admin',
                                'from_pic'  => 'admin',
                                'from_comment'=> $dataForm['reply']
                            )
                );
                       
            }elseif(!$active){
                $response.='Comentario no activado. ';
            }elseif(!$notif)
            {
                $response.='Notificacion no generada. ';
            }
        }
        else
        {
            $response.='No se guardo el comentario. ';
        }
    }
    elseif(!isset($edit_comment))
    {
        $active=SQLupdate(
                array(
                    'table'=>'comments'
                    ),
                array(
                    'id'=>$route[0],
                    'status'=>'0'
                    ),
                array(
                    'status'=>'1'
                    )
                );
        $response.='Comentario activado sin respuesta. ';
    }
        
    if($route[3]!=0)
    {
        $notifapp=SQLinsert(
                    array(
                        'table'=>'notifications_app'
                        ),
                    array(
                        'datetime'=> date("Y-m-d H:i:s"),
                        'domain'=> $dataForm['domain'],
                        'from_id'=> $route[1], 
                        'to_id'=> $route[2],
                        'asset'=> 'comment', 
                        'asset_id'=> $route[0],
                        'status'=> '0'
                        )
                );
            
        $to=SQLselect(
                    array(
                        'table'=>'accounts',
                        'query'=>"SELECT 
                            accounts.`name`,
                            accounts_sn.`pic` AS `pic`,
                            (select `comment` from `comments` where `id`= ".$route[3].") 
                            AS `comment`
                            FROM `accounts` 
                            INNER JOIN `accounts_sn`
                                ON accounts.`id` = accounts_sn.`account` 
                                AND accounts.`pic` = accounts_sn.`network`
                            WHERE accounts.`id` = '".$route[2]."'
                            LIMIT 1"
                        )
                );

        $from=SQLselect(
                    array(
                        'table'=>'accounts',
                        'query'=>"SELECT 
                            accounts.`name`,
                            accounts_sn.`pic` AS `pic`,
                            (select `comment` from `comments` where `id`= ".$route[0].") 
                            AS `comment`
                            FROM `accounts` 
                            INNER JOIN `accounts_sn`
                                ON accounts.`id` = accounts_sn.`account` 
                                AND accounts.`pic` = accounts_sn.`network`
                            WHERE accounts.`id` = '".$route[1]."'
                            LIMIT 1"
                        )
                );

        $response.=Send_email(
                            array(
                                'asset'     => 'comment',
                                'asset_id'  => $route[0],
                                'template'  => 'comment_reply',
                                'notifapp'  => $notifapp,
                                'domain'    => $dataForm['domain'],
                                'id'        => $route[2],
                                'url'       => $dataForm['url'],
                                'title'     => $dataForm['title'],
                                'name'      => $to[0]['name'],
                                'pic'       => $to[0]['pic'],
                                'comment'   => $to[0]['comment'],
                                'from_name' => $from[0]['name'],
                                'from_pic'  => $from[0]['pic'],
                                'from_comment'=> $from[0]['comment']
                                )
                );
    } 
        
}
echo json_encode($response);