<?php
#FORMS
include 'groups.php';

$FORMS['message']=array(
						'type'		=> 'message',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'action'=> URLSYSTEM,
										 	'method'=> 'POST'	
											),
						'groups'	=> array(
											'alert' 	=> false,
											'message'	=> $GROUPS['message'],
											'fieldset'	=> array(
												'attr'	=> array('class'=>'well well-sm'),
												'groups'=> array(
													'alert'		=> $ALERTS['signon'],
													'name'		=> $GROUPS['name'],
													'email'		=> $GROUPS['email'],
													'signon'	=> $GROUPS['signon']
													),
												'links'	=> array(
														'label'		=> 'Conectarse con :',
														'facebook'	=> $LINKS['login_facebook'],
														'twitter'	=> $LINKS['login_twitter']
														)
												),
											'button'	=> $BUTTONS['message']
											)
						);
$FORMS['user_newmessage']=array(
						'type'		=> 'message',
						'attr'		=> array(
											'class' => 'form col-xs-12',
										 	'role'	=> 'form',
										 	'action'=> URLSYSTEM.'?tab=mensajes',
										 	'method'=> 'POST'	
											),
						'groups'	=> array(
											'alert' 	=> false,
											'message'	=> $GROUPS['message'],
											'button'	=> $BUTTONS['message']
											)
						);
$FORMS['user_message']=array(
	'type'		=> 'message',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'action'=> URLSYSTEM.'?tab=mensajes',
										 	'method'=> 'POST'	
											),
						'groups'	=> array(
											'alert' 	=> false,
											'message'	=> $GROUPS['lite_message']
											)
						);
$FORMS['login']=array(
						'type'		=> 'login',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'action'=> URLSYSTEM,
										 	'method'=> 'POST'	
											),
						'links'		=> array(
										'label'		=> 'Conectarse con :',
										'facebook'	=> $LINKS['login_facebook'],
										'twitter'	=> $LINKS['login_twitter']
											),
						'groups'	=> array(
											'alert' 	=> false,
											'useremail'	=> $GROUPS['useremail'],
											'userpass'	=> $GROUPS['userpass'],
											'autologin'	=> $GROUPS['autologin'],
											'button'	=> $BUTTONS['login']
											)
						);
$GROUPS['username']['attr']['class']=$GROUPS['useremail']['attr']['class']='form-group col-xs-12';
$FORMS['signup']=array(
						'type'		=> 'signup',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'action'=> URLSYSTEM.'?signup',
										 	'method'=> 'POST'	
											),
						'links'		=> array('facebook'=>$LINKS['signup_facebook'],'twitter'=>$LINKS['signup_twitter']),
						'groups'	=> array(
											'alert' 	=> false,
											'username'	=> $GROUPS['username'],
											'useremail'	=> $GROUPS['useremail'],
											'pass'		=> $GROUPS['pass'],
											'repass'	=> $GROUPS['repass'],
											'autopass'	=> $GROUPS['autopass'],
											'button'	=> $BUTTONS['signup']
											)
						);
$FORMS['user_settings_name']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> URLSYSTEM.'?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'name'	=> $GROUPS['profilename'],
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_login1']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> URLSYSTEM.'?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'username'	=> $GROUPS['profileusername'],
											'userpass'	=> $GROUPS['activepass'],
											'pass'		=> $GROUPS['newpass'],
											'repass'	=> $GROUPS['newrepass'],
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_pass1']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> URLSYSTEM.'?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'userpass'	=> $GROUPS['activepass'],
											'pass'		=> $GROUPS['newpass'],
											'repass'	=> $GROUPS['newrepass'],
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_pass2']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> URLSYSTEM.'?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'pass'		=> $GROUPS['newpass'],
											'repass'	=> $GROUPS['newrepass'],
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_pic']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> URLSYSTEM.'?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'pic'		=> $GROUPS['pic'],
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_pic_upload']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> URLSYSTEM.'?tab=preferencias',
											'method'=> 'POST',
											'enctype'=>'multipart/form-data'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'pic'		=> $GROUPS['pic_upload']
											)
						);
$FORMS['user_settings_cover']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> URLSYSTEM.'?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'cover'		=> $GROUPS['cover'],
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_cover_upload']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> URLSYSTEM.'?tab=preferencias',
											'method'=> 'POST',
											'enctype'=>'multipart/form-data'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'cover'		=> $GROUPS['cover_upload']
											)
						);

$FORMS['user_settings_email']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> URLSYSTEM.'?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'email'	=> $GROUPS['notifemail']
											)
						);
