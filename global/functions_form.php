<?php
//Form Functions
function SpamForm($post)
{
	$resultado=SQLinsert(
            array(
                'table'=>'spam_form'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'],
                'url'=> 'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'),
                'formtype'=> $post['formtype'],
                'formid'=> $post['formid']
                )
            );
}
function FeedBackMessage($feedback)
{
	if(isset($feedback['alert']['success']))
	{
		$htmlMessage='
		<div class="media">
			<div class="media-left">
				<img src="'.ShowPic().'" class="profile-pic">
			</div>
			<div class="media-body">
				<span class="media-heading">
					<b>'.$_SESSION['logged']['name'].'</b> 
                	<small class="pull-right">Ahorita</small>
                 </span>
				<p>'.$feedback['message']['value'].'
				</p>
			</div>
			<div class="media-right">
				<i class="fa fa-check fa-2x"></i>
			</div>
		</div>
		';
		return $htmlMessage;
	}
}
function FeedBackComment($feedback,$toname)
{
	if(isset($feedback['alert']['success']))
	{
		$htmlComment='
		<div class="media">
			<div class="media-left">
				<img src="'.ShowPic().'" class="profile-pic">
			</div>
			<div class="media-body">
				<span class="media-heading">
					<b>'.$_SESSION['logged']['name'].'</b>';
		if(isset($toname))
		{
			$htmlComment.=' a <i>'.$toname.'</i>';
		}
		$htmlComment.=' 
                	<small class="pull-right">Ahorita</small>
                 </span>
				<p>'.$feedback['comment']['value'].'<br/>
				<small><i class="fa fa-info-circle"></i> Pendiente de aprovacion</small>
				</p>
			</div>
			<div class="media-right">
				<i class="fa fa-check fa-2x"></i>
			</div>
		</div>
		';
		return $htmlComment;
	}
}
function FeedBackValueOption($field=array(),$status=array())
{
	if($field['status'] && $status['show']==$status['status'])
	{
		if($field['status']!='nodata')
		{
			return '<option value="'.$field['value'].'" selected="selected">'.$field['value'].'</option>';
		}
	}
}
function FeedBackValueData($field=array(),$status=array())
{
	if($field['status'] && $status['show']==$status['status'])
	{
		if($field['status']!='nodata')
		{
			return $field['value'];
		}
	}
}
function FeedBackValue($field=array(),$status=array())
{
	if($field['status'] && $status['show']==$status['status'])
	{
		if($field['status']!='nodata')
		{
			return 'value="'.$field['value'].'"';
		}
	}
}
function FeedbackClass($field=array(),$status=array())
{
	if($field['status'] && $status['show']==$status['status'])
	{
		if($field['status']=='norequired')
		{
		}
		elseif($field['status']=='valid')
		{
			return ' has-feedback has-success';
		}
		elseif($field['status']!='valid')
		{
			return ' has-feedback has-warning';
		}
	}
}
function FeedbackIcon($field=array(),$status=array())
{
	if($field['status'] && $status['show']==$status['status'])
	{
		if($field['status']=='norequired')
		{
		}	
		elseif($field['status']=='valid')
		{
			return '<i class="fa fa-check form-control-feedback"></i>';
		}
		elseif($field['status']!='valid')
		{
			return '<i class="fa fa-warning form-control-feedback"></i>';
		}
	}
}
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
	if($feedback['alert'])
	{
		$htmlalert=FeedbackAlert($feedback['alert']);
	}
	else
	{
		$htmlalert='';
		$warningFields['count']= 0;
		$warningFields['content'] = '';

		foreach ($feedback as $key => $value) 
		{
			if($key!='button' && $key!='alert' && $key!='status')
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
		}

		if($warningFields['count']>0)
		{
			$htmlalert.=FeedbackAlert(array('warning'=>'Los siguientes campos son incorrectos: '.$warningFields['content']));
		}
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