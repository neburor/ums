<?php
#Edit
$FormValue = explode(":", $dataForm['id']);

if($FormValue[0]=='glossary')
{
    $result=SQLupdate(
            array(
                'table'=>'content_glossary',
                'limit'=>'LIMIT 1'
                ),
            array(
                'id'=>$FormValue[1],
                'status'=>'0'
                ),
            array(
                'status'=>'1',
                'term'=>$dataForm['term'],
                'display'=>$dataForm['display'],
                'syn'=>$dataForm['synonyms'],
                'def'=>$dataForm['definitions'],
                'description'=>$dataForm['description'],
                'url'=>$dataForm['url']
                )
            );
    if($result){
        $response['alert']['success']='Contenido actualizado.';              
    }else{
        $response['alert']['warning']='No se actualizo el contenido.';
    }
}
if($FormValue[0]=='ecommerce')
{
    $result=SQLselect(
              array(
                  'table' => 'ecommerce',
                  'limit' => 'LIMIT 1'
                ),
              array(
                  'id' => $FormValue[1]
                )
            );
    foreach ($dataForm['images'] as $key => $value) {
            $activeimg[$value]=1;
        }
        if($images=json_decode($result['images'], true)){
            foreach ($images['list'] as $key => $value) {
                $x++;
                if($x!=1){$ListIMG.=',';}
                if(!isset($activeimg[$value['name']]))
                {
                    $ListIMG.='{"name":"'.$value['name'].'","status":0}';
                }else{
                    $ListIMG.='{"name":"'.$value['name'].'","status":1}';
                    $max++;
                }
            }
        }

    $result=SQLupdate(
            array(
                'table'=>'ecommerce',
                'limit'=>'LIMIT 1'
                ),
            array(
                'id'=>$FormValue[1],
                'status'=>'0'
                ),
            array(
                'status'    =>'1',
                'title'     => $dataForm['title'],
                'description'=> $dataForm['ec_description'],
                'images'    => '{"dir":"'.$images['dir'].'","list":['.$ListIMG.']}'
                )
            );
    if($result){
        $response['alert']['success']='Contenido actualizado.';              
    }else{
        $response['alert']['warning']='No se actualizo el contenido.';
    }
}
if($FormValue[0]=='page'){
    $result=SQLupdate(
            array(
                'table'=>'pages',
                'limit'=>'LIMIT 1'
                ),
            array(
                'id'=>$FormValue[1]
                ),
            array(
                'url'       => $dataForm['url'],
                'type'      => $dataForm['type'],
                'account'   => $dataForm['account'],
                'group'     => $dataForm['group'],
                'data'      => json_encode($dataForm['data'])
                )
            );
    if($result){
        $response['alert']['success']='Contenido actualizado.';              
    }else{
        $response['alert']['warning']='No se actualizo el contenido.';
    }
}
//     $result=SQLupdate(
//             array(
//                 'table'=>'comments'
//                 ),
//             array(
//                 'id'=> $dataForm['id']
//                 ),
//             array(
//                 'comment'=>$dataForm['comment'],
//                 'status'=>'3'
//                 )
//             );

//         if($result)
//         {
//             $result=SQLinsert(
//             array(
//                 'table'=>'comments'
//                 ),
//             array(
//                 'datetime'=> date("Y-m-d H:i:s"),
//                 'domain'=> $dataForm['domain'],
//                 'device'=> $_SESSION['device']['id'],
//                 'url'=> $dataForm['url'],
//                 'form'=> 'reply', 
//                 'from_id'=> $_SESSION['id'], 
//                 'to_id'=> $dataForm['toid'], 
//                 'in_id'=> $dataForm['inid'],
//                 'comment'=> $dataForm['reply'],
//                 'status'=> '1'
//                 )
//             );
//             $response['alert']['success']='Comentario actualizado y respondido.';       
            
//         }else{
//             $response['alert']['warning']='No se actualizo el comentario.';
//         }

echo json_encode($response);