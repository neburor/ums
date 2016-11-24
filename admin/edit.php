<?php
#Edit

    $result=SQLupdate(
            array(
                'table'=>'comments'
                ),
            array(
                'id'=> $dataForm['toid']
                ),
            array(
                'comment'=>$dataForm['comment'],
                'status'=>'3'
                )
            );

        if($result)
        {
            $response['alert']['success']='Comentario actualizado.';       
            
        }else{
            $response['alert']['warning']='No se guardo el comentario.';
        }

echo json_encode($response);