<?php
#FORMS
include 'groups.php';

$FORMS['message']=array(
						'type'		=> 'contact',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'method'=> 'POST'	
											),
						'groups'	=> array(
											'alert'		=> false,
											'message'	=> $GROUPS['message'],
											'fieldset'	=> array(
												'attr'	=> array('class'=>'well well-sm'),
												'signup'=> true,
												'groups'=> array(
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
											'response'  => true,
											'button'	=> $BUTTONS['message']
											)
						);
$FORMS['comment']=array(
						'type'		=> 'comment',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'method'=> 'POST'	
											),
						'links'		=> array(
											'label'		=> 'Conectarse con :',
											'facebook'	=> $LINKS['login_facebook'],
											'twitter'	=> $LINKS['login_twitter']
											),
						'signup'	=> true,
						'groups'	=> array(
											'alert' 	=> false,
											'name'		=> $GROUPS['name'],
											'email'		=> $GROUPS['email'],
											'signon'	=> $GROUPS['signon'],
											'comment'	=> $GROUPS['comment'],
											'guest'		=> $GROUPS['guest'],
											'response'  => true,
											'button'	=> $BUTTONS['comment']
											)
						);
$FORMS['like']=array(
						'type'		=> 'like',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'method'=> 'POST'	
											),
						'links'		=> array(
											'label'		=> 'Conectarse con :',
											'facebook'	=> $LINKS['login_facebook'],
											'twitter'	=> $LINKS['login_twitter']
											),
						'signup'	=> false,
						'groups'	=> array(
											'alert' 	=> false,
											'name'		=> $GROUPS['name'],
											'email'		=> $GROUPS['email'],
											'signon'	=> $GROUPS['signon'],
											'response'  => true,
											'button'	=> $BUTTONS['like']
											)
						);
$FORMS['dislike']=array(
						'type'		=> 'dislike',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'method'=> 'POST'	
											),
						'links'		=> array(
											'label'		=> 'Conectarse con :',
											'facebook'	=> $LINKS['login_facebook'],
											'twitter'	=> $LINKS['login_twitter']
											),
						'signup'	=> false,
						'groups'	=> array(
											'alert' 	=> false,
											'name'		=> $GROUPS['name'],
											'email'		=> $GROUPS['email'],
											'signon'	=> $GROUPS['signon'],
											'response'  => true,
											'button'	=> $BUTTONS['dislike']
											)
						);
$FORMS['user_comment']=array(
						'type'		=> 'comment',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'method'=> 'POST'	
											),
						'groups'	=> array(
											'alert' 	=> false,
											'comment'	=> $GROUPS['comment_user'],
											'guest'		=> $GROUPS['guest'],
											'response'  => true,
											'button'	=> $BUTTONS['comment']
											)
						);
$FORMS['user_newmessage']=array(
						'type'		=> 'chat',
						'attr'		=> array(
											'class' => 'form col-xs-12',
										 	'role'	=> 'form',
										 	'action'=> '?tab=mensajes',
										 	'method'=> 'POST'	
											),
						'groups'	=> array(
											'alert' 	=> false,
											'message'	=> $GROUPS['message'],
											'response'	=> true,
											'button'	=> $BUTTONS['message']
											)
						);
$FORMS['message_user']=array(
						'type'		=> 'chat',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'action'=> '',
										 	'method'=> 'POST'	
											),
						'groups'	=> array(
											'alert' 	=> false,
											'message'	=> $GROUPS['message_user'],
											'response'	=> true,
											'button'	=> $BUTTONS['message']
											)
						);
$FORMS['user_message']=array(
						'type'		=> 'chat',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'action'=> '?tab=mensajes',
										 	'method'=> 'POST'	
											),
						'groups'	=> array(
											'alert' 	=> false,
											'response'	=> true,
											'message'	=> $GROUPS['lite_message']
											)
						);
$FORMS['login']=array(
						'type'		=> 'login',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'method'=> 'POST'	
											),
						'groups'	=> array(
											'alert' 	=> false,
											'useremail'	=> $GROUPS['useremail'],
											'userpass'	=> $GROUPS['userpass'],
											'autologin'	=> $GROUPS['autologin'],
											'response'	=> true,
											'button'	=> $BUTTONS['login']
											)
						);
$GROUPS['username']['attr']['class']=$GROUPS['useremail']['attr']['class']='form-group col-xs-12';
$FORMS['signup']=array(
						'type'		=> 'signup',
						'attr'		=> array(
											'class' => 'form',
										 	'role'	=> 'form',
										 	'action'=> '?signup',
										 	'method'=> 'POST'	
											),
						'groups'	=> array(
											'alert' 	=> false,
											'username'	=> $GROUPS['username'],
											'useremail'	=> $GROUPS['useremail'],
											'pass'		=> $GROUPS['pass'],
											'repass'	=> $GROUPS['repass'],
											'autopass'	=> $GROUPS['autopass'],
											'response'	=> true,
											'button'	=> $BUTTONS['signup']
											)
						);
$FORMS['user_settings_name']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> '?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'name'	=> $GROUPS['profilename'],
											'response'	=> true,
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_login1']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> '?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'username'	=> $GROUPS['profileusername'],
											'userpass'	=> $GROUPS['activepass'],
											'pass'		=> $GROUPS['newpass'],
											'repass'	=> $GROUPS['newrepass'],
											'response'	=> true,
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_pass1']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> '?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'userpass'	=> $GROUPS['activepass'],
											'pass'		=> $GROUPS['newpass'],
											'repass'	=> $GROUPS['newrepass'],
											'response'	=> true,
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_pass2']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> '?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'pass'		=> $GROUPS['newpass'],
											'repass'	=> $GROUPS['newrepass'],
											'response'	=> true,
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_pic']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> '?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'pic'		=> $GROUPS['pic'],
											'response'	=> true,
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_pic_upload']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> '?tab=preferencias',
											'method'=> 'POST',
											'enctype'=>'multipart/form-data'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'response'	=> true,
											'pic'		=> $GROUPS['pic_upload']
											)
						);
$FORMS['user_settings_cover']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> '?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'cover'		=> $GROUPS['cover'],
											'response'	=> true,
											'button'	=> $BUTTONS['save']
											)
						);
$FORMS['user_settings_cover_upload']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> '?tab=preferencias',
											'method'=> 'POST',
											'enctype'=>'multipart/form-data'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'response'	=> true,
											'cover'		=> $GROUPS['cover_upload']
											)
						);

$FORMS['user_settings_email']=array(
						'type'		=> 'settings',
						'attr'		=> array(
											'class'	=> 'form',
											'role'	=> 'form',
											'action'=> '?tab=preferencias',
											'method'=> 'POST'
											),
						'groups'	=> array(
											'alert' 	=> false,
											'response'	=> true,
											'email'	=> $GROUPS['notifemail']
											)
						);
