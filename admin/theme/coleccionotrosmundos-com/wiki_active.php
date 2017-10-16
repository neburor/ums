<?php
//Email reply template
include 'config.php';
$subjet = "Se publico tu edición";
$cuerpo = '
<table style="border-collapse:collapse;width:100%;background:#ffebb6;">
	<tbody>
		<tr style="border-collapse:collapse;">
			<td style="padding:10px;">
				<a href="https://www.coleccionotrosmundos.com/" target="_blank"><img src="https://www.coleccionotrosmundos.com/img/otros_mundos.png" alt="Coleccion otros mundos" width="200" height="20"></a>
			</td>
			<td align="right" style="padding:10px;">
				<a href="https://www.facebook.com/coleccionotrosmundos/" target="_blank"><img src="https://www.coleccionotrosmundos.com/img/fb-btn.png" alt="Siguenos en facebook" width="25" height="25"></a>
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td colspan="2">
				<div style="text-align:center;padding-top:10px;padding-left:10%;padding-bottom:10px;padding-right:10%;"><h2 style="font-weight:500;font-size:24px;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.4;letter-spacing:-0.045em;color:#5a6267;color:#555;">Se publico tu edicion en: <a href="'.$params['url'].'?email=wiki:'.$account['token_hash'].':'.$emails.':'.$params['notifapp'].':'.$params['asset_id'].'" style="color:#a94442;">'.$params['title'].'</a></h2></div>
				<hr style="border:none;height:2px;overflow:hidden;background:#e8d094;">
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td style="border-collapse:collapse;color:#353a3d;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;" colspan="2">
				<hr style="border:none;height:2px;overflow:hidden;background:#e8d094;">
				<div style="font-size:13px;word-break:break-all;"> No funciona el botón? Pega este enlace en tu navegador:<br> <a href="'.$params['url'].'?email=wiki:'.$account['token_hash'].':'.$emails.':'.$params['notifapp'].':'.$params['asset_id'].'" style="color:#a94442;text-decoration:none;font-size:80%;" target="_blank">'.$params['url'].'?email:wiki:'.$account['token_hash'].':'.$emails.':'.$params['notifapp'].':'.$params['asset_id'].'</a><img src="'.URLINDEX.'?email=open:'.$account['token_hash'].':'.$emails.':wiki" style="width:1px;height:1px"></div>
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