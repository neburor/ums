<div class="col-sm-push-1 col-sm-10 col-xs-12 xxs-nopadding comments">
<?php
include 'functions.php';
$LOCALVIEWS['listgroup_comment']['list-group']=COMMENTSLIST(array('profile'=>$_SESSION['profile']['id']));
if($LOCALVIEWS['listgroup_comment'])
{
  echo HTML('listgroup_comment',array('tabpanel'=>$_GET['tabpanel']));
}
else
{
  echo HTML('div_intro_newcomment');
}

?>
</div>