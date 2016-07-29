<?php
include 'functions.php';
if(isset($_SESSION['profile']))
{

$LOCALVIEWS['tab_user_comment']=array('tab'=> array('id'=>'tab_user_comment','data'=>$TABS['user_comment']));

$LOCALVIEWS['tab_user_comment']['tab']['data']['tab']['comment']['media']['left']['img']['src']=profielPic();
$LOCALVIEWS['tab_user_comment']['tab']['data']['tab']['comment']['media']['left']['img']['alt']=$_SESSION['profile']['name'];

$LOCALVIEWS['tab_user_comment']['tab']['data']['tab']['comment']['media']['body']['heading']['text']['content']=$_SESSION['profile']['name'];
$LOCALVIEWS['tab_user_comment']['tab']['data']['tab']['comment']['media']['body']['form']=array('id'=>'form_user_comment','data'=>$FORMS['user_comment']);


$LOCALVIEWS['panel_comment']=array('panel' => array('id'=>'panel_comment','data'=>$PANELS['comment']));
$LOCALVIEWS['panel_comment']['panel']['data']['heading']['content']['tabnav']=$LOCALVIEWS['tab_user_comment']['tab']['data']['nav'];
$LOCALVIEWS['panel_comment']['panel']['data']['body']['content']['tabpanel']=$LOCALVIEWS['tab_user_comment']['tab']['data']['tab'];
$replyForm=$FORMS['user_comment'];

}
else
{
  $replyForm=$FORMS['comment'];
  $replyForm['signup']=false;

  $likeForm=$FORMS['like'];
  $dislikeForm=$FORMS['dislike'];
}

$LOCALVIEWS['panel_comment']['panel']['data']['list-group']=COMMENTSLIST(array('url'=>'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?')));

echo HTML('panel_comment',array('tab'=>$_GET['tab'],'nav'=>$_GET['nav']));          

#echo '<pre>';
#var_dump($LOCALVIEWS['panel_comment']['panel']['data']['list-group']);
#echo '</pre>';