<?php
#MESSAGES
function MessagesJSON($url)
{
    $sql=mysql_query("
        SELECT * FROM `chat` 
        WHERE `from` = '".$profile_id."'
        OR `to` = '".$profile_id."'
        ORDER BY `id` ASC");
     $rows = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $rows[] = $i;
    }

    return json_encode($rows);
}
function MESSAGES($profile_id)
{
	$sql=mysql_query("
        SELECT * FROM `chat` 
        WHERE `from` = '".$profile_id."'
        OR `to` = '".$profile_id."'
        ORDER BY `id` ASC");
	 $row = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $row[] = $i;
    }

    $message_count='<li class="list-group-item"><i class="fa fa-envelope"></i> '.count($row);
    if(count($row) == 1 )
    {
        $message_count.=' Mensaje</li>';
    }
    else
    {
        $message_count.=' Mensajes</li>';
    }

    $count=0;
    $user=0;
    $admin=0;
    foreach ($row as $column => $data) 
    {
        if($data['to']!=$profile_id)
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

         if((count($row)==($count-1))or($li==1))
        {
           $message_list.='</li>';
           
        }
   
        if(($count==1)or($li==1))
        {
            $message_list.='<li class="list-group-item container-fluid">';
            $li=0;
        }
        
        $date=Interval($data['date']);    
        
        if($data['to']!=$profile_id)
        {  
           if($user<=1)
            {
            $message_list.= '<p class="list-group-item-heading"><strong><i class="fa fa-user"></i> Tú</strong> </p>';    
            }
            $message_list.= '<p class="list-group-item-text"><span class="label label-default pull-right"><span class="hidden-xxs">Hace </span>'.$date[0].' <span class="hidden-xxs">'.$date[1].'</span><span class="visible-xxs">'.$date[2].'</span></span> '.$data['message'].'</p>';
        }
    	else
        {   
            if($admin<=1)
            {
            $message_list.= '<p class="list-group-item-heading text-right"><strong>Administración <i class="fa fa-users"></i></strong></p>';
            }
            $message_list.= '<p class="list-group-item-text text-right"><span class="label label-default pull-left"><span class="hidden-xxs">Hace </span>'.$date[0].' <span class="hidden-xxs">'.$date[1].'</span><span class="visible-xxs">'.$date[2].'</span></span> '.$data['message'].'</p>';   
       }


      
    }

    $message_form='<li class="list-group-item container-fluid">'.HTML('form_user_message').'</li>';
	
	$messages ='<ul class="list-group">'.$message_count.$message_list.$message_form.'</ul>';

    if(count($row)>0)
    {
        return $messages;    
    }
    else
    {
        return false;
    }	
}
