<?php
#VALIDATIONS

$VALIDATIONS['name'] 	  = array(
							'pregmatch' => '^[a-zA-Z áéíóúüñÁÉÍÓÚÜÑ]*$',
							'minlength'	=> 4,
							'maxlength'	=> 64,
							'required'	=> true
							);
$VALIDATIONS['username']  = $VALIDATIONS['twitter'] = array(
							'pregmatch' => '^[a-zA-Z0-9 áéíóúüñÁÉÍÓÚÜÑ]*$',
							'minlength'	=> 4,
							'maxlength'	=> 64,
							'required'	=> true
							);
$VALIDATIONS['useremail'] = $VALIDATIONS['email'] = array(
							'pregmatch' => '^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$',
							'minlength'	=> 8,
							'maxlength'	=> 64,
							'required'	=> true
							);
$VALIDATIONS['userpass'] = $VALIDATIONS['pass']	= array(
							'pregmatch' => false,
							'minlength'	=> 4,
							'maxlength'	=> 32,
							'required'	=> false
							);
$VALIDATIONS['userpass']['required']=true;
$VALIDATIONS['action']	= array(
							'pregmatch' => '^[a-z]*$',
							'minlength'	=> 0,
							'maxlength'	=> 12,
							'required'	=> false
							);
$VALIDATIONS['message']	= array(
							'pregmatch' => false,
							'minlength'	=> 8,
							'maxlength'	=> 512,
							'required'	=> true
							);
$VALIDATIONS['reply']	= array(
							'pregmatch' => false,
							'minlength'	=> 8,
							'maxlength'	=> 512,
							'required'	=> true
							);
$VALIDATIONS['comment']	= array(
							'pregmatch' => false,
							'minlength'	=> 8,
							'maxlength'	=> 512,
							'required'	=> true
							);