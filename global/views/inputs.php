<?php
#INPUTS
global $VALIDATIONS;

$INPUTS['name']=array(
					'attr'			=>	array(
										'type'			=> 'text',
										'class'			=> 'form-control',
										'name'			=> 'name',
										'placeholder'	=> 'Su Nombre ...'
										),
					'validations'	=> $VALIDATIONS['name']
					);
$INPUTS['username']=array(
					'attr'			=>	array(
										'type'			=> 'text',
										'class'			=> 'form-control',
										'name'			=> 'username',
										'placeholder'	=> 'Su Nombre ...'
										),
					'validations'	=> $VALIDATIONS['username']
					);
$INPUTS['profilename']=array(
					'attr'			=>	array(
										'type'			=> 'text',
										'class'			=> 'form-control',
										'name'			=> 'name',
										'placeholder'	=> 'Nombre de perfil'
										),
					'validations'	=> $VALIDATIONS['name']
					);
$INPUTS['email']=array(
					'attr'			=>	array(
										'type'			=> 'email',
										'class'			=> 'form-control',
										'name'			=> 'email',
										'placeholder'	=> 'Su correo ...'
										),
					'validations'	=> $VALIDATIONS['email']
					);
$INPUTS['useremail']=array(
					'attr'			=>	array(
										'type'			=> 'email',
										'class'			=> 'form-control',
										'name'			=> 'useremail',
										'placeholder'	=> 'Su correo ...'
										),
					'validations'	=> $VALIDATIONS['email']
					);
$INPUTS['notifemail']=array(
					'attr'			=>	array(
										'type'			=> 'email',
										'class'			=> 'form-control',
										'name'			=> 'email',
										'placeholder'	=> 'Correo electronico'
										),
					'validations'	=> $VALIDATIONS['email']
					);
$INPUTS['notiftwitter']=array(
					'attr'			=>	array(
										'type'			=> 'text',
										'class'			=> 'form-control',
										'name'			=> 'twitter',
										'placeholder'	=> 'Twitter'
										),
					'validations'	=> $VALIDATIONS['twitter']
					);
$INPUTS['userpass']=array(
					'attr'			=>	array(
										'type'			=> 'password',
										'class'			=> 'form-control',
										'name'			=> 'userpass',
										'placeholder'	=> 'Su contraseña ...'
										),
					'validations'	=> $VALIDATIONS['userpass']
					);
$INPUTS['activepass']=array(
					'attr'			=>	array(
										'type'			=> 'password',
										'class'			=> 'form-control',
										'name'			=> 'userpass',
										'placeholder'	=> 'Su contraseña actual...'
										),
					'validations'	=> $VALIDATIONS['userpass']
					);
$INPUTS['pass']=array(
					'attr'			=>	array(
										'type'			=> 'password',
										'class'			=> 'form-control',
										'name'			=> 'pass',
										'placeholder'	=> 'Su contraseña ...'
										),
					'validations'	=> $VALIDATIONS['pass']
					);
$INPUTS['repass']=array(
					'attr'			=>	array(
										'type'			=> 'password',
										'class'			=> 'form-control',
										'name'			=> 'repass',
										'placeholder'	=> 'Repetir contraseña ...'
										),
					'validations'	=> $VALIDATIONS['pass']
					);
$INPUTS['newpass']=array(
					'attr'			=>	array(
										'type'			=> 'password',
										'class'			=> 'form-control',
										'name'			=> 'pass',
										'placeholder'	=> 'Contraseña nueva ...'
										),
					'validations'	=> $VALIDATIONS['pass']
					);
$INPUTS['newrepass']=array(
					'attr'			=>	array(
										'type'			=> 'password',
										'class'			=> 'form-control',
										'name'			=> 'repass',
										'placeholder'	=> 'Repetir contraseña nueva...'
										),
					'validations'	=> $VALIDATIONS['pass']
					);
$INPUTS['reply']=array(
					'attr'			=>	array(
										'type'			=> 'text',
										'class'			=> 'form-control',
										'name'			=> 'reply',
										'placeholder'	=> 'Su respuesta ...'
										),
					'validations'	=> $VALIDATIONS['reply']
					);
$INPUTS['pic']=array(
					'attr'			=>	array(
										'type'			=> 'file',
										'class'			=> 'form-control upload',
										'name'			=> 'pic'
										)
					);
$INPUTS['cover']=array(
					'attr'			=>	array(
										'type'			=> 'file',
										'class'			=> 'form-control upload',
										'name'			=> 'cover'
										)
					);