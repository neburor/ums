<?php
#Archive
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

elseif($route[0]=='comment')
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
        $response=Send_email('reply',array(
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
echo json_encode($response);