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
                'status'=>'5'
                )
            );
}
elseif($data[0]=='comment')
{

        $ban=SQLupdate(
            array(
                'table'=>'comments'
                ),
            array(
                'id'=>$data[1],
                'status'=>'0'
                ),
            array(
                'status'=>'5'
                )
            );
    
}