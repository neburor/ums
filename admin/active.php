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
elseif($data[0]=='comment')
{
 
        $active=SQLupdate(
            array(
                'table'=>'comments'
                ),
            array(
                'id'=>$data[1],
                'status'=>'0'
                ),
            array(
                'status'=>'1'
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