<?php
#Adopciones

if(isset($_POST) && ($_POST['formtype']=='adopcion' || $_POST['formtype']=='adoptante'))
{
    if(isset($url))
        {$_POST['url']=$url;}
    $formstatus=InsertAdopcion($_POST);
    
	$_SESSION['feedback'][$_POST['formid']]['alert']=$formstatus['alert'];
	foreach ($formstatus['feedback'] as $field => $feedback) 
    {
        $_SESSION['feedback'][$_POST['formid']][$field]['status']=$feedback;
    }
}
function InsertAdopcion($params=array())
{
	if(isset($_SESSION['logged']))
	{
        $account=$_SESSION['logged']['id'];
    }else{
        include 'ums/accounts/function_NewAccount.php';
        include 'ums/accounts/function_SearchAccount.php';
        include 'ums/accounts/function_SearchNetworks.php';
        include 'ums/accounts/function_SearchContacts.php'; 

        $rol='1';
        if($params['funnel'])
        {
            $pass=substr(md5(uniqid(rand())),0,4);
            $rol='0';
        }
        $resultado=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1'
                ),
            array(
                'domain'=>UMSDOMAIN,
                'useremail'=> $params['email']
                )
            );
        if($resultado && $params['funnel'])
        {
            if($resultado['role']=='0')
            {
                $response['alert']=array('danger' => 'Este correo ya esta en uso. Debes iniciar sesion.');
                $response['feedback']['email'] = 'invalid';
                return $response;
            }
            else
            {
                if(SQLupdate(
                        array(
                            'table'=>'accounts'
                            ),
                        array(
                            'id'=>$resultado['id']
                            ),
                        array(
                            'password'=>$pass,
                            'role'=>$rol
                            )
                        ))
                {
                    $account=$resultado['id'];
                }
            }
        }
        elseif($resultado && !$params['funnel'])
        {
            if($resultado['role']=='0')
            {
                $response['alert']=array('danger' => 'Este correo ya esta en uso. Debes iniciar sesion.');
                $response['feedback']['email'] = 'invalid';

                return $response;
            }
        }
        else
        {   
                $avatars=scandir("ums/theme/".THEMEDIR."/avatars/");
                $rand=rand(2,count($avatars)-1);
                $pic=$avatars[$rand];
            
                
                $Account=NewAccount(array(
                                    'name'          => $params['name'],
                                    'useremail'     => $params['email'],
                                    'password'      => $pass,
                                    'pic'           => 'avatar',
                                    'role'          => $rol,
                                    'form_id'       => $params['formid'],
                                    'url_ref'       => strtok($_SERVER['HTTP_REFERER'],'?')
                                ));
                $account=$Account['id'];
            if($account)
            {

                AddAvatar($account,URLTHEME.'avatars/'.$pic);
            }
            else
            {
                $response['alert']['warning'] = 'Disculpa no se guardo tu contribución, por favor intenta más tarde.';

                return $response;
            }  
        }
    }

    if($account){

        $params = array_merge(array(
        'datetime'  => date("Y-m-d H:i:s"),
        'domain'    => UMSDOMAIN,
        'account'   => $account,
        'status'    => '0'
        ), $params);

        $location=SQLselect(array('table'=>'accounts_contact',
                                    'limit'=>'LIMIT 1',
                            'query'=>'
                            SELECT `data` 
                            FROM `accounts_contact` a 
                            WHERE 
                            a.`datetime` = ( SELECT MAX(`datetime`) FROM `accounts_contact` WHERE `type` = "ubicacion") 
                            AND a.`account` = "'.$params['account'].'" 
                            AND a.`type` = "ubicacion"
                            LIMIT 1
                            '));

        $ubicacion='{"pais":"'.$params['pais'].'"';
        if($params['estado']){
            $ubicacion.=',"estado":"'.$params['estado'].'"';
        }
        if($params['municipio']){
            $ubicacion.=',"municipio":"'.$params['municipio'].'"';
        }
        $ubicacion.='}';

        if($ubicacion!=$location['data']){
            SQLinsert(
                array('table' => 'accounts_contact'),
                array(
                    'datetime'  => $params['datetime'],
                    'domain'    => $params['domain'],
                    'account'   => $params['account'],
                    'type'      => 'ubicacion',
                    'data'      => $ubicacion
                    )
                );
        }

        if($params['formtype']=='adopcion'){
            $resultado=SQLinsert(
            array(
                'table'=>'ecommerce'
                ),
            array(
                'datetime'  => $params['datetime'],
                'domain'    => $params['domain'],
                'type'      => 'ctc',
                'account'   => $params['account'],
                'status'    => '0',
                'group'     => '',
                'cat'       => $params['formtype'],
                'location'  => $ubicacion,
                'data'      => '{"perro":{"nombre":"'.$params['perro'].'","edad":"'.$params['edad'].'","color":"'.$params['color'].'","sexo":"'.$params['sexo'].'"},    "veterinario":{"esterelizado":"'.$params['esterelizado'].'","vacunado":"'.$params['vacunado'].'","desparasitado":"'.$params['desparasitado'].'","alergia":"'.$params['alergias'].'"},"social":{"adultos":"'.$params['adultos'].'","niños":"'.$params['ninos'].'","gatos":"'.$params['gatos'].'","perros":"'.$params['perros'].'"},"requisitos":"'.$params['requisitos'].'",    "puntos":"'.$params['puntos'].'","proceso":"'.$params['proceso'].'"}',
                'title'     => $params['titulo'],
                'description'=> $params['descripcion']
                )
            );

            if($resultado && !empty($_FILES)) 
            { 
                for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                 
                    if($_FILES['images']['size'][$i] < 2097152)
                    {
                        if(preg_match('#\.(?:jpe?g|png|gif)$#',$_FILES['images']['name'][$i]))
                        {
                            if (move_uploaded_file($_FILES['images']['tmp_name'][$i],ADIMGDIR.$resultado.'_'.$i.'.'.pathinfo($_FILES['images']['name'][$i],PATHINFO_EXTENSION)))
                            {
                                $x++;
                                if($x!=1){$ListIMG.=',';}
                                $ListIMG.='"'.$resultado.'_'.$i.'.'.pathinfo($_FILES['images']['name'][$i],PATHINFO_EXTENSION).'"';
                            }else{
                                $wImages++;
                            }
                        }else{
                            $wImages++;
                        }
                    }
                    else{
                        $wImages++;
                    }
                }

                SQLupdate(
                    array(  
                        'table' =>'ads',
                        'limit' =>'LIMIT 1'
                    ),
                    array(
                        'id' => $resultado
                    ),
                    array(
                        'images'=> '{"dir":"'.URLINDEX.ADIMGDIR.'","list":['.$ListIMG.']'
                    ));
            }

        }else{
            $resultado=SQLinsert(
            array(
                'table'=>'quiz'
                ),
            array(
                'datetime'  => $params['datetime'],
                'domain'    => $params['domain'],
                'account'   => $params['account'],
                'type'      => $params['formtype'],
                'data'      => '{"perfil":{"familia":"'.$params['familia'].'","reto":"'.$params['reto'].'","responsabilidad":"'.$params['responsabilidad'].'"},"porque":"'.$params['porque'].'"}'
                )
            );
        }

        

    	if($resultado)
    	{
            if($params['funnel'])
            {
                
                NewLogin(array('type'=>'email','account'=>$account)); 
  
                $_SESSION['logged']=$Account;
                if($networks = SearchNetworks($Account['id']))
                {
                    $_SESSION['logged']['networks']=$networks;
                }
                

                setcookie("token",$_SESSION['logged']['token_hash'],time()+7776000,"/", UMSDOMAIN);
            }
            else
            {
                NewLogin(array('type'=>'device','account'=>$account)); 
            }
            
        	$response['alert']['success'] = 'Gracias por tu publicacion, pronto te responderemos.';
            if($wImages){
                $response['alert']['warning'] = '('.$wImages.') imagenes no se guardaron. Deben medir menos de 2Mb y ser (JPG,PNG,GIF)';
            }

            return $response;
    	}
    	else
    	{
        	$response['alert']['warning'] = 'Disculpa no se guardo tu publicacion, por favor intenta más tarde.';
    	}
    	return $response;
	}
	else
	{
        $response['alert']['warning'] = 'Disculpa no se guardo tu publicacion, por favor intenta más tarde.';
	}		
}