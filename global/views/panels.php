<?php
#Panels
include 'tabs.php';

$PANELS['contact']=array(
					'attr'		=> array('class'	=> 'panel panel-default messages'),
					'heading'	=> array('attr'		=> array('class'=> 'panel-heading navheading'),
										 'content'	=> array(
										 				'i'		=> 'fa fa-envelope fa-3x',
										 				'text'	=> array(
										 								'tag'=>'b',
										 								'content'=>'Contactanos'
										 								)
										 				)
										),
					'body'		=> array('attr'		=> array('class'=> 'panel-body'),
										 'content'	=> ''
										 ),
					'footer'	=> false
					);
$PANELS['comment']=array(
					'attr'		=> array('class'	=> 'panel panel-default comments'),
					'heading'	=> array('attr'		=> array('class'=> 'panel-heading navheading'),
										 'content'	=> array(
										 				'i'		=> 'fa fa-commenting fa-3x',
										 				'text'	=> array(
										 								'tag'=>'b',
										 								'content'=>'Comentarios'
										 								)
										 				)
										),
					'body'		=> array('attr'		=> array('class'=> 'panel-body'),
										 'content'	=> ''
										 ),
					'footer'	=> false
					);

$PANELS['profile']=array(
					'attr'		=> array('class'	=> 'panel panel-default'),
					'heading'	=> array('attr'		=> array('class'=> 'panel-heading navheading'),
										 'content'	=> ''
										),
					'body'		=> array('attr'		=> array('class'=> 'panel-body'),
										 'content'	=> ''
										 ),
					'footer'	=> false
					);