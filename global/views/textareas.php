<?php
#TEXTAREAS
global $VALIDATIONS;

$TEXTAREAS['message']=array(
					'attr'			=>	array(
										'class'			=> 'form-control',
										'name'			=> 'message',
										'placeholder'	=> 'Su mensaje a la administracion ...'
										),
					'validations'	=> $VALIDATIONS['message']
					);
$TEXTAREAS['comment']=array(
					'attr'			=>	array(
										'class'			=> 'form-control',
										'name'			=> 'comment',
										'placeholder'	=> 'Escriba su comentario ...'
										),
					'validations'	=> $VALIDATIONS['comment']
					);