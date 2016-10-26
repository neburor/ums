<?php
//ListComments

$ListComments=ListComments('http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'));

echo '<ul class="list-group">';

if($ListComments)
{
	echo '<li class="list-group-item">
			<i class="fa fa-envelope"></i> '.count($ListComments).' Comentario';
		if(count($ListComments)!=1)
		{
			echo 's';
		}
	echo '</li>';

	echo LIcomments($ListComments);
}
else
{
	echo '<li class="list-group-item">
			<i class="fa fa-envelope"></i> Ningun comentario
		</li>';
}
echo '
	</ul>';
function UserPic($account,$src)
{
    if($src=='facebook' || $src=='twitter')
    {
        $resultado=SQLselect(
            array(
                'table'=>'accounts_sn',
                'limit'=>'LIMIT 1'
                ),
            array(
                'domain'=>UMSDOMAIN,
                'account'=> $account,
                'network'=>$src
                )
            );
        if($resultado)
        {
            return $resultado['pic'];
        }
    }
}
function UserData($account)
{
     $resultado=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1'
                ),
            array(
                'domain'=>UMSDOMAIN,
                'id'=> $account
                )
            );
     if($resultado)
     {
        $userData['id']=$resultado['id'];
        $userData['name']=$resultado['name'];
        $userData['pic']=UserPic($account,$resultado['pic']);

        return $userData;
     }
}
function LIcomments($comments)
{
    $comments_list='';
    foreach ($comments as $column => $data) 
    {
        if($data['in_id']==0)
        {
            #$userData=UserData($data['from_id']);
            $date=Interval($data['datetime']); 
            $comments_list.='
            <li class="list-group-item" id="comment_'.$data['id'].'">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object profile-pic" alt="'.$data['from_name'].'" src="'.$data['from_pic'].'">
                    </div>
                    <div class="media-body">
                        <span class="media-heading">
                            <b>'.$data['from_name'].'</b> 
                            <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small>
                        </span>
                        <p> '.$data['comment'].'
                            <br/>
                            <small>';
                            if($data['likes']>0)
                            {
                                $comments_list.='<i class="fa fa-thumbs-up"></i> '.$data['likes'].' ·';
                            }
                            if($data['liked'])
                            {
                                $comments_list.='<a href="?likes=comment&dislike='.$data['id'].'&callback=comment_'.$data['id'].'" class="dislike">Me gusta</a> ·';
                            }
                            else
                            {
                                $comments_list.='<a href="?likes=comment&like='.$data['id'].'&callback=comment_'.$data['id'].'">Me gusta</a> ·';
                            }
            $comments_list.=' 
                                <a href="?replycomment='.$data['id'].'#replycomment_'.$data['id'].'">Responder</a>
                            </small>
                        </p>';
                if(isset($_GET['replycomment']) && $_GET['replycomment']==$data['id'])
                {
                    $comments_list.='
                        <div class="collapse in" id="replycomment_'.$data['id'].'" aria-expanded="true">
                            <div class="media"><a data-toggle="collapse" href="#replycomment_'.$data['id'].'" aria-expanded="true" aria-controls="replycomment_'.$data['id'].'" class="pull-right"><i class="fa fa-times"></i></a>
                            </div>';
                    $form=array(
                        'id'    =>'form_reply-'.$data['id'],
                        'type'  =>'comment',
                        'inid'  => $data['id'],
                        'toid'  => $data['from_id'],
                        'toname'=> $data['from_name']
                                );
                    include 'form_comment.php';
                    $comments_list.=$FormComment;
                    $comments_list.='
                        </div>';
                }
                $comments_list.='<ul class="list-group list-striped">';
                foreach ($comments as $column2 => $data2) 
                {
                    if($data['id']==$data2['in_id'])
                    {
                        #$userData=UserData($data2['from_id']);
                        #$userData2=UserData($data2['to_id']);
                        $date=Interval($data2['datetime']); 

                        $comments_list.='
                        <li class="list-group-item"  id="comment_'.$data2['id'].'">
                            <div class="media">
                                <div class="media-left">
                                <img class="media-object profile-pic" alt="'.$data2['from_name'].'" src="'.$data2['from_pic'].'">
                            </div>
                            <div class="media-body">
                                <small class="media-heading">
                                    '.$data2['from_name'].' a <i>'.$data2['to_name'].'</i>
                                    <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small>
                                </small>
                                <p> '.$data2['comment'].'
                                    <br/>
                                    <small>';
                            if($data2['likes']>0)
                            {
                                $comments_list.='<i class="fa fa-thumbs-up"></i> '.$data2['likes'].' ·';
                            }
                            if($data2['liked'])
                            {
                                $comments_list.='<a href="?likes=comment&dislike='.$data2['id'].'&callback=comment_'.$data2['id'].'" class="dislike">Me gusta</a> ·';
                            }
                            else
                            {
                                $comments_list.='<a href="?likes=comment&like='.$data2['id'].'&callback=comment_'.$data2['id'].'">Me gusta</a> ·';
                            }
            $comments_list.=' 
                                        <a href="?replycomment='.$data2['id'].'#replycomment_'.$data2['id'].'">Responder</a>
                                    </small>
                                </p>
                        ';
                        if(isset($_GET['replycomment']) && $_GET['replycomment']==$data2['id'])
                        {
                            $comments_list.='
                                <div class="collapse in" id="replycomment_'.$data2['id'].'" aria-expanded="true">
                                    <div class="media"><a data-toggle="collapse" href="#replycomment_'.$data2['id'].'" aria-expanded="true" aria-controls="replycomment_'.$data2['id'].'" class="pull-right"><i class="fa fa-times"></i></a>
                                    </div>';
                            $form=array(
                                'id'    =>'form_reply-'.$data2['id'],
                                'type'  =>'comment',
                                'inid'  => $data['id'],
                                'toid'  =>$data2['from_id'],
                                'toname'=>$data2['from_name']
                                        );
                            include 'form_comment.php';
                            $comments_list.=$FormComment;
                            $comments_list.='
                                </div>';
                        }
                        $comments_list.='</li>';
                    }
                }
                $comments_list.='</ul>
                    </div>
                </div>
            </li>
            ';
        }
        
    }

    return $comments_list;
}


