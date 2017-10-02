<?php
#Glossary
$sc=$sc_url=array("'",".",",","?","!","¡","¿","ñ",":","á","é","í","ó","ú");
$pc=$pc_url=array("","","","","","","","n","","a","e","i","o","u");
$sc_url[]=" ";
$pc_url[]="";
if(isset($_POST) && $_POST['formtype']=='glossary')
{
	$formstatus=InsertTerm($_POST);
	$_SESSION['feedback'][$_POST['formid']]['alert']=$formstatus['alert'];
	foreach ($formstatus['feedback'] as $field => $feedback) 
    {
        $_SESSION['feedback'][$_POST['formid']][$field]['status']=$feedback;
    }
}
function InsertTerm($params=array())
{
	if(isset($_SESSION['logged']))
	{
        $resultado=SQLinsert(
            array(
                'table'=>'content_glossary'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'account'=> $_SESSION['logged']['id'],
                'status'=>'0',
                'term'=>str_replace($sc, $pc, strtolower($params['term'])),
                'display'=>$params['term'],
                'words'=>str_replace($sc, $pc, strtolower($params['term'])).', '.$params['term'],
                'description'=>$params['description'],
                'wiki'=>'0',
                'url'=>'https://www.coleccionotrosmundos.com/glosario/'.str_replace($sc_url, $pc_url, strtolower($params['term'])).'.html',
                'title'=>$params['term']
                )
            );

    	if($resultado)
    	{
        	$response['alert']['success'] = 'Gracias por contribuir, pronto te responderemos.';
    	}
    	else
    	{
        	$response['alert']['warning'] = 'Disculpa no se guardo tu contribución, por favor intenta más tarde.';
    	}
    	return $response;
	}
	else
	{
        include 'ums/accounts/function_NewAccount.php';
        include 'ums/accounts/function_SearchAccount.php';
        include 'ums/accounts/function_SearchNetworks.php'; 

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
                $glossary=SQLinsert(
                        array(
                            'table'=>'content_glossary'
                            ),
                        array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'account'=> $_SESSION['logged']['id'],
                'status'=>'0',
                'term'=>str_replace($sc, $pc, strtolower($params['term'])),
                'display'=>$params['term'],
                'words'=>str_replace($sc, $pc, strtolower($params['term'])).', '.$params['term'],
                'description'=>$params['description'],
                'wiki'=>'0',
                'url'=>'https://www.coleccionotrosmundos.com/glosario/'.str_replace($sc_url, $pc_url, strtolower($params['term'])).'.html',
                'title'=>$params['term']
                			)
                        );
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
            else
            {
                $glossary=SQLinsert(
                        array(
                            'table'=>'content_glossary'
                            ),
                        array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'account'=> $_SESSION['logged']['id'],
                'status'=>'0',
                'term'=>str_replace($sc, $pc, strtolower($params['term'])),
                'display'=>$params['term'],
                'words'=>str_replace($sc, $pc, strtolower($params['term'])).', '.$params['term'],
                'description'=>$params['description'],
                'wiki'=>'0',
                'url'=>'https://www.coleccionotrosmundos.com/glosario/'.str_replace($sc_url, $pc_url, strtolower($params['term'])).'.html',
                'title'=>$params['term']
                			)
                        );
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
		$glossary=SQLinsert(
                        array(
                            'table'=>'content_glossary'
                            ),
                        array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'account'=> $_SESSION['logged']['id'],
                'status'=>'0',
                'term'=>str_replace($sc, $pc, strtolower($params['term'])),
                'display'=>$params['term'],
                'words'=>str_replace($sc, $pc, strtolower($params['term'])).', '.$params['term'],
                'description'=>$params['description'],
                'wiki'=>'0',
                'url'=>'https://www.coleccionotrosmundos.com/glosario/'.str_replace($sc_url, $pc_url, strtolower($params['term'])).'.html',
                'title'=>$params['term']
                			)
                        );
            }
            else
            {
                $response['alert']['warning'] = 'Disculpa no se guardo tu contribución, por favor intenta más tarde.';

                return $response;
            }  
        }
        if($glossary)
        { 
                         
            if($params['funnel'])
            {
                #include 'ums/accounts/function_hash.php';
                NewLogin(array('type'=>'email','account'=>$account)); 
                /*AddHash($account);
                $resultado=SQLselect(
                        array(
                            'table'=>'accounts',
                            'limit'=>'LIMIT 1'
                            ),
                        array(
                            'domain'=>UMSDOMAIN,
                            'id'=> $account
                            )
                        );*/

                #$_SESSION['logged']=$resultado;
                $_SESSION['logged']=$Account;
                #include 'ums/accounts/function_SearchNetworks.php';
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
            $response['alert']['success'] = 'Gracias por tu contribución. Pronto te responderemos.';

            return $response;
        }
        else
        {
            $response['alert']['warning'] = 'Disculpa no se guardo tu contribución, por favor intenta más tarde.';

            return $response;
        }

	}		
}