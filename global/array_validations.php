<?php
#VALIDATIONS

$VALIDATIONS['name'] 	  = array(
							'display'	=> 'Nombre',
							'pregmatch' => '^[a-zA-Z0-9 áéíóúüñÁÉÍÓÚÜÑ]*$',
							'minlength'	=> 4,
							'maxlength'	=> 64,
							'required'	=> true
							);
$VALIDATIONS['username']  = $VALIDATIONS['twitter'] = array(
							'display'	=> 'Nombre',
							'pregmatch' => '^[a-zA-Z0-9 áéíóúüñÁÉÍÓÚÜÑ]*$',
							'minlength'	=> 4,
							'maxlength'	=> 64,
							'required'	=> true
							);
$VALIDATIONS['useremail'] = $VALIDATIONS['email'] = array(
							'display'	=> 'Correo',
							'pregmatch' => '^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$',
							'minlength'	=> 8,
							'maxlength'	=> 64,
							'required'	=> true
							);
$VALIDATIONS['userpass'] = $VALIDATIONS['pass']	= $VALIDATIONS['newpass']=array(
							'display'	=> 'Contraseña',
							'pregmatch' => false,
							'minlength'	=> 4,
							'maxlength'	=> 32,
							'required'	=> false
							);
$VALIDATIONS['userpass']['required']=$VALIDATIONS['newpass']['required']=true;
$VALIDATIONS['action']	= array(
							'pregmatch' => '^[a-z]*$',
							'minlength'	=> 0,
							'maxlength'	=> 12,
							'required'	=> false
							);
$VALIDATIONS['message']	= array(
							'display'	=> 'Mensaje',
							'pregmatch' => false,
							'minlength'	=> 8,
							'maxlength'	=> 512,
							'required'	=> true
							);
$VALIDATIONS['comment']	= array(
							'display'	=> 'Comentario',
							'pregmatch' => false,
							'minlength'	=> 8,
							'maxlength'	=> 1024,
							'required'	=> true
							);
$VALIDATIONS['reply']	= array(
							'pregmatch' => false,
							'minlength'	=> 8,
							'maxlength'	=> 512,
							'required'	=> true
							);
$VALIDATIONS['pic']= array(
							'pregmatch' => '\.(?:jpe?g|png|gif)$',
							'filesize'	=> 204800, //(200Kb)
							'minlength'	=> 4,
							'maxlength'	=> 512,
							'accept'	=> 'image/*',
							'multiple'	=> false,
							'required'  => true
							);
$VALIDATIONS['cover']= $VALIDATIONS['imgwiki'] = array(
							'pregmatch' => '\.(?:jpe?g|png|gif)$',
							'filesize'	=> 2097152, // (2Mb)
							'minlength'	=> 4,
							'maxlength'	=> 512,
							'accept'	=> 'image/*',
							'multiple'	=> false,
							'required'  => true
							);
$VALIDATIONS['term']	= array(
							'display'	=> 'Término',
							'pregmatch' => false,
							'minlength'	=> 4,
							'maxlength'	=> 64,
							'required'	=> true
							);
$VALIDATIONS['description']	= array(
							'display'	=> 'Descripción',
							'pregmatch' => false,
							'minlength'	=> 8,
							'maxlength'	=> 512,
							'required'	=> true
							);