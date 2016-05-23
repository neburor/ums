<?php
#GROUPS
include 'alerts.php';
include 'checkboxs.php';
include 'inputs.php';
include 'textareas.php';
include 'selects.php';
include 'buttons.php';
include 'addons.php';
include 'links.php';

$GROUPS['name']=array(
					'attr'		=> array(
										'class'			=> 'form-group col-sm-6 col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Nombre',
										'label'			=> false,
										),
					'addon' 	=> $ADDONS['name'],
					'input'		=> $INPUTS['name'],
					'button'	=> false
					);
$GROUPS['username']=array(
					'attr'		=> array(
										'class'			=> 'form-group'
										),
					'params'	=> array(
										'display'		=> 'Nombre',
										'label'			=> false,
										),
					'addon' 	=> $ADDONS['name'],
					'input'		=> $INPUTS['username'],
					'button'	=> false
					);
$GROUPS['profileusername']=array(
					'attr'		=> array(
										'class'			=> 'form-group'
										),
					'params'	=> array(
										'display'		=> 'Nombre',
										'label'			=> 'Cambiar nombre de usuario',
										'text'			=> array(
																'content' => 'Dejar en blanco para iniciar con su correo electrónico.'
														)
										),
					'addon' 	=> $ADDONS['name'],
					'input'		=> $INPUTS['username'],
					'button'	=> false
					);
$GROUPS['profilename']=array(
					'attr'		=> array(
										'class'			=> 'form-group'
										),
					'params'	=> array(
										'display'		=> 'Nombre',
										'label'			=> 'Cambiar nombre de perfil:',
										'text'			=> array(
																'content' => 'Dejar en blanco para mostrar nombre de usuario o correo electrónico.'
														)
										),
					'addon' 	=> $ADDONS['name'],
					'input'		=> $INPUTS['profilename'],
					'button'	=> false
					);
$GROUPS['email']=array(
					'attr'		=> array(
										'class'			=> 'form-group col-sm-6 col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Correo',
										'label'			=> false,
										),
					'addon' 	=> $ADDONS['email'],
					'input'		=> $INPUTS['email'],
					'button'	=> false
					);
$GROUPS['useremail']=array(
					'attr'		=> array(
										'class'			=> 'form-group col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Correo',
										'label'			=> false,
										),
					'addon' 	=> $ADDONS['email'],
					'input'		=> $INPUTS['useremail'],
					'button'	=> false
					);
$GROUPS['notifemail']=array(
					'attr'		=> array(
										'class'			=> 'form-group col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Correo',
										'label'			=> 'Recibir notificaciones por correo',
										),
					'addon' 	=> $ADDONS['email'],
					'input'		=> $INPUTS['notifemail'],
					'button'	=> $BUTTONS['save']
					);

$GROUPS['userpass']=array(
					'attr'		=> array(
										'class'			=> 'form-group col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Contraseña',
										'label'			=> false,
										),
					'addon' 	=> $ADDONS['pass'],
					'input'		=> $INPUTS['userpass'],
					'button'	=> false
					);
$GROUPS['activepass']=array(
					'attr'		=> array(
										'class'			=> 'form-group col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Contraseña actual',
										'label'			=> 'Cambiar contraseña:',
										),
					'addon' 	=> $ADDONS['pass'],
					'input'		=> $INPUTS['activepass'],
					'button'	=> false
					);
$GROUPS['pass']=array(
					'attr'		=> array(
										'class'			=> 'form-group col-sm-6 col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Contraseña',
										'label'			=> false,
										),
					'addon' 	=> $ADDONS['key'],
					'input'		=> $INPUTS['pass'],
					'button'	=> false
					);
$GROUPS['repass']=array(
					'attr'		=> array(
										'class'			=> 'form-group col-sm-6 col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Confirmar contraseña',
										'label'			=> false,
										),
					'addon' 	=> $ADDONS['key'],
					'input'		=> $INPUTS['repass'],
					'button'	=> false
					);
$GROUPS['newpass']=array(
					'attr'		=> array(
										'class'			=> 'form-group col-sm-6 col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Contraseña nueva',
										'label'			=> false,
										),
					'addon' 	=> $ADDONS['key'],
					'input'		=> $INPUTS['newpass'],
					'button'	=> false
					);
$GROUPS['newrepass']=array(
					'attr'		=> array(
										'class'			=> 'form-group col-sm-6 col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Confirmacion de contrasela nueva',
										'label'			=> false,
										),
					'addon' 	=> $ADDONS['key'],
					'input'		=> $INPUTS['newrepass'],
					'button'	=> false
					);
$GROUPS['signon']=array(
					'attr'		=> array(
										'class'			=> 'form-group'
										),
					'params'	=> array(
										'display'		=> 'Crear cuenta',
										'label'			=> false
										),
					'addon' 	=> false,
					'checkbox'	=> $CHECKBOXS['signon'],
					'button'	=> false
					);
$GROUPS['autopass']=array(
					'attr'		=> array(
										'class'			=> 'form-group col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Contraseña Automatica',
										'label'			=> false
										),
					'addon' 	=> false,
					'checkbox'	=> $CHECKBOXS['autopass'],
					'button'	=> false
					);
$GROUPS['autologin']=array(
					'attr'		=> array(
										'class'			=> 'form-group'
										),
					'params'	=> array(
										'display'		=> 'Recordarme',
										'label'			=> false
										),
					'addon' 	=> false,
					'checkbox'	=> $CHECKBOXS['autologin'],
					'button'	=> false
					);

$GROUPS['message']=array(
					'attr'		=> array(
										'class'			=> 'form-group'
										),
					'params'	=> array(
										'display'		=> 'Mensaje',
										'label'			=> false
										),
					'addon' 	=> $ADDONS['message'],
					'textarea'	=> $TEXTAREAS['message'],
					'button'	=> false
					);
$GROUPS['reply']=array(
					'attr'		=> array(
										'class'			=> 'form-group'
										),
					'params'	=> array(
										'display'		=> 'Respuesta',
										'label'			=> false
										),
					'addon'		=> $ADDONS['message'],
					'input'		=> $INPUTS['reply'],
					'button'	=> $BUTTONS['reply']
					);
$GROUPS['pic']=array(
					'attr'		=> array(
										'class'			=> 'form-group'
										),
					'params'	=> array(
										'display'		=> 'Imagen de perfil',
										'label'			=> 'Seleccionar imagen de perfil:',
										'text'			=> array(
																'content' => 'Sube una imagen o conecta una red social.'
														)
										),
					'addon'		=> $ADDONS['image'],
					'select'	=> $SELECTS['pic'],
					'button'	=> false
					);
$GROUPS['pic_upload']=array(
					'attr'		=> array(
										'class'			=> 'col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Imagen de perfil',
										'label'			=> 'Subir o tomar foto para imagen de perfil:'
										),
					'input'		=> $INPUTS['pic'],
					'button'	=> $BUTTONS['upload']
					);
$GROUPS['cover']=array(
					'attr'		=> array(
										'class'			=> 'form-group'
										),
					'params'	=> array(
										'display'		=> 'Imagen de portada',
										'label'			=> 'Seleccionar imagen de portada:',
										'text'			=> array(
																'content' => 'Sube una imagen o conecta una red social.'
														)
										),
					'addon'		=> $ADDONS['image'],
					'select'	=> $SELECTS['cover'],
					'button'	=> false
					);
$GROUPS['cover_upload']=array(
					'attr'		=> array(
										'class'			=> 'col-xs-12'
										),
					'params'	=> array(
										'display'		=> 'Imagen de portada',
										'label'			=> 'Subir o tomar foto para imagen portada:'
										),
					'input'		=> $INPUTS['cover'],
					'button'	=> $BUTTONS['upload']
					);
