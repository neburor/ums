<?php
#TABS
include 'forms.php';
include 'intros.php';

$TABS['contact']=array(
					'attr'	=> array(
								'class'	=> 'ums'
								),
					'nav'	=> array(
								'message'	=> array('i'=>'fa fa-edit','text'=>'Contactar'),
								'login'  	=> array('i'=>'fa fa-sign-in','text'=>'<span class="hidden-xxs">Iniciar sesion</span>'),
								'signup'	=> array('i'=>'fa fa-user-plus','text'=>'<span class="hidden-xxs">Registrarse</span>')
								),
					'tab'	=> array(
								'message' => '',
								'login'   => '',
								'signup'  => ''
								)
					);
$TABS['profile']=array(
					'attr'		=> array(
								'class'	=> 'ums'
								),
					'nav'	=> array(
								'login'  	=> array('i'=>'fa fa-sign-in','text'=>'Iniciar sesión'),
								'signup'	=> array('i'=>'fa fa-user-plus','text'=>'Registrarse')
								),
					'tab'	=> array(
								'login'   => array(
											'div' => array(
												'attr'		=> array( 'class' => 'col-sm-5'),
												'content'	=> array( 
																'intro'	=> $INTROS['login'], 
																'links'	=> array(
																		'label'		=> 'Conectarse con :',
																		'facebook'	=> $LINKS['login_facebook'],
																		'twitter'	=> $LINKS['login_twitter']
																			)
																)
														)
											),
								'signup'  => array(
											'div' => array(
												'attr'		=> array( 'class' => 'col-sm-5'),
												'content'	=> array( 
																'intro'	=> $INTROS['signup'], 
																'links'	=> array(
																		'facebook'	=> $LINKS['signup_facebook'],
																		'twitter'	=> $LINKS['signup_twitter']
																			)
																)
														)
											)
								)
					);