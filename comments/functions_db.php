<?php
//Functions Messages

function InsertComment($params=array())
{
    $params = array_merge(array(
        'route'=> '0:0:0'
    ), $params);
    $params['route'] = explode(":", $params['route']);

	if(isset($_SESSION['logged']))
	{
        $resultado=SQLinsert(
            array(
                'table'=>'comments'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'domain'=> UMSDOMAIN,
                'device'=> $_SESSION['device']['id'],
                'url'=> URL,
                'form'=> $params['formtype'], 
                'from_id'=> $_SESSION['logged']['id'], 
                'to_id'=> $params['route'][0],
                'in_id'=> $params['route'][1],
                'to_comm'=> $params['route'][2],
                'comment'=> $params['comment']
                )
            );

    	if($resultado)
    	{
        	$response['alert']['success'] = 'Gracias por tu comentario.';
    	}
    	else
    	{
        	$response['alert']['warning'] = 'Disculpa no se guardo tu comentario, por favor intenta más tarde.';
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
                $comment=SQLinsert(
                        array(
                            'table'=>'comments'
                            ),
                        array(
                            'datetime'=> date("Y-m-d H:i:s"),
                            'domain'=> UMSDOMAIN,
                            'device'=> $_SESSION['device']['id'],
                            'url'=> URL,
                            'form'=> $params['formtype'], 
                            'from_id'=> $resultado['id'], 
                            'to_id'=> $params['route'][0],
                            'in_id'=> $params['route'][1],
                            'to_comm'=> $params['route'][2],
                            'comment'=> $params['comment']
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
                $comment=SQLinsert(
                        array(
                            'table'=>'comments'
                            ),
                        array(
                            'datetime'=> date("Y-m-d H:i:s"),
                            'domain'=> UMSDOMAIN,
                            'device'=> $_SESSION['device']['id'],
                            'url'=> URL,
                            'form'=> $params['formtype'], 
                            'from_id'=> $resultado['id'], 
                            'to_id'=> $params['route'][0],
                            'in_id'=> $params['route'][1],
                            'to_comm'=> $params['route'][2],
                            'comment'=> $params['comment']
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
                                    'role'          => $rol
                                ));
                $account=$Account['id'];

            if($account)
            {

                AddAvatar($account,URLTHEME.'avatars/'.$pic);

                $comment=SQLinsert(
                        array(
                            'table'=>'comments'
                            ),
                        array(
                            'datetime'=> date("Y-m-d H:i:s"),
                            'domain'=> UMSDOMAIN,
                            'device'=> $_SESSION['device']['id'],
                            'url'=> URL,
                            'form'=> $params['formtype'], 
                            'from_id'=> $account, 
                            'to_id'=> $params['route'][0],
                            'in_id'=> $params['route'][1],
                            'to_comm'=> $params['route'][2],
                            'comment'=> $params['comment']
                            )
                        );
            }
            else
            {
                $response['alert']['warning'] = 'Disculpa no se guardo tu comentario, por favor intenta más tarde.';

                return $response;
            }  
        }
        if($comment)
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
            $response['alert']['success'] = 'Gracias por tu comentario.';

            return $response;
        }
        else
        {
            $response['alert']['warning'] = 'Disculpa no se guardo tu comentario, por favor intenta más tarde.';

            return $response;
        }  
	}		
}
function ListComments($url)
{
    if(isset($_SESSION['logged']))
    {
        $liked="`account` = '".$_SESSION['logged']['id']."'";
        $usercomments=" OR (comments.`url` = '".$url."' AND (comments.`from_id`='".$_SESSION['logged']['id']."' || comments.`to_id`='".$_SESSION['logged']['id']."'))";
    }
    else
    {
        $liked="`device` = '".$_SESSION['device']['id']."' AND `account` = '0'";
    }
    $resultado=SQLselect(
            array(
                'table'=>'comments',
                'query'=>"SELECT 
    comments.`id`,
    comments.`datetime`,
    comments.`form`,
    comments.`from_id`,
    comments.`to_id`,
    comments.`in_id`,
    comments.`comment`,
    comments.`status`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`,
    Case accounts.`name`
        When comments.`to_id` = accounts.`id`
        Then (SELECT accounts.`name` FROM `accounts` WHERE accounts.`id`= comments.`to_id`)
    END
    AS `to_name`,
 (select count(*) from `likes` where `asset`= 'comment' and `asset_id` = comments.`id` and `like` = '1') 
 AS `likes`,
 (select `like` from `likes` where `asset`= 'comment' and `asset_id` = comments.`id` and ".$liked." ORDER BY `id` DESC LIMIT 1) 
 AS `liked`
    FROM `comments` 
        LEFT JOIN `accounts`
            ON comments.`from_id` = accounts.`id`
            OR comments.`to_id` = accounts.`id`
        LEFT JOIN `accounts_sn`
            ON comments.`from_id` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
    WHERE comments.`url` = '".$url."'
    AND (comments.`status`='1' || comments.`status`='2' || comments.`status`='3')
    ".$usercomments."
    GROUP BY comments.`id`
    ORDER BY comments.`id`
    DESC"
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