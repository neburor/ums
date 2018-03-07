<?php
#Templates

Function Template($asset,$params){

	$resultado=SQLselect(
            array(
                'table'=>'emails_templates',
                'query'=>'
                SELECT
                *,
                (select count(*) from `emails` where `template` = emails_templates.`id`) AS `count`,
                (select count(*) AS `total` from `emails` where `asset` = "'.$asset.'" AND `domain`= "'.UMSDOMAIN.'") AS `total`
                FROM `emails_templates`
                WHERE `asset` = "'.$asset.'"
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
					$return=TemDefault($asset,$params,json_decode($value['content'],true));
					$return['id']=$value['id'];
				}else{
					#Template Custom
					#by DB[name] inlude file generate by funtion TemCustom($asset,$params,$theme)
				}
				return $return;
			}else
			{
				return TemDefault($asset,$params);
			}
		}

	}else{
		
		return TemDefault($asset,$params);
	}
	
}
function TemDefault($asset,$params,$theme=array()) {	

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
    
    if($asset=='confirmation'){	
    	$template['subject']=$params['name'].', confirma tu correo.';
    }
    if($asset=='recovery'){
    	$template['subject']='Recuperación de contraseña.';
    }

    $template['content']='<table style="border-collapse:collapse;width:100%;background:'.$theme['background'].';"><tbody>';
    $template['content'].='
    			<tr style="border-collapse:collapse;"><td colspan="2">
					<div style="text-align:center;padding-top:10px;padding-left:10%;padding-bottom:10px;padding-right:10%;">
						<h2 style="font-weight:500;font-size:24px;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.4;letter-spacing:-0.045em;color:'.$theme['h2'].';">';
		if($asset=='confirmation'){
			$template['content'].='<strong style="color:'.$theme['h2bold'].';">'.$params['name'].'</strong>, bienvenido a '.SITENAME;
		}
		if($asset=='recovery'){
			$template['content'].='<strong style="color:'.$theme['h2bold'].';">Recuperación de contraseña</strong>';
		}
	$template['content'].='</h2>
					</div>
				</td></tr>';
	if($params['autopass'] || $asset=='recovery'){
			$template['content'].='
				<tr style="border-collapse:collapse;">
					<td colspan="2">
						<hr style="border:none;height:2px;overflow:hidden;background:'.$theme['line'].';">
						<p style="text-align: left;padding: 10px;margin: 5px 15px;border:'.$theme['box1_border'].';color:'.$theme['box1_color'].';background:'.$theme['box1_bg'].';">Usuario :<b style="color:'.$theme['box1_bold'].';"> '.$params['useremail'].'</b></p>
						<p style="text-align: left;padding: 10px;margin: 5px 15px;border:'.$theme['box1_border'].';color:'.$theme['box1_color'].';background:'.$theme['box1_bg'].'">Contraseña :<b style="color:'.$theme['box1_bold'].';"> '.$params['password'].'</b></p>
					</td>
				</tr>
				';
		}

    if($asset=='confirmation'){
		$template['content'].='
				<tr style="border-collapse:collapse;"><td colspan="2">
					<hr style="border:none;height:2px;overflow:hidden;background:'.$theme['line'].';">
					<div style="text-align:center;padding-top:10px;padding-left:10%;padding-bottom:10px;padding-right:10%;">
						<p style="font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
						<a href="'.URLINDEX.'?email=confirmation:'.$params['token_hash'].':'.$params['emailid'].'" style="color:'.$theme['btn1_color'].';text-decoration:none;font-weight:700;background:'.$theme['btn1_bg'].';font-size:18px;padding-top:8px;padding-left:16px;padding-bottom:8px;padding-right:16px;border-radius:3px;line-height:1.5em;display:block;border: '.$theme['btn1_border'].';-webkit-box-shadow: '.$theme['btn1_shadow'].';-moz-box-shadow: '.$theme['btn1_shadow'].';box-shadow: '.$theme['btn1_shadow'].';" target="_blank">Confirmar: 
							<strong stye="color:'.$theme['btn1_bold'].';">'.$params['email'].'</strong>
						</a>
					</p>
				</div>
			</td>
		</tr>';

	$template['content'].='
    	<tr style="border-collapse:collapse;">
			<td style="border-collapse:collapse;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;text-align:center;width:inherit;display:block;" colspan="2">
				<h3 style="font-weight:300;font-size:18px;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.4;letter-spacing:-0.045em;color:'.$theme['h3'].';"><strong style="color:'.$theme['h3bold'].'">Porque confirmar mi correo ?</strong></h3>
				<p style="font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">Es necesario que confirmes tu correo para prevenir el SPAM y asegurarnos que esta correctamente escrito.</p>
			</td>
		</tr>';
	$template['content'].='
		<tr style="border-collapse:collapse;">
			<td style="border-collapse:collapse;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;" colspan="2">
				<hr style="border:none;height:2px;overflow:hidden;background:'.$theme['line'].';">
				<div style="font-size:13px;word-break:break-all;"> No funciona el botón? Pega este enlace en tu navegador:<br> <a href="'.URLINDEX.'?email=confirmation:'.$params['token_hash'].':'.$params['emailid'].'" style="color:'.$theme['link'].';text-decoration:none;font-size:80%;" target="_blank">'.URLINDEX.'?email=confirmation:'.$params['token_hash'].':'.$params['emailid'].'</a>
				</div>
			</td>
		</tr>';
    }
    if($asset=='recovery'){
		$template['content'].='
				<tr style="border-collapse:collapse;"><td colspan="2">
					<hr style="border:none;height:2px;overflow:hidden;background:'.$theme['line'].';">
					<div style="text-align:center;padding-top:10px;padding-left:10%;padding-bottom:10px;padding-right:10%;">
						<p style="font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
						<a href="'.URLINDEX.'?email=recovery:'.$params['token_hash'].':'.$params['emailid'].'#/app/settings/login/open" style="color:'.$theme['btn1_color'].';text-decoration:none;font-weight:700;background:'.$theme['btn1_bg'].';font-size:18px;padding-top:8px;padding-left:16px;padding-bottom:8px;padding-right:16px;border-radius:3px;line-height:1.5em;display:block;border: '.$theme['btn1_border'].';-webkit-box-shadow: '.$theme['btn1_shadow'].';-moz-box-shadow: '.$theme['btn1_shadow'].';box-shadow: '.$theme['btn1_shadow'].';" target="_blank">Iniciar sesión</a>
					</p>
				</div>
			</td>
		</tr>';    	
		$template['content'].='
    	<tr style="border-collapse:collapse;">
			<td style="border-collapse:collapse;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;text-align:center;width:inherit;display:block;" colspan="2">
				<h3 style="font-weight:300;font-size:18px;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.4;letter-spacing:-0.045em;color:'.$theme['h3'].';"><strong style="color:'.$theme['h3bold'].'">No solicito este correo ?</strong></h3>
				<p style="font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">Si no inició esta solicitud de recuperación de contraseña, ignore este correo electrónico. Mantendremos su cuenta segura.</p>
			</td>
		</tr>';
    }
    
	$template['content'].='<tr style="border-collapse:collapse;"><td colspan="2"><img src="'.URLINDEX.'?email=open:'.$params['token_hash'].':'.$params['emailid'].':'.$asset.'" style="width:1px;height:1px"></td></tr>';

	$template['content'].='</tbody></table>';
    
    return $template;
}