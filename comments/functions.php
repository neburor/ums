<?php
#MESSAGES
function profielPic()
{
    if($_SESSION['profile']['pic']=='facebook' || $_SESSION['profile']['pic']=='twitter')
            {
              if($_SESSION['profile']['pic']=='twitter')
              {
                $_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic']=str_replace('_normal', '_bigger', $_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic']);
              }
              $userPic=$_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic'];
            }
            elseif($_SESSION['profile']['pic']=='local')
            {
              $userPic=$_SESSION['profile']['id'].'.jpg"';
            }

    return $userPic;
}
function CommentsJSON($url)
{
	$sql=mysql_query("
        SELECT * FROM `comments` 
        WHERE `url` = '".$url."'
        AND `status` = '1'
        ORDER BY `id` ASC");
	 $rows = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $rows[] = $i;
    }

    return json_encode($rows);
}
function TotalComments($params)
{
    if($params['url'])
    {
        $SEARCHBY="`url` = '".$params['url']."'
                    AND `status` = '1'";
    }
    if($params['profile'])
    {
        $SEARCHBY="`from` = '".$params['profile']."'";
    }
    $sql=mysql_query("
        SELECT * FROM `comments` 
        WHERE ".$SEARCHBY."
        ORDER BY `id` ASC");
     $rows = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $rows[] = $i;
    }

    return count($rows);
}
function COMMENTSLIST($params)
{
    if(!$params['sortcomment'])
    {
        $params['sortcomment']='DESC';
    }

    if($params['url'])
    {
        $SEARCHBY="`url` = '".$params['url']."'
                    AND `to`    = '0'
                    AND `status` = '1'";
    }
    if($params['profile'])
    {
        $SEARCHBY="`from` = '".$params['profile']."'
                    AND `to`    = '0'";
    }
    $sql=mysql_query("
        SELECT * FROM `comments` 
        WHERE ".$SEARCHBY."
        ORDER BY `id` ".$params['sortcomment']);
     $rows = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $rows[] = $i;
    }

    $comments[0]=array('text' => array(
                                      'tag' => 'b',
                                       'content'=> TotalComments($params).' Comentarios'
                                      ));

    foreach ($rows as $column => $data) 
    {
        $column++;
        if($data['guest']=='on')
        {
            $profile['pic']='images/pic/usr.png';
            $profile['name']='Anonimo '.$data['from'];
        }
        else
        {
            $profile=UserMin(array('id'=>$data['from'],'domain'=>$data['domain']));
        }

        $responses=Responses($column,$data['id'],$params);
        $likes=TotalLikes($data['id']);

        $comments[$column]=array(
                            'media' => array(
                                        'left' => array(
                                                    'img' => array(
                                                                'src'   => $profile['pic'],
                                                                'class' => 'profile-pic',
                                                                'alt'   => $profile['name']
                                                                )
                                                        ),
                                        'body' => array(
                                                    'heading'=>array(
                                                                'text' => array(
                                                                            'itemprop'=>'name',
                                                                            'tag' => 'b',
                                                                            'content'=> $profile['name']
                                                                             ),
                                                                'time' => array(
                                                                            'datetime' => $data['date'],
                                                                            'iso8601'=> date("c", strtotime($data['date']))
                                                                            )
                                                                    ),
                                                    'text' => array(
                                                                'itemprop'=>'commentText',
                                                                'tag' => 'p',
                                                                'content' => $data['comment']
                                                                )
                                                        ),
                                                'right' => false
                                        )
                                );
        if($params['url'])
        {
            $comments[$column]['tab']=CommentTab($column,$data['id']);
        }
        if($params['profile'] && $_SESSION['profile'])
        {
            $comments[$column]['tab']=UserCommentTab($column,$data['id']);
        }

        if($likes!=0)
        {
        $comments[$column]['media']['body']['likes']=array(
                                                                'tag' => 'span',
                                                                'content' => $likes
                                                                    );
        }
        if($responses)
        {
            $comments[$column]['media']['body']['responses']=array(
                                                                'tag' => 'span',
                                                                'content' => count($responses)
                                                                    );
            $comments[$column]['tab']['data']['nav']['responses']=array(
                                                    'i' => 'fa fa-comments-o',
                                                    'text'  => array(
                                                                'class' => 'hidden-xs',
                                                                'tag'   => 'span',
                                                                'content' => 'Respuestas'
                                                                    )
                                                        );

            $comments[$column]['tab']['data']['tab']['responses']['list-group']=$responses;
        }

    }




    return $comments;
}
function TotalLikes($id)
{
     $sql=mysql_query("
        SELECT * FROM `likes` 
        WHERE `type`    = 'comment'
        AND `element` = '".$id."'
        AND `like` = 1
        ORDER BY `id` ASC");
     $rows = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $rows[] = $i;
    }

    return count($rows);
}
function Responses($comment,$id,$params)
{
    if($params['url'])
    {
        $SEARCHBY="`url` = '".$params['url']."'
        AND `to`    = '".$id."'
        AND `status` = '1'";
    }
    if($params['profile'])
    {
        $SEARCHBY="`to`  = '".$id."'
                    AND `status` = '1'";
    }
     $sql=mysql_query("
        SELECT * FROM `comments` 
        WHERE ".$SEARCHBY."
        ORDER BY `id` ASC");
     $rows = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $rows[] = $i;
    }

    foreach ($rows as $column => $data) 
    {
        $column++;
        if($data['guest']=='on')
        {
            $profile['pic']='images/pic/usr.png';
            $profile['name']='Anonimo '.$data['from'];
        }
        else
        {
            $profile=UserMin(array('id'=>$data['from'],'domain'=>$data['domain']));
        }
        $likes=TotalLikes($data['id']);

        $comments[$column]=array(
                            'media' => array(
                                        'left' => array(
                                                    'img' => array(
                                                                'src'   => $profile['pic'],
                                                                'class' => 'profile-pic',
                                                                'alt'   => $profile['name']
                                                                )
                                                        ),
                                        'body' => array(
                                                    'heading'=>array(
                                                                'text' => array(
                                                                            'itemprop'=>'name',
                                                                            'tag' => 'b',
                                                                            'content'=> $profile['name']
                                                                             ),
                                                                'time' => array(
                                                                            'datetime' => $data['date'],
                                                                            'iso8601'=> date("c", strtotime($data['date']))
                                                                            )
                                                                    ),
                                                    'text' => array(
                                                                'itemprop'=>'commentText',
                                                                'tag' => 'p',
                                                                'content' => $data['comment']
                                                                )
                                                        ),
                                                'right' => false
                                        ),
                                'tab'   => ReplyTab($comment,$column,$data['id'])
                                );
        if($likes!=0)
        {
        $comments[$column]['media']['body']['likes']=array(
                                                                'tag' => 'span',
                                                                'content' => $likes
                                                                    );
        }
    }

    return $comments;
}

function CommentTab($comment,$id)
{
    $commentTab=array(
                'id' => 'tab_comment-'.$comment,
                'data'=> array(
                          'params'=> array(
                                        'like' => array(
                                                    'type' => 'comment',
                                                    'element' => $id
                                                    )
                                            ),
                          'attr'  => array(
                                        'class' => 'container-fluid'
                                        ),
                          'nav'   => array(
                                        'like'  => array(
                                                    'i'     => 'fa fa-thumbs-up'
                                                        ),
                                        'dislike'  => array(
                                                    'i'     => 'fa fa-thumbs-down'
                                                        ),
                                        'reply' => array(
                                                    'i' => 'fa fa-reply',
                                                    'text'=> array(
                                                                'class' => 'hidden-xs',
                                                                'tag'   => 'span',
                                                                'content' => 'Responder'
                                                                   )
                                                        )
                                        ),
                          'tab'   => array(
                                        'like' => likeForm($comment,$id),
                                        'dislike' => dislikeForm($comment,$id),
                                        'reply' => ReplyForm($comment,$id)
                                          )
                            )
                       );
    if($_SESSION['profile'])
    {
        $liked=Search_likes(array(  
                            'profile' => $_SESSION['profile']['id'],
                            'type'    => 'comment',
                            'element' => $id
                            ));
        if($liked)
        {
            if($liked['like']==1)
            {
                $commentTab['data']['nav']['like']['class']='disabled';
               
            }
            else
            {
                $commentTab['data']['nav']['dislike']['class']='disabled';
            }
                
        }

        
    }

    return $commentTab;
}
function UserCommentTab($comment,$id)
{
    $UsercommentTab=array(
                'id' => 'tab_comment-'.$comment,
                'data'=> array(
                          'attr'  => array(
                                        'class' => 'container-fluid'
                                        ),
                          'nav'   => array(
                                        'config'  => array(
                                                    'i'     => 'fa fa-cog',
                                                    'text'=> array(
                                                                'class' => 'hidden-xs',
                                                                'tag'   => 'span',
                                                                'content' => 'Opciones'
                                                                   )
                                                        )
                                        ),
                          'tab'   => array(
                                        'config' => ''
                                          )
                            )
                       );

    return $UsercommentTab;
}
function replyTab($comment,$reply,$id)
{
    $replyTab=array(
                'id' => 'tab_comment-'.$comment.'-'.$reply,
                'data'=> array(
                          'params'=> array(
                                        'like' => array(
                                                    'type' => 'comment',
                                                    'element' => $id
                                                    )
                                            ),
                          'attr'  => array(
                                        'class' => 'container-fluid'
                                        ),
                          'nav'   => array(
                                        'like'  => array(
                                                    'i'     => 'fa fa-thumbs-up'
                                                        ),
                                        'dislike'  => array(
                                                    'i'     => 'fa fa-thumbs-down'
                                                        )
                                        ),
                          'tab'   => array(
                                        'like' => likeForm($comment.'-'.$reply,$id),
                                        'dislike' => dislikeForm($comment.'-'.$reply,$id)
                                          )
                            )
                       );
    if($_SESSION['profile'])
    {
        $liked=Search_likes(array(  
                            'profile' => $_SESSION['profile']['id'],
                            'type'    => 'comment',
                            'element' => $id
                            ));
        if($liked)
        {
            if($liked['like']==1)
            {
                $replyTab['data']['nav']['like']['class']='disabled';
               
            }
            else
            {
                $replyTab['data']['nav']['dislike']['class']='disabled';
            }
                
        }

        
    }

    return $replyTab;
}
function likeForm($comment,$id)
{
    global $likeForm;

    $likeForm['hidden']['likeid']=$id;
    $likeForm['hidden']['liketype']='comment';

    $like=array(
            'form' => array(
                        'id' => 'form_comment_like-'.$comment,
                        'data'=> $likeForm
                        )
                    );

    return $like;
}
function dislikeForm($comment,$id)
{
    global $dislikeForm;

    $dislikeForm['hidden']['likeid']=$id;
    $dislikeForm['hidden']['liketype']='comment';

    $dislike=array(
            'form' => array(
                        'id' => 'form_comment_dislike-'.$comment,
                        'data'=> $dislikeForm
                        )
                    );
    return $dislike;
}
function ReplyForm($comment,$id)
{
     global $replyForm;

     $replyForm['hidden']['replyto']=$id;

     if($_SESSION['profile'])
     {
       $reply=array( 'media'=> array(
                        'left' => array(
                                'img' => array(
                                'src'   => profielPic(),
                                'class' => 'profile-pic',
                                'alt'   => $_SESSION['profile']['name']
                                            )
                                    ),
                        'body' => array(
                                'heading'=>array(
                                            'text' => array(
                                                        'tag' => 'b',
                                                        'content'=> $_SESSION['profile']['name']
                                                            )
                                               ),
                                'form' => array(
                                        'id'=>'form_comment_reply-'.$comment,
                                        'data'=>$replyForm
                                                )  
                                        ),
                        'right' => false
                            )
                    );
     }
     else
     {
         $reply=array(
                     'form' => array(
                            'id' => 'form_comment_reply-'.$comment,
                            'data'=> $replyForm
                        )
                    );
     }

     return $reply;
}