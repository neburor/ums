<?php
#Edit

    $result=SQLupdate(
            array(
                'table'=>'comments'
                ),
            array(
                'id'=> $dataForm['id']
                ),
            array(
                'comment'=>$dataForm['comment'],
                'status'=>'3'
                )
            );

        if($result)
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
                'form'=> 'reply', 
                'from_id'=> $_SESSION['id'], 
                'to_id'=> $dataForm['toid'], 
                'in_id'=> $dataForm['inid'],
                'comment'=> $dataForm['reply'],
                'status'=> '1'
                )
            );
            $response['alert']['success']='Comentario actualizado y respondido.';       
            
        }else{
            $response['alert']['warning']='No se actualizo el comentario.';
        }

echo json_encode($response);