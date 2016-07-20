<?php
#CHECKBOXS
global $VALIDATIONS;

$CHECKBOXS['autologin']=array(
					'attr'			=>	array(
										'type'			=> 'checkbox',
										'name'			=> 'autologin',
										'checked'		=> true,
										'placeholder'	=> ' Recordarme !'
										),
					'validations'	=> $VALIDATIONS['action']
					);
$CHECKBOXS['autopass']=array(
					'attr'			=>	array(
										'type'			=> 'checkbox',
										'name'			=> 'autopass',
										'checked'		=> false,
										'placeholder'	=> ' Contraseña automatica !'
										),
					'validations'	=> $VALIDATIONS['action']
					);
$CHECKBOXS['signon']=array(
					'attr'			=>	array(
										'type'			=> 'checkbox',
										'name'			=> 'funnel',
										'value'			=> 'signon',
										'checked'		=> true,
										'placeholder'	=> ' Crear cuenta GRATIS !'
										),
					'validations'	=> $VALIDATIONS['action']
					);
$CHECKBOXS['guest']=array(
					'attr'			=>	array(
										'type'			=> 'checkbox',
										'name'			=> 'guest',
										'checked'		=> false,
										'placeholder'	=> ' Publicar como anonimo'
										),
					'validations'	=> $VALIDATIONS['action']
					);