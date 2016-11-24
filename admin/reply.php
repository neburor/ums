<?php
#Reply



if($dataForm['message'])
{
    $result=SQLinsert(
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

        if($result)
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
            $notif=SQLinsert(
                array(
                    'table'=>'notifications'
                    ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> $dataForm['domain'],
                    'from_id'=> $_SESSION['id'], 
                    'to_id'=> $dataForm['toid'],
                    'asset'=> 'message', 
                    'asset_id'=> $result,
                    'status'=> '0'
                    )
                );

            if($archive && $notif){
                $response['alert']['success']='Mensaje enviado.';       
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
    $result=SQLinsert(
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
                'to_id'=> $dataForm['toid'], 
                'in_id'=> $dataForm['inid'],
                'comment'=> $dataForm['comment'],
                'status'=> '1'
                )
            );

        if($result)
        {
            $archive=SQLupdate(
                array(
                    'table'=>'comments'
                    ),
                array(
                    'id'=>$dataForm['inid'],
                    'status'=>'0'
                    ),
                array(
                    'status'=>'1'
                    )
                );
            if($archive){
                $response['alert']['success']='Comentario enviado.';       
            }else{
                $response['alert']['warning']='No publicado.';
            }
        }else{
            $response['alert']['warning']='No se guardo el mensaje.';
        }

}
echo json_encode($response);