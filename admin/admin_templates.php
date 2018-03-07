<?php
#Templates

Function Template($params){

	$resultado=SQLselect(
            array(
                'table'=>'emails_templates',
                'query'=>'
                SELECT
                *,
                (select count(*) from `emails` where `template` = emails_templates.`id`) AS `count`,
                (select count(*) AS `total` from `emails` where `asset` = "'.$params['asset'].'" AND `domain`= "'.UMSDOMAIN.'") AS `total`
                FROM `emails_templates`
                WHERE `asset` = "'.$params['asset'].'"
                AND `domain`= "'.UMSDOMAIN.'"
                ORDER BY `per` DESC
                '
                )
            );
	if($resultado){
		foreach ($resultado as $key => $value) {
			$per=100*$value['count']/$value['total'];
			if(round($per)<=$value['per']){
				if($value['type']=='theme'){
					$return=TemDefault($params,json_decode($value['content'],true));
					$return['id']=$value['id'];
				}else{
					#Template Custom
					#by DB[name] inlude file generate by funtion TemCustom($asset,$params,$theme)
				}
				return $return;
			}else
			{
				return TemDefault($params);
			}
		}

	}else{
		
		return TemDefault($params);
	}
	
}
function TemDefault($params,$theme=array()) {	

    $theme = array_merge(array(
        'id'      		=> '0',
        'background'	=> 'none',
        'color'			=> '#333',
        'h2'			=> '#333',
        'h2bold'		=> '#333',
        'link'   		=> '#337ab7',
        'line'     		=> '#ddd',
        'btn1_color' 	=> '#555',
        'btn1_bg'		=> '#eee',
        'btn1_border'   => '1px solid rgba(0,0,0,.2)',
        'btn1_bold'		=> '#333',
        'btn1_shadow'	=> '1px 1px 1px #ccc',
        'box1_color'	=> '#333',
        'box1_bg'		=> 'rgba(0,0,0,.05)',
        'box1_border'   => '1px solid rgba(0,0,0,.1)',
        'box1_bold'		=> '#333'
    ), $theme);

	$template['id']=$theme['id'];
    $template['from']=SITENAME;

    if($params['from_name']=='admin'){
    	$params['from_name']=ADMINNAME;
    	$params['from_pic']=ADMINPIC;
    }
    
    if($params['asset']=='message'){	
    	$template['subject']='Tienes un mensaje de '.ADMINNAME.'.';
    	$H2_text='Tienes una respuesta a tu mensaje';
    	$Hidden_text='<span style="display:none;">'.$params['message'].'</span>';
    	
    }
    if($params['asset']=='comment'){
    	$template['subject']=$params['from_name'].' respondio tu comentario en '.$params['title'].'.';
    	$H2_text='Tienes una respuesta a tu comentario en: <strong style="color:'.$theme['h2bold'].';">'.$params['title'].'</strong>';
    }
    if($params['asset']=='wiki'){
    	$template['subject']='Se aprobó tu edición en '.$params['title'].'.';
    	$H2_text='Se publicó tu edición en: <strong style="color:'.$theme['h2bold'].';">'.$params['title'].'</strong>';
    }
    if($params['asset']=='ecommerce'){
    	$template['subject']='Se aprobó tu publicación en '.$params['title'].'.';
    	$H2_text='Se activo tu publicación: <strong style="color:'.$theme['h2bold'].';">'.$params['title'].'</strong>';
    }
    if($params['asset']=='ecommerce_message'){
    	$template['subject']='Tienes un mensaje de '.$params['from_name'].'.';
    	$H2_text='Tienes un mensaje en tu publicación: <strong style="color:'.$theme['h2bold'].';">'.$params['title'].'</strong>';
    	$Hidden_text='<span style="display:none;">';
    	foreach ($params['messages'] as $mess => $data) {
					$Hidden_text.=$data['message'].', ';
				}
    	$Hidden_text.='</span>';
    }
    
    $template['content']='<table style="border-collapse:collapse;width:100%;background:'.$theme['background'].';"><tbody>';
    $template['content'].='
    			<tr style="border-collapse:collapse;"><td colspan="2">
					<div style="text-align:center;padding-top:10px;padding-left:10%;padding-bottom:10px;padding-right:10%;">
						<h2 style="font-weight:500;font-size:24px;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.4;letter-spacing:-0.045em;color:'.$theme['h2'].';">'.$H2_text.'</h2>
					</div>
					<hr style="border:none;height:2px;overflow:hidden;background:'.$line.';">
				</td></tr>';
    if($params['asset']=='message'){
		$template['content'].='
		<tr style="border-collapse:collapse;">
			<td style="line-height:1.4;padding:10px;" colspan="2">
				<div>
				<img class="thumbnail-pic" alt="'.$params['name'].'" src="'.$params['pic'].'" style="width:40px; height: auto; float: left; margin-right:10px;">
				<b>Tú:</b>
				<p style="text-align: left;padding: 10px;margin: 0;">';
				foreach ($params['messages'] as $mess => $data) {
					$template['content'].=$data['message'].'<br>';
				}
$template['content'].='</p>
				</div>
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td style="line-height:1.4;padding: 10px" colspan="2">
			<div style="margin-left: 40px; margin-top: 10px; ">
				<img class="thumbnail-pic" alt="'.SITENAME.'" src="'.ADMINPIC.'" style="width:40px; height: auto; float: left; margin-right:10px;">
				<b>'.ADMINNAME.':</b>
				<p style="text-align: left;padding: 10px;margin: 0;background:'.$theme['box1_bg'].';border: '.$theme['box1_border'].';color:'.$theme['box1_color'].';">'.$params['message'].'</p>
				<a href="'.URLMESSAGES.'?email=message:'.$params['token_hash'].':'.$params['emailid'].':'.$params['notifapp'].':'.$params['asset_id'].'#message_'.$params['asset_id'].'" style="color:'.$theme['link'].';">Responder</a></div>
			
			</td>
		</tr>';
    }
    if($params['asset']=='comment'){
		$template['content'].='
				<tr style="border-collapse:collapse;">
			<td style="line-height:1.4;padding:10px;" colspan="2">
			<div>
				<img class="thumbnail-pic" alt="'.$params['name'].'" src="'.$params['pic'].'" style="width:40px; height: auto; float: left; margin-right:10px;">
				<b>Tú:</b>
				<p style="text-align: left;padding: 10px;margin: 0;">'.$params['comment'];
		if($params['edit_comment'])
		{
			$template['content'].=' <small><i>*Editado</i></small>';
		}
		$template['content'].='</p>
				</div>
			</td>
		</tr>';
	$template['content'].='<tr style="border-collapse:collapse;">
			<td style="line-height:1.4;padding:10px;" colspan="2">
			<div style="margin-left: 40px; margin-top: 10px; ">
				<img class="thumbnail-pic" alt="'.$params['from_name'].'" src="'.$params['from_pic'].'" style="width:40px; height: auto; float: left; margin-right:10px;">
				<b>'.$params['from_name'].':</b>
				<p style="text-align: left;padding: 10px;margin: 0;background: '.$theme['box1_bg'].';border: '.$theme['box1_border'].';color:'.$theme['box1_color'].';">'.$params['from_comment'].'</p>
				<a href="'.$params['url'].'?email=comment:'.$params['token_hash'].':'.$params['emailid'].':'.$params['notifapp'].':'.$params['asset_id'].'#comment_'.$params['asset_id'].'" style="color:'.$theme['link'].';">Responder</a></div>
			
			</td>
		</tr>';
    }
    if($params['asset']=='wiki'){
    	$template['content'].='
				<tr style="border-collapse:collapse;"><td colspan="2">
					<div style="text-align:center;padding-top:10px;padding-left:10%;padding-bottom:10px;padding-right:10%;">
						<p style="font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
						<a href="'.$params['url'].'?email=wiki:'.$params['token_hash'].':'.$params['emailid'].'" style="color:'.$theme['btn1_color'].';text-decoration:none;font-weight:700;background:'.$theme['btn1_bg'].';font-size:18px;padding-top:8px;padding-left:16px;padding-bottom:8px;padding-right:16px;border-radius:3px;line-height:1.5em;display:block;border: '.$theme['btn1_border'].';-webkit-box-shadow: '.$theme['btn1_shadow'].';-moz-box-shadow: '.$theme['btn1_shadow'].';box-shadow: '.$theme['btn1_shadow'].';" target="_blank">Ver Wiki
						</a>
					</p>
				</div>
			</td>
		</tr>';
    }
    if($params['asset']=='ecommerce'){
    	$template['content'].='
				<tr style="border-collapse:collapse;"><td colspan="2">
					<div style="text-align:center;padding-top:10px;padding-left:10%;padding-bottom:10px;padding-right:10%;">
						<p style="font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
						<a href="'.$params['path'].'pub_'.$params['asset_id'].'.html?email=ecommerce:'.$params['token_hash'].':'.$params['emailid'].'" style="color:'.$theme['btn1_color'].';text-decoration:none;font-weight:700;background:'.$theme['btn1_bg'].';font-size:18px;padding-top:8px;padding-left:16px;padding-bottom:8px;padding-right:16px;border-radius:3px;line-height:1.5em;display:block;border: '.$theme['btn1_border'].';-webkit-box-shadow: '.$theme['btn1_shadow'].';-moz-box-shadow: '.$theme['btn1_shadow'].';box-shadow: '.$theme['btn1_shadow'].';" target="_blank">Ver Publicación
						</a>
					</p>
				</div>
			</td>
		</tr>';
    }
    if($params['asset']=='ecommerce_message'){
		$template['content'].='
		<tr style="border-collapse:collapse;">
			<td style="line-height:1.4;padding: 10px" colspan="2">
			<div style="margin-left: 40px; margin-top: 10px; ">
				<img class="thumbnail-pic" alt="'.$params['from_name'].'" src="'.$params['from_pic'].'" style="width:40px; height: auto; float: left; margin-right:10px;">
				<b>'.$params['from_name'].':</b>
				<p style="text-align: left;padding: 10px;margin: 0;background:'.$theme['box1_bg'].';border: '.$theme['box1_border'].';color:'.$theme['box1_color'].';">';
				foreach ($params['messages'] as $mess => $data) {
					$template['content'].=$data['message'].'<br>';
				}
$template['content'].='</p>
				<a href="'.$params['url'].'?email=ecommerce_message:'.$params['token_hash'].':'.$params['emailid'].':'.$params['notifapp'].':'.$params['asset_id'].'#message_'.$params['asset_id'].'" style="color:'.$theme['link'].';">Responder</a></div>
			
			</td>
		</tr>';
    }
	$template['content'].='<tr style="border-collapse:collapse;"><td colspan="2"><img src="'.URLINDEX.'?email=open:'.$params['token_hash'].':'.$params['emailid'].':'.$params['asset'].'" style="width:1px;height:1px"></td></tr>';

	$template['content'].='</tbody></table>';
    
    return $template;
}