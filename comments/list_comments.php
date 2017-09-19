<?php
//ListComments


$ListComments=ListComments(URL);
echo '<ul class="list-group">';
if($ListComments)
{
	echo '<li class="list-group-item">
			<i class="fa fa-envelope"></i> <span itemprop="commentCount">'.count($ListComments).'</span> Comentario';
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

function LIcomments($comments)
{
    $comments_list='';
    foreach ($comments as $column => $data) 
    {
        if($data['form']=='reply')
        {
            $data['from_name']=ADMINNAME;
            $data['from_pic']=ADMINPIC;
            $data['from_id']=1;
        }
        if($data['in_id']==0)
        {
          
            #$userData=UserData($data['from_id']);
            $date=Interval($data['datetime']); 
            $comments_list.='
            <li class="list-group-item';
                        if($_GET['replycomment']==$data['id'] || 
                            $_SESSION['feedback']['commentreply']==$data['id'])
                        {
                            $comments_list.=' active';
                        }
                        $comments_list.='" id="comment_'.$data['id'].'">
                <div class="media"  itemprop="comment" itemscope itemtype="http://schema.org/UserComments">
                    <div class="media-left">
                        <img class="media-object profile-pic" alt="'.$data['from_name'].'" src="'.$data['from_pic'].'">
                    </div>
                    <div class="media-body">
                        <span class="media-heading" itemprop="creator" itemscope itemtype="http://schema.org/Person">
                            <b itemprop="name">'.$data['from_name'].'</b> 
                            <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small>
                        </span>
                        <span class="sr-only" itemprop="commentTime" datetime="'.date("c", strtotime($data['datetime'])).'">'.$data['datetime'].'</span>
                        <p>';
                        if(isset($_SESSION['logged']) && 
                            ($data['from_id']==$_SESSION['logged']['id']||
                                    $data['to_id']==$_SESSION['logged']['id']))
                                {
                                    if($data['status']==0)
                                    {
                                        $comments_list.='<span class="sr-only">nuevo</span> <i class="fa fa-star" title="Nuevo"></i> ';
                                    }
                                    if($data['status']==1 || $data2['status']==2 || $data2['status']==3)
                                    {
                                        $comments_list.='<span class="sr-only">publicado</span> <i class="fa fa-check-circle" title="Publicado"></i> ';
                                    }
                                    if($data['status']==4)
                                    {
                                        $comments_list.='<span class="sr-only">archivado</span> <i class="fa fa-archive" title="Archivado"></i> ';
                                    }
                                    if($data['status']==5)
                                    {
                                        $comments_list.='<span class="sr-only">bloqueado</span> <i class="fa fa-ban" title="Baneado"></i> ';
                                    }
                                }
                        $comments_list.='<span itemprop="commentText">'.$data['comment'].'</span>
                            <br/>
                            <small>';
                            if($data['likes']>0)
                            {
                                $comments_list.='<i class="fa fa-thumbs-up"></i> '.$data['likes'].' ·';
                            }
                            if($data['from_id']==$_SESSION['logged']['id'])
                            {
                                $comments_list.='Me gusta ';
                            }
                            elseif($data['liked'])
                            {
                                $comments_list.='<a href="?likes=comment&dislike='.$data['id'].'&callback=comment_'.$data['id'].'" class="dislike" rel="nofollow">Me gusta <i class="fa fa-times"></i></a> ·';
                            }
                            else
                            {
                                $comments_list.='<a href="?likes=comment&like='.$data['id'].'&callback=comment_'.$data['id'].'" rel="nofollow">Me gusta</a> ·';
                            }

                            if($data['from_id']==$_SESSION['logged']['id'])
                            {
                                $comments_list.='Responder';
                            }
                            else
                            {
                                $comments_list.='<a ';
                                if((isset($_GET['replycomment']) && $_GET['replycomment']==$data['id']) ||
                                    (isset($_SESSION['feedback']['commentreply']) && $_SESSION['feedback']['commentreply']==$data['id']))
                                {
                                    $comments_list.='data-toggle="collapse" href="#replycomment_'.$data['id'].'" aria-expanded="true" aria-controls="replycomment_'.$data['id'].'" ';
                                }
                                else
                                {
                                    $comments_list.='href="?replycomment='.$data['id'].'#comment_'.$data['id'].'"';
                                }
                                $comments_list.=' rel="nofollow" >Responder</a>';
                            }

                $comments_list.='</small>
                        </p>';
                if((isset($_GET['replycomment']) && $_GET['replycomment']==$data['id']) ||
                    (isset($_SESSION['feedback']['commentreply']) && $_SESSION['feedback']['commentreply']==$data['id']))
                {
                    $comments_list.='
                        <div class="collapse in container-fluid" id="replycomment_'.$data['id'].'" aria-expanded="true">
                            <div class="media"><a data-toggle="collapse" href="#replycomment_'.$data['id'].'" aria-expanded="true" aria-controls="replycomment_'.$data['id'].'" class="pull-right"><i class="fa fa-times"></i></a>
                            </div>';
                    $form=array(
                        'id'    =>'form_reply-'.$data['id'],
                        'type'  =>'comment',
                        'callback'=>'replycomment_'.$data['id'],
                        'inid'  => $data['id'],
                        'toid'  => $data['from_id'],
                        'tocomm'=> $data['id'],
                        'toname'=> $data['from_name']
                                );
                    include 'form_comment.php';
                    $comments_list.=$FormComment;
                    $comments_list.='
                        </div>';
                }
                $comments_list.='<ul class="list-group list-striped">';
                
                foreach ( array_reverse($comments) as $column2 => $data2) 
                {
                    
                    if($data2['to_id']==0)
                    {
                        $data2['to_name']=ADMINNAME;
                        $data2['to_pic']=ADMINPIC;
                    }
                    if($data2['form']=='reply')
                    {
                        $data2['from_name']=ADMINNAME;
                        $data2['from_pic']=ADMINPIC;
                        $data2['from_id']=0;

                    }
                    if($data['id']==$data2['in_id'])
                    {
                        
                        /*if($column2==3)
                        {
                            
                            $div=1;
                            $comments_list.= '<li><a role="button" data-toggle="collapse" href="#comment_'.$data['id'].'_all" aria-expanded="false" aria-controls="comment_'.$data['id'].'_all">Mostrar todas las respuestas</a></li><div class="collapse" id="comment_'.$data['id'].'_all">';
                        }*/
                        #$userData=UserData($data2['from_id']);
                        #$userData2=UserData($data2['to_id']);
                        $date=Interval($data2['datetime']); 

                        $comments_list.='
                        <li class="list-group-item';
                        if($_GET['replycomment']==$data2['id'] || $_SESSION['feedback']['commentreply']==$data2['id'])
                        {
                            $comments_list.=' active';
                        }
                        $comments_list.='"  id="comment_'.$data2['id'].'">
                            <div class="media" itemscope itemtype="http://schema.org/UserComments">
                                <div class="media-left">
                                <img class="media-object profile-pic" alt="'.$data2['from_name'].'" src="'.$data2['from_pic'].'">
                            </div>
                            <div class="media-body">
                                <small class="media-heading" itemprop="creator" itemscope itemtype="http://schema.org/Person">
                                    <span itemprop="name">'.$data2['from_name'].'</span> a <i>'.$data2['to_name'].'</i>
                                    <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small>
                                    
                                </small>
                                <span class="sr-only" itemprop="commentTime" datetime="'.date("c", strtotime($data2['datetime'])).'">'.$data2['datetime'].'</span>
                                <p>';
                                if(isset($_SESSION['logged']) && 
                                    ($data2['from_id']==$_SESSION['logged']['id']||
                                    $data2['to_id']==$_SESSION['logged']['id']))
                                {
                                    if($data2['status']==0)
                                    {
                                        $comments_list.='<span class="sr-only">nuevo</span> <i class="fa fa-star" title="Nuevo"></i> ';
                                    }
                                    if($data2['status']==1 || $data2['status']==2 || $data2['status']==3)
                                    {
                                        $comments_list.='<span class="sr-only">publicado</span> <i class="fa fa-check-circle" title="Publicado"></i> ';
                                    }
                                    if($data2['status']==4)
                                    {
                                        $comments_list.='<span class="sr-only">archivado</span> <i class="fa fa-archive" title="Archivado"></i> ';
                                    }
                                    if($data2['status']==5)
                                    {
                                        $comments_list.='<span class="sr-only">bloqueado</span> <i class="fa fa-ban" title="Baneado"></i> ';
                                    }
                                }
                        $comments_list.='<span itemprop="commentText"> '.$data2['comment'].'</span>
                                    <br/>
                                    <small>';
                            if($data2['likes']>0)
                            {
                                $comments_list.='<i class="fa fa-thumbs-up"></i> '.$data2['likes'].' ·';
                            }
                            if($data2['from_id']==$_SESSION['logged']['id']||
                               ($data2['form']=='reply' && $data2['status']=='4'))
                            {
                                $comments_list.='Me gusta ';
                            }
                            elseif($data2['liked'])
                            {
                                $comments_list.='<a href="?likes=comment&dislike='.$data2['id'].'&callback=comment_'.$data2['id'].'" class="dislike" rel="nofollow">Me gusta <i class="fa fa-times"></i></a> ·';
                            }
                            else
                            {
                                $comments_list.='<a href="?likes=comment&like='.$data2['id'].'&callback=comment_'.$data2['id'].'" rel="nofollow">Me gusta</a> ·';
                            }

                            if($data2['from_id']==$_SESSION['logged']['id']||
                               ($data2['form']=='reply' && $data2['status']=='4'))
                            {
                                $comments_list.='Responder';
                            }
                            else
                            {
                                $comments_list.=' <a ';
                                if((isset($_GET['replycomment']) && $_GET['replycomment']==$data2['id']) ||
                    (isset($_SESSION['feedback']['commentreply']) && $_SESSION['feedback']['commentreply']==$data2['id']))
                                {
                                    $comments_list.='data-toggle="collapse" href="#replycomment_'.$data2['id'].'" aria-expanded="true" aria-controls="replycomment_'.$data2['id'].'" ';
                                }
                                else
                                {
                                    $comments_list.='href="?replycomment='.$data2['id'].'#comment_'.$data2['id'].'"';
                                }
                                $comments_list.=' rel="nofollow"> Responder</a>';
                            }

                        $comments_list.='</small>
                                </p></div></div>
                        ';
                        if(($data2['form']=='reply' && $data2['status']!='4') &&
                            ((isset($_GET['replycomment']) && $_GET['replycomment']==$data2['id']) ||
                                (isset($_SESSION['feedback']['commentreply']) && 
                                $_SESSION['feedback']['commentreply']==$data2['id'])
                            )
                            )
                        {
                            $comments_list.='
                                <div class="collapse in" id="replycomment_'.$data2['id'].'" aria-expanded="true">
                                    <div class="media"><a data-toggle="collapse" href="#replycomment_'.$data2['id'].'" aria-expanded="true" aria-controls="replycomment_'.$data2['id'].'" class="pull-right"><i class="fa fa-times"></i></a>
                                    </div>';
                            $form=array(
                                'id'    =>'form_reply-'.$data2['id'],
                                'type'  =>'comment',
                                'callback'=>'replycomment_'.$data2['id'],
                                'inid'  => $data['id'],
                                'toid'  => $data2['from_id'],
                                'tocomm'=> $data2['id'],
                                'toname'=> $data2['from_name']
                                        );
                            include 'form_comment.php';
                            $comments_list.=$FormComment;
                           
                        }
                        $comments_list.='</li>';
                        
                    }

                }
                /*if($div==1)
                {
                    $comments_list.= '</div>';
                }*/
                
                $comments_list.='</ul>
                    </div>
                </div>
            </li>
            ';
        }
        
    }

    $_SESSION['feedback']['commentreply']=0;
    return $comments_list;
}


