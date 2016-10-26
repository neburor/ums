<?php
//Form Functions
function FeedbackButton ($type,$button)
{
	if($button==NULL)
	{
		if ($type=='message') 
		{
			return '<i class="fa fa-envelope"></i> Enviar mensaje';
		}
	}
	else
	{
		if ($type=='message') 
		{
			if($button=='success')
			{
				return '<i class="fa fa-check-circle"></i> Mensaje enviado';
			}
			if($button=='warning')
			{
				return '<i class="fa fa-envelope"></i> Enviar mensaje';
			}
		}
	}
}
function Feedback ($feedback=array())
{
	$htmlalert='';
	$warningFields['count']= 0;
	$warningFields['content'] = '';

	foreach ($feedback as $key => $value) 
	{
		if($key!='button' && $key!='alert')
		{
			if($value['status']!='valid' && $value['status']!='norequired')
			{
				$warningFields['count']++;

				if($warningFields['count']>1)
				{
					$warningFields['content'].= ', ';
				}
				$warningFields['content'].='<b>'.$value['display'].'</b>';
			}
		}
		if($key=='alert')
		{
			$htmlalert.=FeedbackAlert($value);
		}
	}

	if($warningFields['count']>0)
	{
		$htmlalert.=FeedbackAlert(array('warning'=>'Los siguientes campos son incorrectos: '.$warningFields['content']));
	}
	
	return $htmlalert;
}
function FeedbackAlert($alert=array())
{
	foreach ($alert as $key => $value) {
		if($key=='info')
		{
			$htmlalert.='<div class="alert alert-info alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-info-circle"></i></b> '.$value.'</div>';
		}
		if($key=='warning')
		{
			$htmlalert.='<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-warning"></i> Error ! </b> '.$value.'</div>';
		}
		if($key=='success')
		{
			$htmlalert.='<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-check-circle"></i> Correcto !</b> '.$value.'</div>';
		}
		if($key=='danger')
		{
			$htmlalert.='<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-times-circle"></i> Error !</b> '.$value.'</div>';
		}
	}

	return $htmlalert;
}