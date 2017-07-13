<?php
#Reply


$route = explode(":", $dataForm['route']);
if($dataForm['message'])
{
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
           
    if($archive)
    {
        include 'function_SendEmail.php';
        
        $response=Send_email(
                    array(
                        'asset'     => 'message',
                        'asset_id'  => $dataForm['toid'],
                        'template'  => 'response_email',
                        'domain'    => $dataForm['domain'],
                        'id'        => $dataForm['toid'],
                        'response'  => $dataForm['response']
                        )
                    );       
    }elseif(!$archive){
        $response['alert']['warning']='No archivado.';
    } 
}
if($dataForm['comment'])
{
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
                'comment'=> $dataForm['comment'],
                'status'=> '1'
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
                    'status'=>'2'
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
            if($active && $notifapp)
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

                include 'function_SendEmail.php';
                $response=Send_email(
                            array(
                                'asset'     => 'comment',
                                'asset_id'  => $InsertarComentario,
                                'template'  => 'reply',
                                'notifapp'  => $notifapp,
                                'domain'    => $dataForm['domain'],
                                'id'        => $route[1],
                                'url'       => $dataForm['url'],
                                'title'     => $dataForm['title'],
                                'name'      => $from[0]['name'],
                                'pic'       => $from[0]['pic'],
                                'comment'   => $from[0]['comment'],
                                'from_name' => 'admin',
                                'from_pic'  => 'admin',
                                'from_comment'=> $dataForm['comment']
                            )
                );
                       
            }elseif(!$active){

                $response['alert']['warning']='Comentario no activado.';
            }elseif(!$notif)
            {
                $response['alert']['warning']='Notificacion no generada.';
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
                                'template'  => 'reply',
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
        else
        {
            $response['alert']['warning'].='No se guardo el comentario.';
        }
}
echo json_encode($response);