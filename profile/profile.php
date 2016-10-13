<?php
//Profile

if(isset($_SESSION['logged']))
{
 include 'html_user-profile.php';
}
else
{

#  if(isset($_GET['tab']))
#  {
#    echo HTML('panel_profile',array('tab'=>$_GET['tab'],'nav'=>$_GET['nav']));
#  }
#  else
#  {
#    echo HTML('panel_profile');
#  }
}