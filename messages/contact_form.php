<?php
echo '<div class="container"><div class="row">
  <div class="col-md-8 col-md-push-2">';
if(isset($_GET['tab']))
{
   echo HTML('panel_contact',array('tab'=>$_GET['tab'],'nav'=>$_GET['nav']));
}
else
{
	echo HTML('panel_contact');
}
echo '</div></div></div>';