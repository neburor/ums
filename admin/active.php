<?php
#Active
$route = explode(":", $dataForm['content']);
if($route[0]=='message')
{
	$result=SQLupdate(
            array(
                'table'=>'messages',
                'limit'=>' '
                ),
            array(
                'from_id'=>$route[1],
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

if($route[0]=='comment')
{
    $active=SQLupdate(
            array(
                'table'=>'comments'
                ),
            array(
                'id'=>$route[1],
                'status'=>'0'
                ),
            array(
                'status'=>'1'
                )
    );
       
    if($route[2] && $route[3])
    {
        $notifapp=SQLinsert(
                array(
                    'table'=>'notifications_app'
                    ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> $dataForm['domain'],
                    'from_id'=> $route[2], 
                    'to_id'=> $route[3],
                    'asset'=> 'comment', 
                    'asset_id'=> $route[1],
                    'status'=> '0'
                    )
        );

        $from=SQLselect(
                array(
                'table'=>'accounts',
                'query'=>"SELECT 
                    accounts.`name`,
                    accounts_sn.`pic` AS `pic`,
                    (select `comment` from `comments` where `id`= ".$route[1].") 
                    AS `comment`
                    FROM `accounts` 
                    INNER JOIN `accounts_sn`
                        ON accounts.`id` = accounts_sn.`account` 
                        AND accounts.`pic` = accounts_sn.`network`
                    WHERE accounts.`id` = '".$route[2]."'
                    LIMIT 1"
                    )
        );
            
        $to=SQLselect(
                array(
                    'table'=>'accounts',
                    'query'=>"SELECT 
                        accounts.`name`,
                        accounts_sn.`pic` AS `pic`,
                        (select `comment` from `comments` where `id`= ".$route[4].") 
                        AS `comment`
                        FROM `accounts` 
                        INNER JOIN `accounts_sn`
                            ON accounts.`id` = accounts_sn.`account` 
                            AND accounts.`pic` = accounts_sn.`network`
                        WHERE accounts.`id` = '".$route[3]."'
                        LIMIT 1"
                        )
        );
        
        $page = explode(",", $dataForm['source']);

        include 'function_SendEmail.php';
        $response=Send_email(array(
                                'asset'     => 'comment',
                                'asset_id'  => $route[1],
                                'template'  => 'comment_reply',
                                'domain'    => $dataForm['domain'],
                                'id'        => $route[3],
                                'url'       => $page[0],
                                'title'     => $page[1],
                                'name'      => $to[0]['name'],
                                'pic'       => $to[0]['pic'],
                                'comment'   => $to[0]['comment'],
                                'from_name' => $from[0]['name'],
                                'from_pic'  => $from[0]['pic'],
                                'from_comment'=> $from[0]['comment'],
                                'commentid'   => $route[1],
                                'notifapp'  => $notifapp
                                    )
                            );
    }            
    else
    {
        $response['alert']['success']='Se activo el comentario.';
    }
}
if ($route[0]=='wiki') {
    $result=SQLselect(
            array(
                'table'=>'content_wiki',
                'limit'=>'LIMIT 1',
                'query'=>'
                SELECT 
                b.`id`,
                b.`status`,
                b.`url`,
                b.`titulo`
                FROM `content_wiki` a
                    LEFT JOIN `content_'.$route[1].'` b 
                    ON a.`url` = b.`url`
                WHERE
                a.`id`="'.$route[2].'"
                LIMIT 1
                '
                )
            );
    if($result['status']=='0')
    {
        $active=SQLupdate(
            array(
                'table'=>'content_'.$route[1],
                'limit'=>'LIMIT 1'
                ),
            array(
                'id'=>$result['id'],
                'status'=>'0'
                ),
            array(
                'status'=>'1'
                )
            );
    }
    $active=SQLupdate(
            array(
                'table'=>'content_wiki',
                'limit'=>'LIMIT 1'
                ),
            array(
                'id'=>$route[2],
                'status'=>'0'
                ),
            array(
                'status'=>'1'
                )
            );
    if($active)
    {
        $notifapp=SQLinsert(
                array(
                    'table'=>'notifications_app'
                    ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> $dataForm['domain'],
                    'from_id'=> '0', 
                    'to_id'=> $route[3],
                    'asset'=> 'wiki', 
                    'asset_id'=> $route[2],
                    'status'=> '0'
                    )
        );
        $page = explode(",", $dataForm['source']);
        include 'function_SendEmail.php';
        $Send_email=Send_email(array(
                                'asset'     => 'wiki',
                                'asset_id'  => $route[2],
                                'template'  => 'wiki_active',
                                'domain'    => $dataForm['domain'],
                                'id'        => $route[3],
                                'url'       => $page[0],
                                'title'     => $page[1],
                                'notifapp'  => $notifapp
                                    )
                            );
         $response['alert']['success']='Se activo el contenido.'.$Send_email;
    }
    else
    {
         $response['alert']['warning']='No se activo el contenido.';
    }
}
if ($route[0]=='glossary') {
   $result=SQLupdate(
            array(
                'table'=>'content_glossary',
                'limit'=>' '
                ),
            array(
                'id'=>$route[1],
                'status'=>'0'
                ),
            array(
                'status'=>'1'
                )
            );
    if($result)
    {
         $response['alert']['warning']='Se activo el contenido.';
    }
    else
    {
         $response['alert']['warning']='No se activo el contenido.';
    }
}
if ($route[0]=='ecommerce') {
   $update=SQLupdate(
            array(
                'table'=>'ecommerce',
                'limit'=>' '
                ),
            array(
                'id'=>$route[1],
                'status'=>'0'
                ),
            array(
                'status'=>'1'
                )
            );
    if($update)
    {
        $result=SQLselect(
            array(
                'table'=>'ecommerce',
                'limit'=>'LIMIT 1',
                'query'=>'
                SELECT *
                FROM `ecommerce`
                WHERE
                `id`="'.$route[1].'"
                LIMIT 1
                '
                )
            );
        if($result){
            $notifapp=SQLinsert(
                array(
                    'table'=>'notifications_app'
                ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> $dataForm['domain'],
                    'from_id'=> '0',
                    'to_id'=> $result['account'],
                    'asset'=> 'ecommerce',
                    'asset_id'=> $result['id'],
                    'status'=> '0'
                )
            );
            include 'function_SendEmail.php';
            $Send_email=Send_email(array(
                    'asset'     => 'ecommerce',
                    'asset_id'  => $result['id'],
                    'template'  => 'ecommerce_active',
                    'domain'    => $dataForm['domain'],
                    'id'        => $result['account'],
                    'path'      => $result['path'],
                    'title'     => $result['title'],
                    'notifapp'  => $notifapp
                )
            );
        }
         $response['alert']['warning']='Se activo el contenido.';
    }
    else
    {
         $response['alert']['warning']='No se activo el contenido.';
    }
}
if ($route[0]=='ecommerce_message') {
    $messages=SQLselect(
                array(
                    'table'=>'ecommerce_messages',
                    'order'=>'ASC',
                    'limit'=>' '
                    ),
                array(
                    'from'=>$route[2],
                    'status'=>'0'
                    )
                );
    foreach ($messages as $mess => $data) {
        $text_mess.=$data['message'].', ';
    }
   $update=SQLupdate(
            array(
                'table'=>'ecommerce_messages',
                'limit'=>' '
                ),
            array(
                'from'=>$route[2],
                'status'=>'0'
                ),
            array(
                'status'=>'1'
                )
            );
    if($update)
    {
        $result=SQLselect(
            array(
                'table'=>'ecommerce_messages',
                'limit'=>'LIMIT 1',
                'query'=>'
                SELECT
                a.*,
                b.`account`,
                a1.`name` AS `from_name`,
                sn1.`pic` AS `from_pic`,
                a2.`name` AS `to_name`,
                sn2.`pic` AS `to_pic`
                FROM `ecommerce_messages` a
                    LEFT JOIN `ecommerce` b
                        ON a.`post` = b.`id`
                    LEFT JOIN `accounts` a1
                        ON a.`from` = a1.`id`
                    LEFT JOIN `accounts_sn` sn1 
                        ON a.`from` = sn1.`account` 
                        AND a1.`pic` = sn1.`network`
                    LEFT JOIN `accounts` a2
                        ON a2.`id` = CASE 
                        when a.`to` = 0 then b.`account` else a.`to` END
                    LEFT JOIN `accounts_sn` sn2 
                        ON sn2.`account` = CASE 
                        when a.`to` = 0 then b.`account` else a.`to` END 
                        AND a2.`pic` = sn2.`network` 
                WHERE
                a.`id`="'.$route[1].'"
                LIMIT 1
                '
                )
            );
        if($result){

            $page = explode(",", $dataForm['source']);


            if($result['to']=='0'){
                $to_id=$result['account'];
            }else{
                $to_id=$result['to'];
            }

            $notifapp=SQLinsert(
                array(
                    'table'=>'notifications_app'
                ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> $dataForm['domain'],
                    'from_id'=> $result['from'],
                    'to_id'=> $to_id,
                    'asset'=> 'ecommerce_message',
                    'asset_id'=> $result['id'],
                    'status'=> '0'
                )
            );
            include 'function_SendEmail.php';
            $Send_email=Send_email(array(
                    'asset'     => 'ecommerce_message',
                    'asset_id'  => $result['id'],
                    'template'  => 'ecommerce_message',
                    'domain'    => $dataForm['domain'],
                    'id'        => $to_id,
                    'url'       => $result['url'],
                    'title'     => $page[1],
                    'messages'  => $messages,
                    'name'      => $result['to_name'],
                    'from_name' => $result['from_name'],
                    'from_pic'  => $result['from_pic'],
                    'notifapp'  => $notifapp
                )
            );
        }
         $response['alert']['warning']='Se activo el mensaje. '.$Send_email;
    }
    else
    {
         $response['alert']['warning']='No se activo el mensaje.';
    }
}
if($route[0]=='page')
{
    $result=SQLupdate(
            array(
                'table'=>'pages'
                ),
            array(
                'id'=>$route[1],
                'status'=>'0'
                ),
            array(
                'status'=>'1'
                )
            );
    if($result)
    {
         $response['alert']['warning']='Se activo la página.';
    }
    else
    {
         $response['alert']['warning']='No se activo la página.';
    }
}
echo json_encode($response);