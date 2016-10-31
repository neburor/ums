<?php
//ListMessages

$listMessages=ListMessages($_SESSION['logged']['id']);

echo '<ul class="list-group" id="'.$form['id'].'"">';

if($listMessages)
{
	echo '<li class="list-group-item">
			<i class="fa fa-envelope"></i> '.count($listMessages).' Mensaje';
		if(count($listMessages)!=1)
		{
			echo 's';
		}
	echo '</li>';

	echo LImessages($listMessages,$_SESSION['logged']['id']);
}
else
{
	echo '<li class="list-group-item">
			<i class="fa fa-envelope"></i> Ningun mensaje
		</li>';
}
$form=array(
      'id'    =>'form_contact_li',
      'type'  =>'contact'
        );
echo '
		<li class="list-group-item container-fluid" id="'.$form['id'].'">';

include 'form_contact_li.php';
echo '
		</li>
	</ul>';


function LImessages($messages,$account)
{
	$count=0;
    $user=0;
    $admin=0;
    foreach ($messages as $column => $data) 
    {
        if($data['to']!=$account)
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
        
        if($data['to']!=$account)
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
            $message_list.= '<p class="list-group-item-heading text-right"><strong>Administración <i class="fa fa-users"></i></strong></p>';
            }
            $message_list.= '<p class="list-group-item-text text-right"><small class="pull-left">Hace '.$date[0].' '.$date[1].'</small> '.$data['message'].'</p>';   
       }
    }

    return $message_list;
}


