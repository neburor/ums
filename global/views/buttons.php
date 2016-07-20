<?php
#Buttons

$BUTTONS['message']=array(
					'attr'		=>	array(
									'type'	=> 'submit',
									'class'	=> 'btn btn-default'
									),
					'content'	=>	array(
									'i'=>'fa fa-envelope',
									'text'=> array(	'class' => false,
													'content'	=> 'Enviar mensaje'
													)
									),
					'success'	=> array(
									'i'=>'fa fa-check-circle',
									'text'=> array(	'class' => false,
													'content'	=> 'Mensaje enviado'
													)
									),
					'warning'		=> array(
									'i'=>'fa fa-warning',
									'text'=> array(	'class' => false,
													'content'	=> 'Reintentar'
													)
									)
					);
$BUTTONS['comment']=array(
					'attr'		=>	array(
									'type'	=> 'submit',
									'class'	=> 'btn btn-default btn-block'
									),
					'content'	=>	array(
									'text'=> array(	'class' => false,
													'content'	=> 'Agregar comentario'
													),
									'i'=>'fa fa-share'
									),
					'success'	=> array(
									'i'=>'fa fa-check-circle',
									'text'=> array(	'class' => false,
													'content'	=> 'Comentario enviado'
													)
									),
					'warning'		=> array(
									'i'=>'fa fa-warning',
									'text'=> array(	'class' => false,
													'content'	=> 'Reintentar'
													)
									)
					);
$BUTTONS['like']=array(
					'attr'		=>	array(
									'type'	=> 'submit',
									'class'	=> 'btn btn-default'
									),
					'content'	=>	array(
									'i'		=> 'fa fa-thumbs-o-up',
									'text'	=> array(	'class' => false,
														'content'	=> 'Me gusta'
													)
									),
					'success'	=> array(
									'i'		=> 'fa fa-check-circle',
									'text'	=> array(	'class' => false,
														'content'	=> 'Correcto'
													)
									),
					'warning'	=> array(
									'i'		=> 'fa fa-warning',
									'text'	=> array(	'class' => false,
														'content'	=> 'Reintentar'
													)
									)
					);
$BUTTONS['dislike']=array(
					'attr'		=>	array(
									'type'	=> 'submit',
									'class'	=> 'btn btn-default'
									),
					'content'	=>	array(
									'i'		=> 'fa fa-thumbs-o-down',
									'text'	=> array(	'class' => false,
														'content'	=> 'No me gusta'
													)
									),
					'success'	=> array(
									'i'		=> 'fa fa-check-circle',
									'text'	=> array(	'class' => false,
														'content'	=> 'Correcto'
													)
									),
					'warning'	=> array(
									'i'		=> 'fa fa-warning',
									'text'	=> array(	'class' => false,
														'content'	=> 'Reintentar'
													)
									)
					);
$BUTTONS['login']=array(
					'attr'		=>	array(
									'type'	=> 'submit',
									'class'	=>'btn btn-default'
									),
					'content'	=>	array(
									'i'=>'fa fa-sign-in',
									'text'=> array(	'class' => false,
													'content'	=> 'Iniciar sesion'
													)
									),
					'success'	=> array(
									'i'=>'fa fa-check-circle',
									'text'=> array(	'class' => false,
													'content'	=> 'Sesion iniciada'
													)
									),
					'warning'		=> array(
									'i'=>'fa fa-warning',
									'text'=> array(	'class' => false,
													'content'	=> 'Reintentar'
													)
									)
					);
$BUTTONS['signup']=array(
					'attr'		=>	array(
									'type'	=> 'submit',
									'class'	=>'btn btn-default'
									),
					'content'	=>	array(
									'i'=>'fa fa-user-plus',
									'text'=> array(	'class' => false,
													'content'	=> 'Crear cuenta'
													)
									),
					'success'	=> array(
									'i'=>'fa fa-check-circle',
									'text'=> array(	'class' => false,
													'content'	=> 'Cuenta creada'
													)
									),
					'warning'		=> array(
									'i'=>'fa fa-warning',
									'text'=> array(	'class' => false,
													'content'	=> 'Reintentar'
													)
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
									'text'=> array(	'class' => false,
													'content'	=> 'Guardar cambios'
													)
										),
					'success'	=> array(
									'i'=>'fa fa-check-circle',
									'text'=> array(	'class' => false,
													'content'	=> 'Cambios guardados'
													)
									),
					'warning'		=> array(
									'i'=>'fa fa-warning',
									'text'=> array(	'class' => false,
													'content'	=> 'Reintentar'
													)
									)
					);
$BUTTONS['resend']=array(
					'attr'		=> array(
									'type' 	=> 'submit',
									'class'	=> 'btn btn-default'
										),
					'content'	=> array(
									'i'=>'fa fa-send',
									'text'=> array(	'class' => 'hidden-xs',
													'content'	=> 'Reenviar'
													)
										)
					);
$BUTTONS['activate']=array(
					'attr'		=> array(
									'type' 	=> 'submit',
									'class'	=> 'btn btn-default'
										),
					'content'	=> array(
									'text'=> array('content'	=> 'Activar'
													)
										)
					);
$BUTTONS['upload']=array(
					'attr'		=> array(
									'type' 	=> 'submit',
									'class'	=> 'btn btn-default'
										),
					'content'	=> array(
									'i'=>'fa fa-upload',
									'text'=> array( 'class' => 'hidden-xs',
													'content'	=> 'Subir'
													)
										)
					);