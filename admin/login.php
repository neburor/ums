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
	include '../mysql_db.php';
    if(!isset($_SESSION['device']))
    {
        define("UMSDOMAIN",'hostingmex.com.mx');
        include '../global/function_device.php';
        if(isset($_COOKIE['device']))
        {
            $response['device']='Cookie=>search |'.UMSDOMAIN;
            SearchDevice();
        }
        else
        {
            $response['device']='no cookie=>new |'.UMSDOMAIN;
            NewDevice();
        }
    }

	if($dataForm['formtype']=='login')
	{
		$resultado=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1'
                ),
            array(
                'domain'=>'hostingmex.com.mx',
                'useremail'=> $dataForm['useremail'],
                'role'=>'3'
                )
            );
        if($resultado)
        {
        	if($dataForm['userpass']==$resultado['password'])
            {
        		$response['alert']['success']='Usuario valido.';
                $_SESSION['token']=$response['token']=$resultado['token_hash'];
                $_SESSION['id']=$resultado['id'];
                if($dataForm['autologin'])
                {
                    setcookie("token",$resultado['token_hash'],time()+7776000,"/");
                }

                $domain=SQLselect(
                    array(
                        'table'=>'accounts_roles'
                        ),
                    array(
                        'account'=>$resultado['id']
                        )
                    );
                if($domain)
                {
                    $_SESSION['domains']=array();
                    foreach ($domain as $key => $value) {
                        $_SESSION['domains'][]=$value['domain'];
                    }
                    $response['domains']=$_SESSION['domains'][0];
                }
        	}
        	else
        	{
        		$response['alert']['warning']='Contraseña no valida.';
        	}
        }
        else
        {
        	$response['alert']['error']='Usuario o contraseña no validos.';
        }
	}
    if($dataForm['token'] && !$dataForm['login'])
    {
        $resultado=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1'
                ),
            array(
                'domain'=>'hostingmex.com.mx',
                'token_hash'=> $dataForm['token'],
                'role'=>'3'
                )
            );
        if($resultado)
        {
            $_SESSION['token']=$resultado['token_hash'];
            $_SESSION['id']=$resultado['id'];
            $domain=SQLselect(
                array(
                    'table'=>'accounts_roles'
                    ),
                array(
                    'account'=>$resultado['id']
                    )
                );
            if($domain)
            {
                $_SESSION['domains']=array();
                foreach ($domain as $key => $value) {
                    $_SESSION['domains'][]=$value['domain'];
                }
            }
        }
    }
	
echo json_encode($response);
}