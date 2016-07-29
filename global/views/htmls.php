<?php
#Arrays to HTML
include 'functions.php';

function HTML($id,$params)
{
	if(isset($_SESSION['views'][$id]))//Buscar View en la sesion
	{
		$viewArray = $_SESSION['views'][$id];
	}
	else //Buscar View local
	{	global $LOCALVIEWS;
		if(isset($LOCALVIEWS[$id]))
		{	
			#$_SESSION['views'][$id]=$viewArray=$LOCALVIEWS[$id];
			$viewArray=$LOCALVIEWS[$id];
		}
		else// Buscar view por API
		{
			#Buscar en APIrest code
		}
	}

	if($viewArray)
	{
		foreach ($viewArray as $view => $value) {
			if($view=='panel')
			{
				$html.=htmlPANEL($value['id'],$value['data'],$params);//el panel
			}
			if($view=='tab')
			{
				$html.=htmlTAB($value['id'],$value['data'],$params);//el tab
			}
			if($view=='form')
			{
				$html.=htmlFORM($value['id'],$value['data']);//el formulario
			}
			if($view=='groupbutton')
			{
				$html.=htmlGROUPBUTTON($value['data']);//el group button
			}
			if($view=='div')
			{
				$html.=htmlDIV($value['data']);//el group button
			}
			if($view=='list-group')
			{
				$html.=htmllistgroup($value,$params);
			}
		}
	}

	return $html;
}
function htmlPANEL($id,$panel,$params)
{
	if($panel['attr'])
	{
		$htmlPANEL='<div ';
		foreach ($panel['attr'] as $attr => $value) 
		{
			$htmlPANEL.=$attr.'="'.$value.'"';
		}
	}
	else
	{
		$htmlPANEL='<div class="panel panel-default"';
	}
	if($id)
	{
		$htmlPANEL.=' id="'.$id.'"';
	}
	$htmlPANEL.='>';
	
	if($panel['heading']['attr'])
	{
		$htmlPANEL.='<div ';
		foreach ($panel['heading']['attr'] as $attr => $value) 
		{
			$htmlPANEL.=$attr.'="'.$value.'"';
		}
		$htmlPANEL.='>';
	}
	else
	{
		$htmlPANEL.='<div class="panel-heading">';
	}

	if($panel['heading']['content'])
	{
		foreach ($panel['heading']['content'] as $content => $value) 
		{
			$i++;
			if($i>0)
			{
				$htmlPANEL.=' ';
			}
			if($content=='i')
			{
				$htmlPANEL.=htmliconfont($value);
			}
			if($content=='text')
			{
				$htmlPANEL.=htmltext($value);
			}
			if($content=='tabnav')
			{
				$htmlPANEL.=htmltabnav($id,$value,$params);
			}
		}
	}
	$htmlPANEL.='</div>';

	if($panel['body']['attr'])
	{
		$htmlPANEL.='<div ';
		foreach ($panel['body']['attr'] as $attr => $value) 
		{
			$htmlPANEL.=$attr.'="'.$value.'"';
		}

		$htmlPANEL.='>';
	}
	else
	{
		$htmlPANEL.='<div class="panel-body">';
	}

	if($panel['body']['content'])
	{
		foreach ($panel['body']['content'] as $content => $value) 
		{
			$i++;
			if($i>0)
			{
				$htmlPANEL.=' ';
			}
			if($content=='tab')
			{
				$htmlPANEL.=htmlTAB($value);
			}
			if($content=='form')
			{
				$htmlPANEL.=htmlFORM($value['id'],$value['data']);
			}
			if($content=='tabpanel')
			{
				$htmlPANEL.=htmltabpanel($id,$value,$params);
			}	
		}
	}

	$htmlPANEL.='</div>';

	if($panel['list-group'])
			{
				$htmlPANEL.=htmllistgroup($panel['list-group'],$params);
			}

	$htmlPANEL.='</div>';

	return $htmlPANEL;
}
function htmllistgroup($list,$params)
{
	$htmllist='<ul class="list-group list-striped">';
	foreach ($list as $li => $value) 
	{
		$htmllist.='<li class="list-group-item">';
			foreach ($value as $key => $content) 
			{
				if($key=='media')
				{
					$htmllist.=htmlMedia($content,$params);
				}
				if($key=='tab')
				{
					$htmllist.=htmlTAB($content['id'],$content['data'],$params);
				}
				if($key=='text')
				{
					$htmllist.=htmltext($content);;
				}
			}
			
		$htmllist.='</li>';
	}
	
	$htmllist.='</ul>';

	return $htmllist;
}
function htmlMedia($media,$params)
{
	$htmlmedia='<div class="media" itemprop="comment" itemscope itemtype="http://schema.org/UserComments">';
	if($media['left'])
	{
		$htmlmedia.='<div class="media-left">';
		foreach ($media['left'] as $key => $value) 
		{
			if($key=='img')
			{
				$htmlmedia.=htmlIMG($value);
			}
		}
		$htmlmedia.='</div>';	
	}
	if($media['body'])
	{
		$htmlmedia.='<div class="media-body">';
		foreach ($media['body'] as $key => $value) 
		{
			if($key=='text')
			{
				$htmlmedia.=htmltext($value);
			}
			if($key=='heading')
			{
				$htmlmedia.=htmlMediaheading($value);
			}
			if($key=='tab')
			{
				$htmlmedia.=htmlTAB($value['id'],$value['data'],$params);
			}
			if($key=='form')
			{
				$htmlmedia.=htmlFORM($value['id'],$value['data']);
			}
			if($key=='likes' || $key=='responses')
			{
				$htmlmedia.='<small>'.htmlLRcomment($key,$value).'</small>';
			}
		}
		$htmlmedia.='</div>';
	}
	$htmlmedia.='</div>';

	return $htmlmedia;
}
function htmlLRcomment($type,$data)
{
	$htmlLR='';
	if($type=='likes')
	{
		$htmlLR.=htmltext($data).' Me gusta';
	}
	if($type=='responses')
	{
		$htmlLR.=' '.htmltext($data).' Respuestas';
	}

	return $htmlLR;
}
function htmlMediaheading($heading)
{
	$htmlheading='<span class="media-heading">';
	
	foreach ($heading as $key => $value) 
	{
		if($key=='text')
		{
			$htmlheading.='<span itemprop="creator" itemscope itemtype="http://schema.org/Person">'.htmltext($value).'</span>';
		}
		if($key=='time')
		{
			$htmlheading.='<small class="pull-right">'.htmlAgo($value['datetime']).'<span class="sr-only"itemprop="commentTime" datetime="'.$value['iso8601'].'">'.$value['datetime'].'</span></small>';
		}
		
	}
	$htmlheading.='</span>';
	
	return $htmlheading;
}
function htmlAgo($time)
{
	$date=Interval($time);

	$htmlago.='<span class="hidden-xxs">Hace </span>'.$date[0].' <span class="hidden-xxs">'.$date[1].'</span><span class="visible-xxs">'.$date[2].'</span>';

	return $htmlago;
}
function htmlIMG($img)
{
	$htmlimg='<img';
	foreach ($img as $attr => $value) {
		$htmlimg.=' '.$attr.'="'.$value.'"';
	}
	$htmlimg.='>';
	return $htmlimg;
}
function htmlTAB($id,$tabs,$params)
{
	if($tabs['params'])
	{
		$params = array_merge($tabs['params'], $params);
	}

	if($tabs['attr'])
	{
		$htmlTAB='<div ';
		foreach ($tabs['attr'] as $attr => $value) 
		{
			$htmlTAB.=$attr.'="'.$value.'"';
		}
	}
	else
	{
		$htmlTAB='<div';
	}
	if($id)
	{
		$htmlTAB.=' id="'.$id.'"';
	}
	$htmlTAB.='>';

	$htmlTAB.=htmltabnav($id,$tabs['nav'],$params);
	$htmlTAB.=htmltabpanel($id,$tabs['tab'],$params);

	$htmlTAB.='</div>';

	return $htmlTAB;
}
function htmlDIV($div,$callback)
{
	if($div['attr'])
	{
		$htmlDIV='<div ';
		foreach ($div['attr'] as $attr => $value) 
		{
			$i++;
			if($i>0)
			{
				$htmlDIV.=' ';
			}

			$htmlDIV.=$attr.'="'.$value.'"';
		}
		$htmlDIV.='>';
	}
	else
	{
		$htmlDIV='<div class="col-xs-12">';
	}

	foreach ($div['content'] as $content => $value) {
		if($content=='intro')
		{
			$htmlDIV.=$value;
		}
		if($content=='links')
		{
			$htmlDIV.='<div class="form-group">'.htmllinks($value,$callback).'</div>';
		}
	}
	 $htmlDIV.='</div>';

	return $htmlDIV;
}
function htmlFORM($id,$form,$params)
{
	foreach ($form['groups'] as $group => $value) 
	{
		if(isset($_SESSION['feedback'][$id][$group]['status']))
		{
			$feedback=$_SESSION['feedback'][$id][$group]['status'];
			if($feedback!='valid' && $feedback!='norequired')
  			{
  				$warningFields++;
  				$alertfields[$value['params']['display']]=$feedback;
  			}
		}

		if($group=='fieldset' && $value)
		{
			foreach ($value['groups'] as $FSgroup => $FSvalue) 
			{
				if(isset($_SESSION['feedback'][$id][$FSgroup]['status']))
				{
					$feedback=$_SESSION['feedback'][$id][$FSgroup]['status'];
					if($feedback!='valid' && $feedback!='norequired')
  					{
  						$warningFields++;
  						$alertfields[$FSvalue['params']['display']]=$feedback;
  					}
				}
			}
		}
	}

	if($form['attr'])
	{
		$htmlFORM='<form ';
		foreach ($form['attr'] as $attr => $value) 
		{
			$i++;
			if($i>0)
			{
				$htmlFORM.=' ';
			}

			$htmlFORM.=$attr.'="'.$value.'"';
		}
		$htmlFORM.='>';
	}
	else
	{
		$htmlFORM='<form method="POST" action="">';
	}

	if($id)
	{
		$htmlFORM.='<input type="hidden" name="formid" value="'.$id.'">';
	}
	if($form['type'])
	{
		$htmlFORM.='<input type="hidden" name="formtype" value="'.$form['type'].'">';
	}
	if($params['callback'])
	{
		$htmlFORM.='<input type="hidden" name="callback" value="'.$params['callback'].'">';
	}
	foreach ($form['hidden'] as $hidden => $value) {
		$htmlFORM.='<input type="hidden" name="'.$hidden.'" value="'.$value.'">';	
	}
	if($form['links'])
	{	
		$htmlFORM.='<div class="form-group">'.htmllinks($form['links'],$params['callback']).'</div>';
	}
	if($form['signup'])
	{
		$htmlFORM.=htmlSignup($params['tab']);
	}

	foreach ($form['groups'] as $group => $value) 
	{
		
		if($group=='alert')
		{
			if($_SESSION['feedback'][$id]['alert'])
			{
				$htmlFORM.=alerts($_SESSION['feedback'][$id]['alert']);
			}
			elseif($warningFields)
			{
				$htmlFORM.=alerts(fieldList($alertfields));
			}
			elseif($value)
			{
				$htmlFORM.=alerts($value);
			}
		}
		if($group=='button' && $value)
		{
			$htmlFORM.='<div class="form-group col-xs-12">';
			if(isset($_SESSION['feedback'][$id]['button']))
			{
				$btn_feedback=$_SESSION['feedback'][$id]['button'];
				if($btn_feedback=='success')
				{
					$value['attr']['disabled']='disabled';
				}
				$htmlFORM.=htmlbutton($value['attr'],$value[$btn_feedback]);
			}
			else
			{
				$htmlFORM.=htmlbutton($value['attr'],$value['content']);
			}
			
			$htmlFORM.='</div>';
		}
		if($group=='fieldset' && $value)
		{
			$htmlFORM.=htmlfieldset($id,$value,$params);
		}
		if($group=='response')
		{
			$htmlFORM.=htmlResponse($value);
		}
		if($group!='alert' && $group!='fieldset' && $group!='button' && $group!='response' && $value)
		{
			$htmlFORM.=htmlgroup($value,$group,$id);
		}
	}

	$htmlFORM.='</form>';

	unset($_SESSION['feedback'][$id]);

	return $htmlFORM;
}
function htmlSignup($tab)
{
	$htmlSignup= '<div class="alert alert-info alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fa fa-info-circle"></i> Complete los siguientes campos o <a href="?tab='.$tab.'&nav=login#'.$tab.'" data-target="#'.$tab.'-login" action="tab">Inicie sesion</a> / <a href="?tab='.$tab.'&nav=signup#'.$tab.'" data-target="#'.$tab.'-signup" action="tab">Registarse</a></div>';
	return $htmlSignup;
}
function htmlResponse($data)
{
	if($data==true)
	{
		$htmlResponse = '<div class="form-group response"></div>';
	}
	return $htmlResponse;
}
function htmltabnav($id,$navs,$params)
{
	$htmltabnav='<ul class="nav nav-tabs">';
	foreach ($navs as $nav => $value) 
	{
		$i++;

		$htmltabnav.='<li role="presentation"';

		if($params['tab'] && $params['tab']==$id)
		{
			$htmltabnav.=' class="';
			if($params['nav']==$nav)
			{
				$htmltabnav.='active';	
			}
			
			if($value['class'])
			{
				$htmltabnav.=' '.$value['class'];
			}
			$htmltabnav.='"';
		}
		elseif($i==1 && $nav!='like' && $nav!='config')
		{
			$htmltabnav.=' class="active';
			if($value['class'])
			{
				$htmltabnav.=' '.$value['class'];
			}
			$htmltabnav.='"';
		}
		elseif($nav=='responses')
		{
			$htmltabnav.=' class="active';
			if($value['class'])
			{
				$htmltabnav.=' '.$value['class'];
			}
			$htmltabnav.='"';
		}
		elseif($value['class'])
		{
			$htmltabnav.=' class="'.$value['class'].'"';
		}

		$htmltabnav.='><a href="';

		if($nav=='logout')
		{
			$htmltabnav.='?logout';
		}
		elseif($value['class']=='disabled')
		{
			$htmltabnav.='#';
		}
		else
		{
			$htmltabnav.='?';
			if($params['tabpanel'])
			{
				$htmltabnav.='tabpanel='.$params['tabpanel'].'&';
			}

			$htmltabnav.='tab='.$id.'&nav='.$nav;

			if($nav=='like' || $nav=='dislike')
			{
				$htmltabnav.='&'.$nav.'='.$params['like']['type'].'&element='.$params['like']['element'];
			}

			$htmltabnav.='#'.$id.'"';

			$htmltabnav.='" data-target="#'.$id.'-'.$nav.'" role="tab" data-toggle="tab" aria-controls="'.$id.'-'.$nav.'" aria-expanded="';
		
			if($params['tab'] && $params['tab']==$id)
			{
				if($params['nav']==$nav)
				{
					$htmltabnav.='true';	
				}
			}
			elseif($i==1)
			{
				$htmltabnav.='true';
			}
			else 
			{
				$htmltabnav.='false';
			}

		}
		
		$htmltabnav.='">';

		foreach ($value as $key => $data) 
		{
			$i2++;
			if($i2>0)
			{
				$htmltabnav.=' ';
			}

			if($key=='i')
			{
				$htmltabnav.=htmliconfont($data);
			}
			if($key=='text')
			{
				$htmltabnav.=htmltext($data);
			}
		}
		
		$htmltabnav.='</a></li>';
	}
	$htmltabnav.='</ul>';

return $htmltabnav;
}
function htmltabpanel($id,$tabs,$params)
{
	$htmltabpanel.='<div class="tab-content">';
	foreach ($tabs as $tab => $value) 
	{
		$i++;
		$htmltabpanel.='<div role="tabpanel" class="tab-pane fade';


		if($params['tab'] && $params['tab']==$id)
		{
			if($params['nav']==$tab)
			{
				$htmltabpanel.=' active in';
			}
			
		}
		elseif($i==1 && $tab!='like' && $nav!='config')
		{
			$htmltabpanel.=' active in';
		}
		elseif($tab=='responses')
		{
			$htmltabpanel.=' active in';
		}

		$htmltabpanel.='" id="'.$id.'-'.$tab.'">';

		foreach ($value as $key => $data) 
		{
			if(($params['tab'] && $params['tab']==$id) || $i==1 || $tab=='responses')
			{
				if($key=='form')
				{
					$htmltabpanel.=htmlFORM($data['id'], $data['data'],array('callback'=>'%23ums:'.$id.':tab:'.$id.'-'.$tab,'tab'=>$id));
				}
				if($key=='div')
				{
					$htmltabpanel.=htmlDIV($data, '%23ums:'.$id.':tab:'.$id.'-'.$tab);
				}
				if($key=='media')
				{
					$htmltabpanel.=htmlMedia($data,array('callback'=>'%23ums:'.$id.':tab:'.$id.'-'.$tab,'tab'=>$params['tab'],'nav'=>$params['nav']));
				}
				if($key=='list-group')
				{
					$htmltabpanel.=htmllistgroup($data,array('callback'=>'%23ums:'.$id.':tab:'.$id.'-'.$tab,'tab'=>$params['tab'],'nav'=>$params['nav']));
				}
			}
			
		}

		$htmltabpanel.='</div>';
	}
	$htmltabpanel.='</div>';

	return $htmltabpanel;
}
function htmlfieldset ($id,$fieldset,$params)
{

	if($fieldset['attr'])
	{
		$htmlfieldset.='<fieldset ';
		foreach ($fieldset['attr'] as $attr => $value) 
		{
			$i++;
			if($i>0)
			{
				$htmlfieldset.=' ';
			}
			$htmlfieldset.=$attr.'="'.$value.'"';
		}
	}
	else
	{
		$htmlfieldset.='<fieldset class="well well-sm"';
	}
	$htmlfieldset.='>';

	if($fieldset['links'])
	{	
		$htmlfieldset.='<div class="form-group">'.htmllinks($fieldset['links'],$params['callback']).'</div>';
	}
	if($fieldset['signup'])
	{
		$htmlfieldset.=htmlSignup($params['tab']);
	}

	foreach ($fieldset['groups'] as $group => $value) {
		if($group=='alert' && $value)
		{
			$htmlfieldset.=alerts($value);
		}
		if($group!='alert' && $value)
		{
			$htmlfieldset.=htmlgroup($value,$group,$id);
		}
	}

	

	$htmlfieldset.='</fieldset>';

	return $htmlfieldset;
}
function htmllinks($links,$callback)
{
		$htmllinks='';
		if($links['label'])
		{
			$htmllinks.='<label>'.$links['label'].'</label>';
		}
		foreach ($links as $link => $value) 
		{
			if($link!='label')
			{
				$value['attr']['href']=URLSYSTEM.'?'.$value['action'].'='.$link;
				if($callback)
				{
					$value['attr']['href'].='&callback='.$callback;
				}
				$i++;
				if($i>0)
				{
					$htmllinks.=' ';
				}
				$htmllinks.=htmllink($value);
			}
			
		}

	return $htmllinks;
}
function htmllink($link)
{
	if($link['attr'])
	{
		$htmllink.='<a ';
		foreach ($link['attr'] as $attr => $value) 
		{
			$i++;
			if($i>0)
			{
				$htmllink.=' ';
			}
			$htmllink.=$attr.'="'.$value.'"';
		}
	}
	else
	{
		$htmllink.='<a';
	}
	$htmllink.='>';
	foreach ($link['content'] as $content => $value) {
		$i++;
		if($i>0)
		{
			$htmllink.=' ';
		}
		if($content=='i')
		{
			$htmllink.=htmliconfont($value);
		}
		if($content=='text')
		{
			$htmllink.=htmltext($value);
		}
	}
	$htmllink.='</a>';

	return $htmllink;
}
function htmlgroup($group,$field,$id)
{
	$feedback=$_SESSION['feedback'][$id][$field];

	if($feedback)
	{
		$group['attr']['class'].= ' '.Feedback('class',$feedback['status']);
	}	

	if($group['attr'])
	{
		$htmlGROUP='<div ';
		foreach ($group['attr'] as $attr => $value) 
		{
			$i++;
			if($i>0)
			{
				$htmlGROUP.=' ';
			}
			$htmlGROUP.=$attr.'="'.$value.'"';
		}
		$htmlGROUP.='>';
	}
	else
	{
		$htmlGROUP='<div class="form-group">';
	}
		
	if($group['params']['label'])
	{
		$htmlGROUP.='<label for="'.$field.'">'.$group['params']['label'].'</label>';
	}

	if($group['addon'] || $group['button'])
	{
		$htmlGROUP.='<div class="input-group">';
	}

	
	foreach ($group as $key => $value) 
	{
	 	if($key=='addon'&& $value)
	 	{
	 		$htmlGROUP.=htmladdon($value);
	 	}
	 	if($key=='button' && $value)
	 	{
	 		$htmlGROUP.='<span class="input-group-btn">'.htmlbutton($value['attr'],$value['content']).'</span>';
	 	}
	 	if($key!='attr' && $key!='params' && $key!='addon' && $key!='button')
	 	{
	 		$htmlGROUP.=htmlcontrol($key,$value,$feedback);
	 	}
	}
	if($feedback)
	{
		$htmlGROUP.= Feedback('icon',$feedback['status']);
	}
	if($group['addon'] || $group['button'])
	{
		$htmlGROUP.='</div>';
	}

	if($group['params']['text'])
	{
		$htmlGROUP.='<small';
		if($group['params']['text']['class'])
		{
			$htmlGROUP.=' class="'.$group['params']['text']['class'].'"';
		}
		$htmlGROUP.='>'.$group['params']['text']['content'].'</small>';
	}

	$htmlGROUP.= '</div>';

	return $htmlGROUP;
}
function fieldList($fields)
{
	$warningFields['count']= 0;
	$warningFields['content'] = '';
	foreach ($fields as $field => $feedback) {
		$warningFields['count']++;

			if($warningFields['count']>1)
			{
				$warningFields['content'].= ', ';
			}

			$warningFields['content'].='<b>'.$field.'</b>';
	}
	$htmlalert['warning']='Los siguientes campos son incorrectos: '.$warningFields['content'].'.';

	return $htmlalert;
}
function Feedback ($type,$feedback)
{
	if($feedback=='valid')
	{
		if($type=='class')
		{
			$htmlfeedback='has-feedback has-success';
		}
		if($type=='icon')
		{
			$htmlfeedback='<span class="form-control-feedback"><i class="fa fa-check"></i></span>';
		}	
	}
	if($feedback=='invalid' || $feedback=='nodata' || $feedback=='nostrlen' || $feedback=='nopregmatch')
	{
		if($type=='class')
		{
			$htmlfeedback='has-feedback has-warning ';
		}	
		if($type=='icon')
		{
			$htmlfeedback='<span class="form-control-feedback"><i class="fa fa-warning"></i></span>';
		}
	}

	return $htmlfeedback;
}
function htmlcontrol($type,$attr_val,$feedback)
{
	if($type=='textarea')
	{
		$htmlcontrol=htmltextarea($attr_val,$feedback);
	}
	if($type=='input')
	{
		$htmlcontrol=htmlinput($attr_val,$feedback);
	}
	if($type=='checkbox')
	{
		$htmlcontrol=htmlcheckbox($attr_val,$feedback);
	}
	if($type=='select')
	{
		$htmlcontrol=htmlselect($attr_val,$feedback);
	}
	return $htmlcontrol;
}
function htmlselect($select,$feedback)
{
	if($select['attr'])
	{
		$htmlcontrol='<select ';
		foreach ($select['attr'] as $attr => $value) 
		{
			$i++;
			if($i>0)
			{
				$htmlcontrol.=' ';
			}
			$htmlcontrol.=$attr.'="'.$value.'"';
		}
	}
	else
	{
		$htmlcontrol='<select class="form-control"';
	}
	if($select['validations'])
	{	
		$htmlcontrol.=' ';
		foreach ($select['validations'] as $val => $value) 
		{	
			if($i>0)
			{
				$htmlcontrol.=' ';
			}
			if($value && $val!='pregmatch')
			{
				$i++;
				if($val!='required' && $val!='readonly')
				{
					$htmlcontrol.=$val.'="'.$value.'"';
				}
				else
				{
					$htmlcontrol.=$val;
				}
			}
		}
	}
	else
	{
		$htmlcontrol.='required';
	}

	$htmlcontrol.='>';

	if($select['selects'])
	{
		foreach ($select['selects'] as $option => $value) {
			$htmlcontrol.= '<option value="'.$option.'"';
			if($select['selected']==$option)
			{
				$htmlcontrol.=' selected="selected"';
			}
			$htmlcontrol.='>'.$value.'</option>';
		}
	}
	$htmlcontrol.='</select>';

	return $htmlcontrol;
}
function htmlcheckbox($checkbox,$feedback)
{
	$htmlcontrol ='<label>';
	if($checkbox['attr'])
	{
		$htmlcontrol.='<input ';
		foreach ($checkbox['attr'] as $attr => $value) 
		{
			if($attr=='class' || $attr=='type' || $attr=='name' || $attr=='value')
			{
				$i++;
				if($i>0)
				{
					$htmlcontrol.=' ';
				}
				$htmlcontrol.=$attr.'="'.$value.'"';
			}
		}
	}
	else
	{
		$htmlcontrol.='<input class="form-control"';
	}
	if($checkbox['attr']['checked'])
	{
		$htmlcontrol.=' checked';
	}
	$htmlcontrol.='>';

	if($checkbox['attr']['placeholder'])
	{
		$htmlcontrol.='<b>'.$checkbox['attr']['placeholder'].'</b>';
	}

	$htmlcontrol.='</label>';

	return $htmlcontrol;
}
function htmlinput($input,$feedback)
{
	if($input['attr'])
	{
		$htmlcontrol='<input ';
		foreach ($input['attr'] as $attr => $value) 
		{
			$i++;
			if($i>0)
			{
				$htmlcontrol.=' ';
			}
			$htmlcontrol.=$attr.'="'.$value.'"';
		}
	}
	else
	{
		$htmlcontrol='<input class="form-control"';
	}
	if($input['validations'])
	{	
		$htmlcontrol.=' ';
		foreach ($input['validations'] as $val => $value) 
		{	
			if($i>0)
			{
				$htmlcontrol.=' ';
			}
			if($value && $val!='pregmatch')
			{
				$i++;
				if($val!='required' && $val!='readonly')
				{
					$htmlcontrol.=$val.'="'.$value.'"';
				}
				else
				{
					$htmlcontrol.=$val;
				}
			}
		}
	}
	else
	{
		$htmlcontrol.='required';
	}
	if($feedback)
	{
		$htmlcontrol.= ' value="'.$feedback['value'].'"';
		if($feedback['status']=='valid')
		{
			$htmlcontrol.=' readonly';
		}
	}

	$htmlcontrol.='>';

	return $htmlcontrol;
}
function htmltextarea($textarea,$feedback)
{
	if($textarea['attr'])
		{
			$htmlcontrol='<textarea ';
			foreach ($textarea['attr'] as $attr => $value) 
			{
				$i++;
				if($i>0)
				{
					$htmlcontrol.=' ';
				}
				$htmlcontrol.=$attr.'="'.$value.'"';
			}
		}
		else
		{
			$htmlcontrol='<textarea class="form-control"';
		}

		if($textarea['validations'])
		{	
			$htmlcontrol.=' ';
			foreach ($textarea['validations'] as $val => $value) 
			{	
				if($i>0)
				{
					$htmlcontrol.=' ';
				}
				if($value)
				{
					$i++;
					if($val!='required' && $val!='readonly')
					{
						$htmlcontrol.=$val.'="'.$value.'"';
					}
					else
					{
						$htmlcontrol.=$val;
					}

				}
			}
		}
		else
		{
			$htmlcontrol.='required';
		}

		if($feedback)
		{
			if($feedback['status']=='valid')
			{
				$htmlcontrol.=' readonly';
			}
		}

		$htmlcontrol.='>';
		if($feedback)
		{
			$htmlcontrol.=$feedback['value'];
		}
		$htmlcontrol.='</textarea>';

		return $htmlcontrol;
}
function alerts($alert)
{
	foreach ($alert as $key => $value) {
		if($key=='info')
		{
			$htmlalert='<div class="alert alert-info alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-info-circle"></i></b> '.$value.'</div>';
		}
		if($key=='warning')
		{
			$htmlalert='<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-warning"></i> Error ! </b> '.$value.'</div>';
		}
		if($key=='success')
		{
			$htmlalert='<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-check-circle"></i> Correcto !</b> '.$value.'</div>';
		}
		if($key=='danger')
		{
			$htmlalert='<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-times-circle"></i> Error !</b> '.$value.'</div>';
		}
	}

	return $htmlalert;
}
function htmladdon($addon)
{
	if($addon['attr'])
	{
		$htmladdon='<span ';
		foreach ($addon['attr'] as $attr => $value) 
		{
			$i++;
			if($i>0)
			{
				$htmladdon.=' ';
			}
			$htmladdon.=$attr.'="'.$value.'"';
		}
		$htmladdon.='>';
	}
	else
	{
		$htmladdon='<span class="input-group-addon">';
	}
	foreach ($addon['content'] as $content => $value) {
		$i++;
		if($i>0)
		{
			$htmladdon.=' ';
		}
		if($content=='i')
		{
			$htmladdon.=htmliconfont($value);
		}
		if($content=='text')
		{
			$htmladdon.=htmltext($value);
		}
	}

	$htmladdon.='</span>';

	return $htmladdon;
}
function htmlbutton($attrs,$contents)
{
	if($attrs)
	{
		$htmlbutton='<button ';
		foreach ($attrs as $attr => $value) 
		{
			$i++;
			if($i>0)
			{
				$htmlbutton.=' ';
			}
			$htmlbutton.=$attr.'="'.$value.'"';
		}
		$htmlbutton.='>';
	}
	else
	{
		$htmlbutton='<button type="submit" class="btn btn-default">';
	}
	foreach ($contents as $content => $value) {
		$i++;
		if($i>0)
		{
			$htmlbutton.=' ';
		}
		if($content=='i')
		{
			$htmlbutton.=htmliconfont($value);
		}
		if($content=='text')
		{
			$htmlbutton.=htmltext($value);
		}
	}
	$htmlbutton.='</button>';
	return $htmlbutton;
}
function htmliconfont($icon)
{
	$htmliconfont='<i class="'.$icon.'"></i>';

	return $htmliconfont;
}
function htmltext($text=array())
{
	if(!$text['tag'])
	{
		$text['tag']='span';
	}
	$htmltext='<'.$text['tag'];
	if($text['class'])
	{
		 $htmltext.=' class="'.$text['class'].'"';	
	}
	if($text['itemprop'])
	{
		$htmltext.=' itemprop="'.$text['itemprop'].'"';
	}
	$htmltext.='>';
	
	$htmltext.=$text['content'];

	$htmltext.='</'.$text['tag'].'>';

	return $htmltext;
}
function htmlalertfields ($feedback=array())
{

	$warningFields['count']= 0;
	$warningFields['content'] = '';
	foreach ($feedback as $field => $status) 
	{
		if($status!='valid' && $status!='norequired')
		{
			$warningFields['count']++;

			if($warningFields['count']>1)
			{
				$warningFields['content'].= ', ';
			}

			$warningFields['content'].='<b>'.$SETTINGS[$field]['display'].'</b>';
				
		}
	}

	$htmlalert='<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><b><i class="fa fa-warning"></i> No enviado !</b> Los siguientes campos son incorrectos: '.$warningFields['content'].'.</div>';


	return $htmlalert;
}