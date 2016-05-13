<?php
#Send email confirmation
function Send_confirmation()
{
	$TOemail=$_SESSION['profile']['email'];
	$TOname=$_SESSION['profile']['name'];

	#Email
	$cuerpo ='<table style="border-collapse:collapse;width:100%;"><tbody><tr style="border-collapse:collapse;"><td style="padding:10px;background:#242424;">';
	$cuerpo.='<a href="" target="_blank"><img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png" alt="Administracion de usuarios Web" width="191" height="30"></a></td>';
	$cuerpo.='<td align="right" style="padding:10px;background:#242424;"><a href="'.URLSYSTEM.'?tab=preferencias" style="color:#9d9d9d;text-decoration:none;font-size:85%;font-weight:500;" target="_blank">Preferencias</a></td></tr></tbody></table>';

	$cuerpo.='<table style="border-collapse:collapse;width:100%;"><tbody><tr style="border-collapse:collapse;"><td>';
	$cuerpo.='<div style="text-align:center;padding-top:50px;padding-left:10%;padding-bottom:50px;padding-right:10%;"><h2 style="font-weight:500;font-size:24px;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.4;letter-spacing:-0.045em;color:#5a6267;color:#555;"><strong>'.$TOname.'</strong>, bienvenido a '.UMSDOMAIN.'</h2></div></td></tr>';
	$cuerpo.='<tr style="border-collapse:collapse;"><td><hr style="border:none;height:2px;overflow:hidden;background:#e4e9ec;"><div style="text-align:center;padding-top:10px;padding-left:10%;padding-bottom:10px;padding-right:10%;">
<p style="color:#353a3d;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;"><a href="'.URLSYSTEM.'account/confirmation.php?token='.$_SESSION['profile']['token_hash'].'&domain='.UMSDOMAIN.'" style="color:#fff;text-decoration:none;font-weight:700;background-color:#181818;font-size:18px;padding-top:8px;padding-left:16px;padding-bottom:8px;padding-right:16px;border-radius:3px;line-height:1.5em;display:block;border: 1px solid #000;-webkit-box-shadow: inset 0 1px 0 #383838;-moz-box-shadow: inset 0 1px 0 #383838;box-shadow: inset 0 1px 0 #383838;" target="_blank"><span style="color:#fff;font-weight:normal;">Confirmar ‘</span>'.$TOemail.'<span style="color:#fff;font-weight:normal;">’</span></a></p></div></td></tr>';

	$cuerpo.='<tr style="border-collapse:collapse;"><td style="border-collapse:collapse;color:#353a3d;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;text-align:center;width:inherit;display:block;"><h3 style="font-weight:300;font-size:18px;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;line-height:1.4;letter-spacing:-0.045em;color:#5a6267;"><strong style="color:#333;">Porque confirmar mi correo ?</strong></h3><p style="color:#353a3d;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">Es necesario que confirmes tu correo para prevenir el SPAM y asegurarnos que esta correctamente escrito.</p></td></tr>';
	$cuerpo.='<tr style="border-collapse:collapse;"><td style="border-collapse:collapse;color:#353a3d;font-size:16px;font-weight:400;word-wrap:break-word;line-height:1.4;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;"><hr style="border:none;height:2px;overflow:hidden;background:#e4e9ec;"><div style="font-size:13px;word-break:break-all;"> No funciona el botón? Pega este enlace en tu navegador:<br> <a href='.URLSYSTEM.'account/confirmation.php?token='.$_SESSION['profile']['token_hash'].'&domain='.UMSDOMAIN.'" style="color:#49B3F5;text-decoration:none;font-size:80%;" target="_blank">'.URLSYSTEM.'account/confirmation.php?token='.$_SESSION['profile']['token_hash'].'&domain='.UMSDOMAIN.'</a></div></td></tr>';

	$cuerpo.='</tbody></table>';
    
    $headers = "MIME-Version: 1.0" . "\n"; 
    $headers .="Content-type: text/html; charset=utf-8" . "\n";
    $headers .="From: ".UMSDOMAIN." <contacto@".UMSDOMAIN.">" . "\r\n";
    $headers .="X-Sender: <x-sender@".UMSDOMAIN.">\n" . "\r\n";

     if (mail($TOemail,$TOname." confirma tu correo.",$cuerpo,$headers))
     {
     	return true;
     }
     else
     {
     	return false;
     }
}