<?php
if(isset($_SESSION['profile']))
{
#unset($LOCALVIEWS['panel_contact']['panel']['data']['heading']['content']['tabnav']['login']);
#unset($LOCALVIEWS['panel_contact']['panel']['data']['heading']['content']['tabnav']['signup']);
#unset($LOCALVIEWS['panel_contact']['panel']['data']['body']['content']['tabpanel']['login']);
#unset($LOCALVIEWS['panel_contact']['panel']['data']['body']['content']['tabpanel']['signup']);
#unset($LOCALVIEWS['panel_contact']['panel']['data']['body']['content']['tabpanel']['message']['form']['data']['groups']['fieldset']);
  $LOCALVIEWS['form_message_user']=array('form'=> array('id'=>'form_message','data'=>$FORMS['message_user']));


	echo '<div class="panel panel-default" id="panel_contact"><div class="panel-heading navheading"><i class="fa fa-envelope fa-3x"></i> <b>Contactanos</b> <ul class="nav nav-tabs nav-login"><li role="presentation" class="active"><a href="#"> <i class="fa fa-edit"></i> <span>Contactar</span></a></li><li role="presentation" class="pull-right"><a href="?logout"> <i class="fa fa-sign-out"></i> <span class="hidden-xxs">Cerrar sesión</span></a></li></ul></div><div class="panel-body"> <div class="tab-content"><div role="tabpanel" class="tab-pane fade active in">
	<div class="media">
        <div class="media-left">
        	';
        
            if($_SESSION['profile']['pic']=='facebook' || $_SESSION['profile']['pic']=='twitter')
            {
              if($_SESSION['profile']['pic']=='twitter')
              {
                $_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic']=str_replace('_normal', '_bigger', $_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic']);
              }
              echo '<img src="'.$_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic'].'" class="profile-pic">';
            }
            elseif($_SESSION['profile']['pic']=='local')
            {
              echo '<img src="images/pic/pic_'.$_SESSION['profile']['id'].'.jpg" class="profile-pic">';
            }
           
       echo '
                </div>
                <div class="media-body">
  <strong class="media-heading"><a href="'.URLSYSTEM.'profile.php?tab=mensajes">'.$_SESSION['profile']['name'].'</a></strong>';
  echo HTML('form_message_user');
  echo '</div>
              </div></div></div></div></div>';

}
else
{
	echo HTML('panel_contact',array('tab'=>$_GET['tab'],'nav'=>$_GET['nav']));
}