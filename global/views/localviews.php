<?php
#Local Views
include 'panels.php';
#FORMULARIOS DE CONTACTO
$LOCALVIEWS['form_message']=array('form'=> array('id'=>'form_message','data'=>$FORMS['message']));
$LOCALVIEWS['form_login']=array('form'=> array('id'=>'form_login','data'=>$FORMS['login']));
$LOCALVIEWS['form_signup']=array('form'=> array('id'=>'form_signup','data'=>$FORMS['signup']));
#TAB DE CONTACTO
$LOCALVIEWS['tab_contact']=array('tab'=> array('id'=>'tab_contact','data'=>$TABS['contact']));
$LOCALVIEWS['tab_contact']['tab']['data']['tab']['message']=$LOCALVIEWS['form_message'];
$LOCALVIEWS['tab_contact']['tab']['data']['tab']['login']=$LOCALVIEWS['form_login'];
$LOCALVIEWS['tab_contact']['tab']['data']['tab']['signup']=$LOCALVIEWS['form_signup'];



#FORMULARIOS DE INICIO DE SESION
$LOCALVIEWS['login']=array('form'=> array('id'=>'login','data'=>$FORMS['login']));
unset($LOCALVIEWS['login']['form']['data']['links']);
$LOCALVIEWS['login']['form']['data']['attr']['class']='form col-sm-7 xxs-nopadding';
$LOCALVIEWS['signup']=array('form'=> array('id'=>'signup','data'=>$FORMS['signup']));
unset($LOCALVIEWS['signup']['form']['data']['links']);
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
$LOCALVIEWS['form_settings1']=array('form'=> array('id'=>'form_settings1','data'=>$FORMS['user_settings']));
$LOCALVIEWS['form_settings2']=array('form'=> array('id'=>'form_settings2','data'=>$FORMS['user_settings_pass']));
$LOCALVIEWS['form_settings3']=array('form'=> array('id'=>'form_settings3','data'=>$FORMS['user_settings_email']));


#$LOCALVIEWS['contacto1']=$LOCALVIEWS['contacto2']=array('panel'=>$PANELS['contact']);
#$LOCALVIEWS['contacto2']['panel']['heading']['content']['text']='Formulario de contacto';
#$LOCALVIEWS['contacto2']['panel']['body']['content']['form']['groups']['button']=false;
#unset($LOCALVIEWS['contacto2']['panel']['body']['content']['form']['groups']);
#$LOCALVIEWS['contacto2']['panel']['body']['content']['form']['groups']['reply']=$GROUPS['reply'];

