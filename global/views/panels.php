<?php
#Panels
include 'tabs.php';

$PANELS['contact']=array(
					'attr'		=> array('class'	=> 'panel panel-default'),
					'heading'	=> array('attr'		=> array('class'=> 'panel-heading'),
										 'content'	=> array('i'=>'fa fa-envelope','text'=>'Contactanos')
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