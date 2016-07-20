<?php
#Local Views
include 'panels.php';
#FORMULARIOS
$LOCALVIEWS['form_message']=array('form'=> array('id'=>'form_message','data'=>$FORMS['message']));
$LOCALVIEWS['form_login']=array('form'=> array('id'=>'form_login','data'=>$FORMS['login']));
$LOCALVIEWS['form_signup']=array('form'=> array('id'=>'form_signup','data'=>$FORMS['signup']));
$LOCALVIEWS['form_comment']=array('form'=> array('id'=>'form_comment','data'=>$FORMS['comment']));
#TAB DE CONTACTO
$LOCALVIEWS['tab_contact']=array('tab'=> array('id'=>'tab_contact','data'=>$TABS['contact']));
$LOCALVIEWS['tab_contact']['tab']['data']['tab']['message']=$LOCALVIEWS['form_message'];
#$LOCALVIEWS['tab_contact']['tab']['data']['tab']['login']=$LOCALVIEWS['form_login'];
#$LOCALVIEWS['tab_contact']['tab']['data']['tab']['signup']=$LOCALVIEWS['form_signup'];
#TAB DE COMENTARIOS
$LOCALVIEWS['tab_comment']=array('tab'=>array('id'=>'tab_contact', 'data'=>$TABS['comment']));
$LOCALVIEWS['tab_comment']['tab']['data']['tab']['comment']=$LOCALVIEWS['form_comment'];


#FORMULARIOS DE INICIO DE SESION
$LOCALVIEWS['login']=array('form'=> array('id'=>'login','data'=>$FORMS['login']));
$LOCALVIEWS['login']['form']['data']['attr']['class']='form col-sm-7 xxs-nopadding';
$LOCALVIEWS['signup']=array('form'=> array('id'=>'signup','data'=>$FORMS['signup']));
$LOCALVIEWS['signup']['form']['data']['attr']['class']='form col-sm-7 xxs-nopadding';

#TAB DE INICIO DE SESION
$LOCALVIEWS['tab_profile']=array('tab'=> array('id'=>'tab_profile','data'=>$TABS['profile']));
$LOCALVIEWS['tab_profile']['tab']['data']['tab']['login']['form']=$LOCALVIEWS['login']['form'];
$LOCALVIEWS['tab_profile']['tab']['data']['tab']['signup']['form']=$LOCALVIEWS['signup']['form'];

#PANEL DE INICIO DE SESION
$LOCALVIEWS['panel_profile']=array('panel'=> array('id'=>'panel_profile','data'=>$PANELS['profile']));
$LOCALVIEWS['panel_profile']['panel']['data']['heading']['content']['tabnav']=$LOCALVIEWS['tab_profile']['tab']['data']['nav'];
$LOCALVIEWS['panel_profile']['panel']['data']['body']['content']['tabpanel']=$LOCALVIEWS['tab_profile']['tab']['data']['tab'];


#FORMULARIOS DE PREFERENCIAS
$LOCALVIEWS['form_settings_name']=array('form'=> array('id'=>'form_settings_name','data'=>$FORMS['user_settings_name']));
$LOCALVIEWS['form_settings_pic']=array('form'=> array('id'=>'form_settings_pic','data'=>$FORMS['user_settings_pic']));
$LOCALVIEWS['form_settings_pic_upload']=array('form'=> array('id'=>'form_settings_pic_upload','data'=>$FORMS['user_settings_pic_upload']));
$LOCALVIEWS['form_settings_cover']=array('form'=> array('id'=>'form_settings_cover','data'=>$FORMS['user_settings_cover']));
$LOCALVIEWS['form_settings_cover_upload']=array('form'=> array('id'=>'form_settings_cover_upload','data'=>$FORMS['user_settings_cover_upload']));
$LOCALVIEWS['form_settings_pass1']=array('form'=> array('id'=>'form_settings_pass1','data'=>$FORMS['user_settings_pass1']));
$LOCALVIEWS['form_settings_pass2']=array('form'=> array('id'=>'form_settings_pass2','data'=>$FORMS['user_settings_pass2']));
$LOCALVIEWS['link_settings_facebook']= array('facebook'	=> $LINKS['connect_facebook']);
$LOCALVIEWS['link_settings_twitter']= array('twitter'	=> $LINKS['connect_twitter']);
$LOCALVIEWS['form_settings_notif']=array('form'=> array('id'=>'form_settings_notif','data'=>$FORMS['user_settings_email']));
$LOCALVIEWS['form_settings_notif']['form']['data']['groups']['email']['button']['content']['text']['class']='hidden-xs';

#FORMULARIO DE MENSAJE
$LOCALVIEWS['div_intro_newmessage']=array('div'=>array('id'=>'div_intro_newmessage', 'data'=> array('attr'=> array( 'class' => 'col-xs-12 xxs-nopadding'),'content'	=> array( 'intro'	=> $INTROS['messages']))));
$LOCALVIEWS['form_user_newmessage']=array('form'=>array('id'=>'form_user_newmessage', 'data'=>$FORMS['user_newmessage']));
$LOCALVIEWS['form_user_message']=array('form'=>array('id'=>'form_user_message', 'data'=>$FORMS['user_message']));

#$LOCALVIEWS['contacto1']=$LOCALVIEWS['contacto2']=array('panel'=>$PANELS['contact']);
#$LOCALVIEWS['contacto2']['panel']['heading']['content']['text']='Formulario de contacto';
#$LOCALVIEWS['contacto2']['panel']['body']['content']['form']['groups']['button']=false;
#unset($LOCALVIEWS['contacto2']['panel']['body']['content']['form']['groups']);
#$LOCALVIEWS['contacto2']['panel']['body']['content']['form']['groups']['reply']=$GROUPS['reply'];

#PANEL CONTACTO
$LOCALVIEWS['login']['form']['id']='form_login_contact';
$LOCALVIEWS['tab_contact']['tab']['data']['tab']['login']['form']=$LOCALVIEWS['login']['form'];
$LOCALVIEWS['signup']['form']['id']='form_signup_contact';
$LOCALVIEWS['tab_contact']['tab']['data']['tab']['signup']['form']=$LOCALVIEWS['signup']['form'];

$LOCALVIEWS['panel_contact']=array('panel' => array('id'=>'panel_contact','data'=>$PANELS['contact']));
$LOCALVIEWS['panel_contact']['panel']['data']['heading']['content']['tabnav']=$LOCALVIEWS['tab_contact']['tab']['data']['nav'];
$LOCALVIEWS['panel_contact']['panel']['data']['body']['content']['tabpanel']=$LOCALVIEWS['tab_contact']['tab']['data']['tab'];



#PANEL COMENTARIO
$LOCALVIEWS['login']['form']['id']='form_login_comment';
$LOCALVIEWS['tab_comment']['tab']['data']['tab']['login']['form']=$LOCALVIEWS['login']['form'];
$LOCALVIEWS['signup']['form']['id']='form_signup_comment';
$LOCALVIEWS['tab_comment']['tab']['data']['tab']['signup']['form']=$LOCALVIEWS['signup']['form'];
$LOCALVIEWS['panel_comment']=array('panel' => array('id'=>'panel_comment','data'=>$PANELS['comment']));
$LOCALVIEWS['panel_comment']['panel']['data']['heading']['content']['tabnav']=$LOCALVIEWS['tab_comment']['tab']['data']['nav'];
$LOCALVIEWS['panel_comment']['panel']['data']['body']['content']['tabpanel']=$LOCALVIEWS['tab_comment']['tab']['data']['tab'];