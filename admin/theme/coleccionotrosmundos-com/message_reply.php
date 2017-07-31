<?php
//Email reply template
include 'config.php';

$subjet = "Tienes una respuesta a tu mensage";
$cuerpo = '
<table style="border-collapse:collapse;width:100%;background:#ffebb6;">
	<tbody>
		<tr style="border-collapse:collapse;">
			<td style="padding:10px;">
				<a href="http://www.coleccionotrosmundos.org/" target="_blank"><img src="http://v5.coleccionotrosmundos.org/img/otros_mundos.png" alt="Coleccion otros mundos" width="200" height="20"></a>
			</td>
			<td align="right" style="padding:10px;">
				<a href="https://www.facebook.com/coleccionotrosmundos/" target="_blank"><img src="http://v5.coleccionotrosmundos.org/img/fb-btn.png" alt="Siguenos en facebook" width="25" height="25"></a>
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td colspan="2">
				<div style="text-align:center;padding-top:10px;padding-left:10%;padding-bottom:10px;padding-right:10%;"><h2 style="font-weight:500;font-size:24px;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.4;letter-spacing:-0.045em;color:#5a6267;color:#555;">Tienes una respuesta a tu mensaje</h2></div>
				<hr style="border:none;height:2px;overflow:hidden;background:#e8d094;">
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td style="border-collapse:collapse;color:#353a3d;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;padding: 10px" colspan="2">
			<div>
				<img class="thumbnail-pic" alt="'.$params['name'].'" src="'.$params['pic'].'" style="width:40px; height: auto; float: left; margin-right:10px;">
				<b>Tú</b>
				<p style="text-align: left;padding: 10px;margin: 0;">';
				foreach ($params['messages'] as $mess => $data) {
					$cuerpo.=$data['message'].'<br>';
				}
$cuerpo.='</p>
				</div>
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td style="border-collapse:collapse;color:#353a3d;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;padding: 10px" colspan="2">
			<div style="margin-left: 40px; margin-top: 10px; ">
				<img class="thumbnail-pic" alt="'.SITENAME.'" src="'.URLTHEME.'avatars/administracion.png" style="width:40px; height: auto; float: left; margin-right:10px;">
				<b>Administración</b>
				<p style="text-align: left;padding: 10px;margin: 0;background: #f2dfad;border: 1px solid #d9c89b;">'.$params['message'].'</p>
				<a href="'.URLMESSAGES.'?email=message:'.$account['token_hash'].':'.$emails.':'.$params['notifapp'].':'.$params['asset_id'].'#message_'.$params['asset_id'].'" style="color:#a94442;">Responder</a></div>
			
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td style="border-collapse:collapse;color:#353a3d;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;" colspan="2">
				<hr style="border:none;height:2px;overflow:hidden;background:#e8d094;">
				<div style="font-size:13px;word-break:break-all;"> No funciona el botón? Pega este enlace en tu navegador:<br> <a href="'.URLMESSAGES.'?email=message:'.$account['token_hash'].':'.$emails.':'.$params['notifapp'].':'.$params['asset_id'].'#message_'.$params['asset_id'].'" style="color:#a94442;text-decoration:none;font-size:80%;" target="_blank">'.URLMESSAGES.'?email=message:'.$account['token_hash'].':'.$emails.':'.$params['notifapp'].':'.$params['asset_id'].'#message_'.$params['asset_id'].'</a><img src="'.URLINDEX.'?email=open:'.$account['token_hash'].':'.$emails.':message" style="width:1px;height:1px"></div>
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td style="padding:10px; text-align:center;" colspan="2">
				<a href="https://www.coleccionotrosmundos.com/" target="_blank"><img src="https://www.coleccionotrosmundos.com/img/O_M.png" alt="Coleccion otros mundos" width="50" height="46"></a>
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td style="padding:10px; text-align:center;" colspan="2">
				<a href="https://www.facebook.com/coleccionotrosmundos/" target="_blank"><img src="https://www.coleccionotrosmundos.com/img/fb-btn.png" alt="Siguenos en facebook" width="25" height="25"></a>
			</td>
		</tr>
	</tbody>
</table>';