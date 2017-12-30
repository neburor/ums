<?php
//ListContacts


$ListContacts=ListContacts('http://'.$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?'));
echo '<ul class="list-group">';
if($ListContacts)
{
    $LIcontacts=LIcontacts($ListContacts);
	echo '<li class="list-group-item">
            <i class="fa fa-users"></i> <span>'.$LIcontacts['count'].'</span> contacto';
        if($LIcontacts['count']!=1)
        {
            echo 's';
        }
	echo ' <i class="fa fa-envelope"></i> <span>'.count($ListContacts).'</span> mensaje';
		if(count($ListContacts)!=1)
		{
			echo 's';
		}
	echo '</li>';

	echo $LIcontacts['contacts_list'];
}
else
{
	echo '<li class="list-group-item">
			<i class="fa fa-envelope"></i> Ningun mensaje
		</li>';
}
echo '
	</ul>';
function ListContacts($url)
{
    $resultado=SQLselect(
            array(
                'table'=>'ecommerce_messages',
                'query'=>"SELECT 
    contacts.`id`,
    contacts.`datetime`,
    contacts.`form`,
    contacts.`from`,
    contacts.`to`,
    contacts.`message`,
    contacts.`status`,
    accounts.`id` AS `from_id`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`,
    Case accounts.`name`
        When contacts.`to` = accounts.`id`
        Then (SELECT accounts.`name` FROM `accounts` WHERE accounts.`id`= contacts.`to`)
    END
    AS `to_name`
    FROM `ecommerce_messages` contacts
        LEFT JOIN `accounts`
            ON contacts.`from` = accounts.`id`
            OR contacts.`to` = accounts.`id`
        LEFT JOIN `accounts_sn`
            ON contacts.`from` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
    WHERE (contacts.`status`='1' || contacts.`status`='2' || contacts.`status`='3')
    AND contacts.`url` = '".$url."'
    GROUP BY contacts.`id`
    ORDER BY contacts.`id` DESC"
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
function LIcontacts($messages)
{
    $contacts_list='';
    $contacts = array();
    foreach($messages as $key => $item)
    {
        if($item['from_id']!=$_SESSION['logged']['id']){
            $contacts[$item['from']]['id']= $item['from_id'];
            $contacts[$item['from']]['name']= $item['from_name'];
            $contacts[$item['from']]['pic']= $item['from_pic'];
            $contacts[$item['from']]['messages'][$key] = $item;
        }else{
            $contacts[$item['to']]['messages'][$key] = $item;
        }
    }

    foreach ($contacts as $user => $data) 
    {
 
         
        $contacts_list.='
            <li class="list-group-item';
            if($_GET['replymessage']==$user || 
               $_SESSION['feedback']['messagereply']==$user)
            {
                $contacts_list.=' active';
            }
            $contacts_list.='" id="message_'.$user.'">
            <div class="media">
                <div class="media-left">
                    <img class="media-object profile-pic" alt="'.$data['name'].'" src="'.$data['pic'].'">
                </div>
                <div class="media-body">
                    <span class="media-heading">
                    <b>'.$data['name'].'</b> 
                    </span>';
                    $contacts_list.='<ul class="list-group">';
                   // $contacts_list.='<p>';
                    $contacts_list.=LImessages(array_reverse($data['messages']));
                // foreach ( array_reverse($data['messages']) as $column => $message) 
                // {
                //     $date=Interval($message['datetime']);
                //     if($user!=$message['from']){
                //         $contacts_list.= '<small class="pull-left">Hace '.$date[0].' '.$date[1].'</small><span class="pull-right">'.$message['message'].'</span><br>';
                //     }else{
                //         $contacts_list.= '<small class="pull-right">Hace '.$date[0].' '.$date[1].'</small>'.$message['message'].'<br>';
                //     }
                // }
                $contacts_list.='</ul>';
                 //       $contacts_list.='</p>';
                //         $contacts_list.='<p><small>';
                           
                //                 $contacts_list.='<a ';
                //                 if((isset($_GET['replymessage']) && $_GET['replymessage']==$user) ||
                //                     (isset($_SESSION['feedback']['messagereply']) && $_SESSION['feedback']['messagereply']==$user))
                //                 {
                //                     $contacts_list.='data-toggle="collapse" href="#replymessage_'.$user.'" aria-expanded="true" aria-controls="replymessage_'.$user.'" ';
                //                 }
                //                 else
                //                 {
                //                     $contacts_list.='href="?replymessage='.$user.'#message_'.$user.'"';
                //                 }
                //                 $contacts_list.=' rel="nofollow" >Responder</a>';
                // $contacts_list.='</small></p>';
                $form=array(
                        'id'    =>'form_reply-'.$user,
                        'type'  =>'ecommerce',
                        'action'=>'?replymessage='.$user.'#message_'.$user.'"',
                        'callback'=>'#message_'.$user,
                        'to'       => $data['id'],
                        'toname' => $data['name']
                                );
                    include 'form_reply.php';
                    $contacts_list.=$FormReply;
                // if((isset($_GET['replymessage']) && $_GET['replymessage']==$user) ||
                //     (isset($_SESSION['feedback']['messagereply']) && $_SESSION['feedback']['messagereply']==$user))
                // {
                //     $contacts_list.='
                //         <div class="collapse in container-fluid" id="replymessage_'.$user.'" aria-expanded="true">
                //             <a data-toggle="collapse" href="#replymessage_'.$user.'" aria-expanded="true" aria-controls="replymessage_'.$user.'" class="pull-right"><i class="fa fa-times"></i></a>';
                //     $form=array(
                //         'id'    =>'form_reply-'.$user,
                //         'type'  =>'ecommerce',
                //         'action'=>'?replymessage='.$user.'#message_'.$user.'"',
                //         'callback'=>'#message_'.$user,
                //         'toname' => $data['name']
                //                 );
                //     include 'form_reply.php';
                //     $contacts_list.=$FormReply;
                //     $contacts_list.='
                //         </div>';
                // }
                
                $contacts_list.='
                    </div>
                </div>
            </li>
            ';
        
        
    }

    $_SESSION['feedback']['messagereply']=0;
    $return['contacts_list']=$contacts_list;
    $return['count']=count($contacts);
    return $return;
}

function LImessages($messages)
{
    $count=0;
    $user=0;
    $admin=0;
    foreach ($messages as $column => $data) 
    {
        if($data['from']!=$_SESSION['logged']['id'])
        {
            if($user==0 and $admin!=0)
            {
                $li=1;
            }
            $count++;
            $user++;
            $admin=0;
        }
        else
        {
            if($admin==0 and $user!=0)
            {
                $li=1;
            }
            $count++;
            $user=0;
            $admin++;
        }

         if((count($messages)==($count-1))or($li==1))
        {
           $message_list.='</li>';
           
        }
   
        if(($count==1)or($li==1))
        {
            $message_list.='<li class="list-group-item container-fluid" id="message_'.$data['id'].'">';
            $li=0;
        }
        
        $date=Interval($data['datetime']);    
        
        if($data['from']!=$_SESSION['logged']['id'])
        {  
           if($user<=1)
            {
            // $message_list.= '<p class="list-group-item-heading"><strong><i class="fa fa-user"></i> Tú</strong> </p>';    
            }
            $message_list.= '<p class="list-group-item-text"><small class="pull-right">Hace '.$date[0].' '.$date[1].'</small> '.$data['message'].'</p>';
        }
        else
        {   
            if($admin<=1)
            {
            $message_list.= '<p class="list-group-item-heading text-right"><strong>Tú <i class="fa fa-user"></i></strong></p>';
            }
            $message_list.= '<p class="list-group-item-text text-right"><small class="pull-left">Hace '.$date[0].' '.$date[1].'</small> '.$data['message'].'</p>';   
       }
    }

    return $message_list;
}
