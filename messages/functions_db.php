<?php
//Functions Messages
function InsertMessage($params=array())
{
	if(isset($_SESSION['logged']))
	{
        $resultado=SQLinsert(
            array(
                'table'=>'messages'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'],
                'url'=> URL,
                'form'=> $params['formtype'], 
                'from_id'=> $_SESSION['logged']['id'], 
                'to_id'=> '0',
                'message'=> $params['message']
                )
            );

    	if($resultado)
    	{
        	$response['alert']['success'] = 'Gracias por contactarnos, pronto te responderemos.';
    	}
    	else
    	{
        	$response['alert']['warning'] = 'Disculpa no se guardo tu mensaje, por favor intenta más tarde.';
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
                $message=SQLinsert(
                        array(
                            'table'=>'messages'
                            ),
                        array(
                            'datetime'=> date("Y-m-d H:i:s"),
                            'domain'=> UMSDOMAIN,
                            'device'=> $_SESSION['device']['id'],
                            'url'=> URL,
                            'form'=> $params['formtype'], 
                            'from_id'=> $resultado['id'], 
                            'to_id'=> '0',
                            'message'=> $params['message']
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
                $message=SQLinsert(
                        array(
                            'table'=>'messages'
                            ),
                        array(
                            'datetime'=> date("Y-m-d H:i:s"),
                            'domain'=> UMSDOMAIN,
                            'device'=> $_SESSION['device']['id'],
                            'url'=> URL,
                            'form'=> $params['formtype'], 
                            'from_id'=> $resultado['id'], 
                            'to_id'=> '0',
                            'message'=> $params['message']
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

                $message=SQLinsert(
                        array(
                            'table'=>'messages'
                            ),
                        array(
                            'datetime'=> date("Y-m-d H:i:s"),
                            'domain'=> UMSDOMAIN,
                            'device'=> $_SESSION['device']['id'],
                            'url'=> URL,
                            'form'=> $params['formtype'], 
                            'from_id'=> $account, 
                            'to_id'=> '0',
                            'message'=> $params['message']
                            )
                        );
            }
            else
            {
                $response['alert']['warning'] = 'Disculpa no se guardo tu mensaje, por favor intenta más tarde.';

                return $response;
            }  
        }
        if($message)
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
            $response['alert']['success'] = 'Gracias por tu mensaje. Pronto te responderemos.';

            return $response;
        }
        else
        {
            $response['alert']['warning'] = 'Disculpa no se guardo tu mensaje, por favor intenta más tarde.';

            return $response;
        }

	}		
}
function ListMessages($account)
{
    $resultado=SQLselect(
            array(
                'table'=>'messages',
                'query'=>"SELECT * FROM `messages` WHERE `domain` = '".UMSDOMAIN."' AND (`from_id` = '".$account."' OR `to_id` = '".$account."') ORDER BY `id` ASC"
                )
            );

    if($resultado)
    {
        return $resultado;
    }
    else
    {
        return null;
    }
}