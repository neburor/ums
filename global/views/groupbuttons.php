<?php
#GroupButtons

$GROUPBUTTONS['profile']=array(
					'attr'		=>	array(
									'class'	=> 'btn-group navbar-btn pull-right'
									),
					'link'		=>	array(
									'attr'	=> array(
												'class'	=> 'btn btn-default profile',
												'href' 	=> URLSYSTEM
												),
									'content'	=> array(	
													'i'		=>'fa fa-user',
													'text'	=>'Mi perfil'
													)
									)
					'button'	=>	array(
									'attr' => array(
												'type'			=> 'button',
												'class' 		=> 'btn btn-default dropdown-toggle',
												'data-toggle'	=> 'dropdown',
												'aria-haspopup'	=> 'true',
												'aria-expanded'	=> 'false'
												),
									'content'  => array('text' => '<span class="caret"></span>')
									)
					'ul'		=> 
					);
