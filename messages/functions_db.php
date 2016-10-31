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
                'url'=> 'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'),
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
                'username'=> $params['email'],
                'role'=>$rol
                )
            );
        if($resultado && $params['funnel'])
        {
            $response['alert']=array('danger' => 'Este correo ya esta en uso. Debes iniciar sesion.');
            $response['feedback']['email'] = 'invalid';

            return $response;
        }
        elseif($resultado && !$params['funnel'])
        {
            $message=SQLinsert(
                        array(
                            'table'=>'messages'
                            ),
                        array(
                            'datetime'=> date("Y-m-d H:i:s"),
                            'domain'=> UMSDOMAIN,
                            'device'=> $_SESSION['device']['id'],
                            'url'=> 'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'),
                            'form'=> $params['formtype'], 
                            'from_id'=> $_SESSION['logged']['id'], 
                            'to_id'=> '0',
                            'message'=> $params['message']
                            )
                        );
        }
        else
        {   if(AVATARS)
            {
                $avatars=scandir(AVATARS);
                $rand=rand(2,count($avatars)-1);
                $pic=$avatars[$rand];
            }

            $account=SQLinsert(
                array(
                    'table'=>'accounts'
                    ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> UMSDOMAIN,
                    'token_hash'=> '',
                    'user_hash'=> '', 
                    'name'=> $params['name'], 
                    'username'=> $params['email'],
                    'password'=>$pass,
                    'pic'=>'avatar',
                    'cover'=>'',
                    'role'=>$rol
                    )
            );
            if($account)
            {

                AddAvatar($account,AVATARS.'/'.$pic);

                $message=SQLinsert(
                        array(
                            'table'=>'messages'
                            ),
                        array(
                            'datetime'=> date("Y-m-d H:i:s"),
                            'domain'=> UMSDOMAIN,
                            'device'=> $_SESSION['device']['id'],
                            'url'=> 'http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'),
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
                include 'ums/accounts/function_hash.php';
                AddHash($account);
                $resultado=SQLselect(
                        array(
                            'table'=>'accounts',
                            'limit'=>'LIMIT 1'
                            ),
                        array(
                            'domain'=>UMSDOMAIN,
                            'id'=> $account
                            )
                        );

                $_SESSION['logged']=$resultado;
                include 'ums/accounts/function_SearchNetworks.php';
                if($networks = SearchNetworks($resultado['id']))
                {
                    $_SESSION['logged']['networks']=$networks;
                }

                setcookie("token",$_SESSION['logged']['token_hash'],time()+7776000,"/", UMSDOMAIN);
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