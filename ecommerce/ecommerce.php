<?php
#Ecommerce

if(isset($_POST) && ($_POST['formtype']=='ecommerce'))
{
    if(isset($url)){
        $_POST['url']=$url;}

    $_POST['cat']=$ecommerce['cat'];
    $_POST['imgdir']=$ecommerce['imgdir'];
    if(isset($_POST['message'])){
        $formstatus=InsertContact($_POST);
    }elseif(isset($_POST['id'])){
        $formstatus=UpdateEcommerce($_POST); 
    }else{
        $formstatus=InsertEcommerce($_POST);
    }
	$_SESSION['feedback'][$_POST['formid']]['alert']=$formstatus['alert'];
	foreach ($formstatus['feedback'] as $field => $feedback) 
    {
        $_SESSION['feedback'][$_POST['formid']][$field]['status']=$feedback;
    }
}
if(isset($_POST) && $_POST['search']=='ecommerce')
{
    if(isset($_POST['county']) && !($_POST['county']=="all"|| $_POST['county']=='')){
         header("Location: ".$ecommerce['path']."en-".$_POST['county']);
    }elseif(isset($_POST['state']) && !($_POST['state']=="all" || $_POST['state']=='')){
        header("Location: ".$ecommerce['path']."en-".$_POST['state']);
    }elseif(isset($_POST['country']) && !($_POST['country']=="all" || $_POST['country']=='')){
        header("Location: ".$ecommerce['path']."en-".$_POST['country']);
    }else{
        header("Location: ".$ecommerce['path']."?p=1");
    }
}
function CreateAccount($params=array())
{
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
                    return $response['account']=$account;
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
                return $response['account']=$Account;
            }
            else
            {
                $response['alert']['warning'] = 'Disculpa no se guardo tu publicación, por favor intenta más tarde.';

                return $response;
            }  
        }
}
function InsertContact($params=array()){
    if(isset($_SESSION['logged']))
    {
        $account=$_SESSION['logged']['id'];
    }else{
       $result=CreateAccount($params);
       if(isset($result['Account'])){
        $Account=$result['Account'];
        $account=$result['Account']['id'];
    }else{
        return $result;
    }
       
    }

    if($account){
        $params = array_merge(array(
        'datetime'  => date("Y-m-d H:i:s"),
        'device'    => $_SESSION['device']['id'],
        'domain'    => UMSDOMAIN,
        'account'   => $account,
        'status'    => '0'
        ), $params);

        $resultado=SQLinsert(
            array(
                'table'=>'ecommerce_messages'
                ),
            array(
                'datetime'  => $params['datetime'],
                'domain'    => $params['domain'],
                'device'    => $params['device'],
                'url'       => $params['url'],
                'form'      => $params['formid'],
                'from'      => $params['account'],
                'to'        => $params['to'],
                'message'   => $params['message'],
                'status'     => '0'
                )
            );
        if($resultado)
        {
            if($params['funnel'])
            {
                
                NewLogin(array('type'=>'email','account'=>$params['account'])); 
  
                $_SESSION['logged']=$Account;
                if($networks = SearchNetworks($Account['id']))
                {
                    $_SESSION['logged']['networks']=$networks;
                }
                

                setcookie("token",$_SESSION['logged']['token_hash'],time()+7776000,"/", UMSDOMAIN);
            }
            else
            {
                NewLogin(array('type'=>'device','account'=>$params['account'])); 
            }
            
            $response['alert']['success'] = 'Gracias por tu mensaje, pronto te responderan.';

            return $response;
        }
        else
        {
            $response['alert']['warning'] = 'Disculpa no se guardo tu mensaje, por favor intenta más tarde.';
        }
        return $response;

    }
    else
    {
         $response['alert']['warning'] = 'Disculpa no se guardo tu mensaje, por favor intenta más tarde.';
        return $response;
    }
}
function InsertEcommerce($params=array())
{
	if(isset($_SESSION['logged']))
	{
        $account=$_SESSION['logged']['id'];
    }else{
       $result=CreateAccount($params);
       if(isset($result['account'])){
        $account=$result['account'];
    }else{
        return $result;
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

        $ubicacion='{"country":"'.$params['country'].'"';
        if($params['state']){
            $ubicacion.=',"state":"'.$params['state'].'"';
        }
        if($params['county']){
            $ubicacion.=',"county":"'.$params['county'].'"';
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

            $resultado=SQLinsert(
            array(
                'table'=>'ecommerce'
                ),
            array(
                'datetime'  => $params['datetime'],
                'domain'    => $params['domain'],
                'url'       => $ecommerce['path'].'pub_'.$value['id'].'.html',
                'type'      => 'ctc',
                'account'   => $params['account'],
                'status'    => '0',
                'group'     => '',
                'cat'       => $params['cat'],
                'location'  => $ubicacion,
                'title'     => $params['title'],
                'description'=> $params['ec_description']
                )
            );

            if($resultado && !empty($_FILES)) 
            { 
                
                include('class.upload_0.32/class.upload.php');
                $wImages=0;
                $x=0;
                for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                                                       
                    if($_FILES['images']['size'][$i] < 512000 && $i<10)
                    {
                        if(preg_match('#\.(?:jpe?g|png|gif)$#',$_FILES['images']['name'][$i]))
                        {
                            $image=array(
                                        'name'=>$_FILES['images']['name'][$i],
                                        'type'=>$_FILES['images']['type'][$i],
                                        'tmp_name'=>$_FILES['images']['tmp_name'][$i],
                                        'error'=>$_FILES['images']['error'][$i],
                                        'size'=>$_FILES['images']['size'][$i]);
                            $name=$resultado.'_'.$i;
                            $handle = new Upload($image);
                            if ($handle->uploaded) {
                                $handle->file_overwrite       = true;
                                // $handle->image_convert        = 'jpg';
                                $handle->file_new_name_body   = $name;
                                $handle->image_resize         = false;
                                $handle->image_ratio          = true;
                                $handle->Process($params['imgdir']);

                                $handle->file_overwrite       = true;
                                $handle->image_convert        = 'jpg';
                                $handle->file_new_name_body   = $name;
                                $handle->file_name_body_add   = '_thumbnail';
                                $handle->image_resize         = true;
                                $handle->image_ratio_crop     = true;
                                $handle->image_watermark      = 'ums/theme/'.THEMEDIR.'/watermark.png';
                                $handle->image_watermark_position = 'BR';
                                $handle->image_y              = 250;
                                $handle->image_x              = 300;
                                $handle->Process($params['imgdir']);

                                if ($handle->processed) {
                                $x++;
                                if($x!=1 || isset($ListIMG)){$ListIMG.=',';}
                                $ListIMG.='{"name":"'.$name.'","status":1}';
                                }else{
                                    $wImages++;
                                }
                                $handle-> Clean();
                            // if (move_uploaded_file($_FILES['images']['tmp_name'][$i],$params['imgdir'].$resultado.'_'.$i.'.'.pathinfo($_FILES['images']['name'][$i],PATHINFO_EXTENSION)))
                            // {
                            //     $x++;
                            //     if($x!=1){$ListIMG.=',';}
                            //     $ListIMG.='{"name":"'.$resultado.'_'.$i.'.'.pathinfo($_FILES['images']['name'][$i],PATHINFO_EXTENSION).'","status":1}';
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
                        'table' =>'ecommerce',
                        'limit' =>'LIMIT 1'
                    ),
                    array(
                        'id' => $resultado
                    ),
                    array(
                        'images'=> '{"dir":"'.URLINDEX.$params['imgdir'].'","list":['.$ListIMG.']}'
                    ));
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
                $response['alert']['warning'] = '('.$wImages.') imagenes no se guardaron. Deben medir menos de 0.5Mb (512Kb), ser (JPG,PNG,GIF) y máximo 10.';
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
        return $response;
	}		
}
function UpdateEcommerce($params=array())
{
        $params = array_merge(array(
        'datetime'  => date("Y-m-d H:i:s"),
        'domain'    => UMSDOMAIN,
        'account'   => $_SESSION['logged']['id'],
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

        $ubicacion='{"country":"'.$params['country'].'"';
        if($params['state']){
            $ubicacion.=',"state":"'.$params['state'].'"';
        }
        if($params['county']){
            $ubicacion.=',"county":"'.$params['county'].'"';
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
        $result=SQLselect(
              array(
                  'table' => 'ecommerce',
                  'limit' => 'LIMIT 1'
                ),
              array(
                  'id' => $params['id']
                )
            );
        foreach ($params['ec_images'] as $key => $value) {
            $activeimg[$value]=1;
        }
        if($images=json_decode($result['images'], true)){
            $ListIMG='';
            foreach ($images['list'] as $key => $value) {
                $x++;
                if($x!=1){$ListIMG.=',';}
                if(!isset($activeimg[$value['name']]))
                {
                    $ListIMG.='{"name":"'.$value['name'].'","status":0}';
                }else{
                    $ListIMG.='{"name":"'.$value['name'].'","status":1}';
                    $max++;
                }
            }
        }

            if(!empty($_FILES)) 
            {
                include('class.upload_0.32/class.upload.php');
                for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                                                       
                    if($_FILES['images']['size'][$i] < 512000 && $i<(10-$max))
                    {
                        if(preg_match('#\.(?:jpe?g|png|gif)$#',$_FILES['images']['name'][$i]))
                        {
                            $num=$i+count($images['list']);
                            $handle = new Upload($_FILES['images']['tmp_name'][$i]);
                            if ($handle->uploaded) {
                                $handle->file_overwrite       = true;
                                $handle->image_convert        = 'jpg';
                                $handle->file_new_name_body   = $result['id'].'_'.$num;
                                $handle->image_resize         = false;
                                $handle->image_ratio          = true;
                                $handle->Process($params['imgdir']);

                                $handle->file_overwrite       = true;
                                $handle->image_convert        = 'jpg';
                                $handle->file_new_name_body   = $result['id'].'_'.$num;
                                $handle->file_name_body_add   = '_thumbnail';
                                $handle->image_resize         = true;
                                $handle->image_ratio_crop     = true;
                                $handle->image_watermark      = 'ums/theme/'.THEMEDIR.'/watermark.png';
                                $handle->image_watermark_position = 'BR';
                                $handle->image_y              = 250;
                                $handle->image_x              = 300;
                                $handle->Process($params['imgdir']);

                                if ($handle->processed) {
                                $x++;
                                if($x!=1 || isset($ListIMG)){$ListIMG.=',';}
                                $ListIMG.='{"name":"'.$result['id'].'_'.$num.'","status":1}';
                                }else{
                                    $wImages++;
                                }
                                $handle-> Clean();
                            // if (move_uploaded_file($_FILES['images']['tmp_name'][$i],$params['imgdir'].$result['id'].'_'.$num.'.'.pathinfo($_FILES['images']['name'][$i],PATHINFO_EXTENSION)))
                            // {
                            //     $x++;
                            //     if($x!=1 || isset($ListIMG)){$ListIMG.=',';}
                            //     $ListIMG.='{"name":"'.$result['id'].'_'.$num.'.'.pathinfo($_FILES['images']['name'][$i],PATHINFO_EXTENSION).'","status":1}';
                            }
                            else{
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
                
            }
        $update=SQLupdate(
                    array(
                        'table'=>'ecommerce'
                        ),
                    array(
                        'id'=>$params['id']
                    ),
                    array(
                        'status'        => '0',
                        'location'      => $ubicacion,
                        'title'         => $params['title'],
                        'description'   => $params['ec_description'],
                        'images'        => '{"dir":"'.URLINDEX.$params['imgdir'].'","list":['.$ListIMG.']}'
                        )
                    );
        

        if($update)
        {
            
            
            $response['alert']['success'] = 'Tu publicación se actualizo, pronto te responderemos.';
            if($wImages){
                $response['alert']['warning'] = '('.$wImages.') imagenes no se guardaron. Deben medir menos de 0.5Mb (512Kb), ser (JPG,PNG,GIF) y máximo 10.';
            }

            return $response;
        }
        else
        {
            $response['alert']['warning'] = 'Disculpa no se guardo tu actualización, por favor intenta más tarde.';
        }
        return $response;       
}