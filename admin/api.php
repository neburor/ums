<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	#Caracteres a sustituir
	$caracteresB= array('+','*','=','|','&','<','>','(',')',';','#','"',"'");
	$caracteresR= array('','','','','','','','','','','','','');
	#Filtrar datos del formulario
	foreach( $_POST as $name => $value ) {
		#Creando un array con los datos del formulario ya filtrados
		$dataForm[$name]=str_replace($caracteresB, $caracteresR, $_POST[$name]);
	}

	session_start();
    $domains = 0;
    foreach ($_SESSION['domains'] as $key => $value) {
        if($dataForm['domain']==$value)
        {
            $domains++;
        }
    }
	if($dataForm['token'] && ($dataForm['token']==$_SESSION['token'] || $dataForm['token']==$_COOKIE['token']) && $domains)
    {
        include '../mysql_db.php';
        include '../global/functions.php';
        if($dataForm['action']){
            switch ($dataForm['action']) {
            case 'active':
                include 'active.php';
                break;
            case 'reply':
                include 'reply.php';
                break;
            case 'archive':
                include 'archive.php';
                break;
            case 'ban':
                include 'ban.php';
                break;
            default:
                echo 'error';
            } 
        }elseif($dataForm['content']) {

            include $dataForm['content'].'.php';
            
        }elseif ($dataForm['formtype']) {
            switch ($dataForm['formtype']) {
            case 'reply':
                include 'reply.php';
                break;
            case 'email':
                include 'email.php';
                break;
            case 'edit':
                include 'edit.php';
                break;
            case 'wiki':
                include 'wiki.php';
                break;
            default:
                echo 'error';
            }
        }
    }
    else
    {
        echo 'error';
    }
}