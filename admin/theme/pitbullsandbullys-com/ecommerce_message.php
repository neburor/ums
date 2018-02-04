<?php
//Email reply template
include 'config.php';
if($params['from_name']=='admin')
{
	$params['from_name']=ADMINNAME;
}
if($params['from_pic']=='admin')
{
	$params['from_pic']=ADMINPIC;
}
$subjet = "Tienes un mensaje en tu publicación";
$cuerpo = '
<table style="border-collapse:collapse;width:100%;background:#000;">
	<tbody>
		<tr style="border-collapse:collapse;">
			<td style="padding:10px;">
				<a href="http://es.pitbullsandbullys.com/" target="_blank"><img src="http://es.pitbullsandbullys.com/img/pyb_logo.png" alt="Pitbulls and Bullys" width="202" height="50"></a>
			</td>
			<td align="right" style="padding:10px;">
				<a href="https://www.facebook.com/pitbullsandbullys/" target="_blank"><img src="http://es.pitbullsandbullys.com/img/fb-btn.png" alt="Siguenos en facebook" width="25" height="25"></a>
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td colspan="2">
				<div style="text-align:center;padding-top:10px;padding-left:10%;padding-bottom:10px;padding-right:10%;"><h2 style="font-weight:500;font-size:24px;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.4;letter-spacing:-0.045em;color:#f1f3fd;">Tienes un mensaje en tu publicación : <a href="'.$params['url'].'?email=ecommerce:message:'.$account['token_hash'].':'.$emails.':'.$params['notifapp'].':'.$params['asset_id'].'" style="color:#f1f3fd">'.$params['title'].'</a></h2></div>
				<hr style="border:none;height:2px;overflow:hidden;background:#bd8302;">
			</td>
		</tr>';
$cuerpo.='<tr style="border-collapse:collapse;">
			<td style="border-collapse:collapse;color:#f1f3fd;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;padding: 10px" colspan="2">
			<div style="margin-left: 40px; margin-top: 10px; ">
				<img class="thumbnail-pic" alt="'.$params['from_name'].'" src="'.$params['from_pic'].'" style="width:40px; height: auto; float: left; margin-right:10px;">
				<b>'.$params['from_name'].'</b>
				<p style="text-align: left;padding: 10px;margin: 0;background: #131313;border: 1px solid #333333;">'.$params['message'].'</p>
				<a href="'.$params['url'].'?email=ecommerce_message:'.$account['token_hash'].':'.$emails.':'.$params['notifapp'].':'.$params['asset_id'].'#message_'.$params['asset_id'].'" style="color:#bd8302;">Responder</a></div>
			
			</td>
		</tr>';
$cuerpo.='
		<tr style="border-collapse:collapse;">
			<td style="border-collapse:collapse;color:#f1f3fd;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;" colspan="2">
				<hr style="border:none;height:2px;overflow:hidden;background:#bd8302;">
				<div style="font-size:13px;word-break:break-all;"> No funciona el botón? Pega este enlace en tu navegador:<br> <a href="'.$params['url'].'?email=ecommerce_message:'.$account['token_hash'].':'.$emails.':'.$params['notifapp'].':'.$params['asset_id'].'" style="color:#bd8302;text-decoration:none;font-size:80%;" target="_blank">'.$params['url'].'?email:ecommerce_message:'.$account['token_hash'].':'.$emails.':'.$params['notifapp'].':'.$params['asset_id'].'</a><img src="'.URLINDEX.'?email=open:'.$account['token_hash'].':'.$emails.':ecommerce_message" style="width:1px;height:1px">
</div>
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td style="padding:10px; text-align:center;" colspan="2">
				<a href="http://es.pitbullsandbullys.com/" target="_blank"><img src="http://es.pitbullsandbullys.com/img/img_logo.png" alt="Pitbulls and Bullys" width="50" height="48"></a>
			</td>
		</tr>
		<tr style="border-collapse:collapse;">
			<td style="padding:10px; text-align:center;" colspan="2">
				<a href="https://www.facebook.com/pitbullsandbullys/" target="_blank"><img src="http://es.pitbullsandbullys.com/img/fb-btn.png" alt="Siguenos en facebook" width="25" height="25"></a>
			</td>
		</tr>
	</tbody>
</table>';