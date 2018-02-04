<?php
//ListMessages

$listECmessages=ListECmessages($_SESSION['logged']['id']);

echo '<ul class="list-group" id="'.$form['id'].'"">';

if($listECmessages)
{
	echo '<li class="list-group-item">
			<i class="fa fa-envelope"></i> '.count($listECmessages).' Mensaje';
		if(count($listECmessages)!=1)
		{
			echo 's';
		}
	echo '</li>';

	echo LIECmessages($listECmessages);
}
else
{
	echo '<li class="list-group-item">
			<i class="fa fa-envelope"></i> Ningun mensaje
		</li>';
}
$form=array(
      'id'    =>'tab_ecommerce-contact',
      'type'  =>'ecommerce',
      'action'=>'?tab=tab_ecommerce-contact',
      'callback'=>'/ums/tab/tab_ecommerce-contact'
        );
echo '
		<li class="list-group-item container-fluid" id="'.$form['id'].'">';

include 'form_contact.php';
echo '
		</li>
	</ul>';


function ListECmessages($account)
{
    $resultado=SQLselect(
            array(
                'table'=>'ecommerce_messages',
                'query'=>"
                SELECT 
                messages.`id`,
                messages.`datetime`,
                messages.`from`,
                messages.`to`,
                messages.`message`,
                messages.`status`,
                accounts.`id` AS `from_id`,
                accounts.`name` AS `from_name`,
                accounts_sn.`pic` AS `from_pic`,
                Case accounts.`name`
                    When messages.`to` = accounts.`id`
                    Then (SELECT accounts.`name` FROM `accounts` WHERE accounts.`id`= messages.`to`)
                END
                AS `to_name`  
                FROM `ecommerce_messages` messages
                    LEFT JOIN `accounts`
                        ON messages.`from` = accounts.`id`
                        OR messages.`to` = accounts.`id`
                    LEFT JOIN `accounts_sn`
                        ON messages.`from` = accounts_sn.`account` 
                        AND accounts.`pic` = accounts_sn.`network`
                WHERE messages.`url` = 'http://".$_SERVER['HTTP_HOST'].strtok($_SERVER["REQUEST_URI"],'?')."' 
                AND (messages.`from` = '".$account."' OR messages.`to` = '".$account."') 
                AND messages.`status` = '1'
                GROUP BY messages.`id`
                ORDER BY messages.`id` ASC"
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
function LIECmessages($messages)
{
	$count=0;
    $user=0;
    $admin=0;
    foreach ($messages as $column => $data) 
    {
        if($data['from']==$_SESSION['logged']['id'])
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
            $message_list.='<li class="list-group-item container-fluid">';
            $li=0;
        }
        
        $date=Interval($data['datetime']);    
        
        if($data['from']==$_SESSION['logged']['id'])
        {  
           if($user<=1)
            {
            $message_list.= '<p class="list-group-item-heading"><strong><i class="fa fa-user"></i> Tú</strong> </p>';    
            }
            $message_list.= '<p class="list-group-item-text"><small class="pull-right">Hace '.$date[0].' '.$date[1].'</small> '.$data['message'].'</p>';
        }
        else
        {   
            if($admin<=1)
            {
            $message_list.= '<p class="list-group-item-heading text-right"><strong>'.$data['from_name'].' <i class="fa fa-envelope"></i></strong></p>';
            }
            $message_list.= '<p class="list-group-item-text text-right" id="message_'.$data['id'].'"><small class="pull-left">Hace '.$date[0].' '.$date[1].'</small> '.$data['message'].'</p>';   
       }
    }

    return $message_list;
}


