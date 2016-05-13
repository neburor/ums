<?php
#Buttons

$BUTTONS['message']=array(
					'attr'		=>	array(
									'type'	=> 'submit',
									'class'	=> 'btn btn-default'
									),
					'content'	=>	array(
									'i'=>'fa fa-envelope',
									'text'=>'Enviar mensaje'
									),
					'success'	=> array(
									'i'=>'fa fa-check-circle',
									'text'=>'Mensaje enviado'
									),
					'error'		=> array(
									'i'=>'fa fa-warning',
									'text'=>'Reintentar'
									)
					);
$BUTTONS['login']=array(
					'attr'		=>	array(
									'type'	=> 'submit',
									'class'	=>'btn btn-default'
									),
					'content'	=>	array(
									'i'=>'fa fa-sign-in',
									'text'=>'Iniciar sesion'
									),
					'success'	=> array(
									'i'=>'fa fa-check-circle',
									'text'=>'Sesion iniciada'
									),
					'warning'		=> array(
									'i'=>'fa fa-warning',
									'text'=>'Reintentar'
									)
					);
$BUTTONS['signup']=array(
					'attr'		=>	array(
									'type'	=> 'submit',
									'class'	=>'btn btn-default'
									),
					'content'	=>	array(
									'i'=>'fa fa-user-plus',
									'text'=>'Crear cuenta'
									),
					'success'	=> array(
									'i'=>'fa fa-check-circle',
									'text'=>'Cuenta creada'
									),
					'warning'		=> array(
									'i'=>'fa fa-warning',
									'text'=>'Reintentar'
									)
					);
$BUTTONS['reply']=array(
					'attr'		=> array(
									'type'	=> 'submit',
									'class'	=> 'btn btn-default'
										),
					'content'	=> array(
									'i'	=> 'fa fa-reply'
										)
					);
$BUTTONS['save']=array(
					'attr'		=> array(
									'type' 	=> 'submit',
									'class'	=> 'btn btn-default'
										),
					'content'	=> array(
									'i'=>'fa fa-save',
									'text'=>'Guardar cambios'
										),
					'success'	=> array(
									'i'=>'fa fa-check-circle',
									'text'=>'Cambios guardados'
									),
					'warning'		=> array(
									'i'=>'fa fa-warning',
									'text'=>'Reintentar'
									)
					);
$BUTTONS['resend']=array(
					'attr'		=> array(
									'type' 	=> 'submit',
									'class'	=> 'btn btn-default'
										),
					'content'	=> array(
									'i'=>'fa fa-send',
									'text'=>'Reenviar'
										)
					);