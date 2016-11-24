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
                'status'=>'1'
                )
            );
}
if($data[0]=='comment')
{
    if($data[1]=='activate')
    {
        $activate=SQLupdate(
            array(
                'table'=>'comments'
                ),
            array(
                'id'=>$data[2],
                'status'=>'0'
                ),
            array(
                'status'=>'1'
                )
            );
        if($data[3] && $data[4])
        {
            $notif=SQLinsert(
                array(
                    'table'=>'notifications'
                    ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> $dataForm['domain'],
                    'from_id'=> $data[3], 
                    'to_id'=> $data[4],
                    'asset'=> 'comment', 
                    'asset_id'=> $data[2],
                    'status'=> '0'
                    )
                );
        }
    }
    if($data[1]=='ban')
    {
        $ban=SQLupdate(
            array(
                'table'=>'comments'
                ),
            array(
                'id'=>$data[2],
                'status'=>'0'
                ),
            array(
                'status'=>'4'
                )
            );
    }
}