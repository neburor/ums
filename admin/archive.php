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
                'status'=>'4'
                )
            );
}
if($data[0]=='comment')
{
        $archive=SQLupdate(
            array(
                'table'=>'comments'
                ),
            array(
                'id'=>$data[1],
                'status'=>'0'
                ),
            array(
                'status'=>'4'
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
        }
    

}
if($data[0]=='wiki')
{
    $result=SQLupdate(
            array(
                'table'=>'content_wiki',
                'limit'=>' '
                ),
            array(
                'id'=>$data[1],
                'status'=>'0'
                ),
            array(
                'status'=>'2'
                )
            );
}
if($data[0]=='glossary')
{
    $result=SQLupdate(
            array(
                'table'=>'content_glossary',
                'limit'=>' '
                ),
            array(
                'id'=>$data[1],
                'status'=>'0'
                ),
            array(
                'status'=>'2'
                )
            );
}
if($data[0]=='ecommerce')
{
    $result=SQLupdate(
            array(
                'table'=>'ecommerce',
                'limit'=>' '
                ),
            array(
                'id'=>$data[1],
                'status'=>'0'
                ),
            array(
                'status'=>'2'
                )
            );
}
if($data[0]=='page')
{
    $result=SQLupdate(
            array(
                'table'=>'pages'
                ),
            array(
                'id'=>$data[1],
                'status'=>'1'
                ),
            array(
                'status'=>'0'
                )
            );
}