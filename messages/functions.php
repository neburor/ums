<?php
#MESSAGES
function MESSAGES($profile_id)
{
	$sql=mysql_query("
        SELECT * FROM `messages` 
        WHERE `profile_id` = '".$profile_id."'
        ORDER BY `id` ASC");
	 $row = array();
        
    while($i = mysql_fetch_assoc($sql)) 
    {
        $row[] = $i;
    }

    $message_count='<li class="list-group-item"><i class="fa fa-envelope"></i> '.count($row).'</li>';

    foreach ($row as $column => $data) {

    	$message_list.= '<li class="list-group-item container-fluid"> 
    	<p class="list-group-item-heading"><strong><i class="fa fa-user"></i> Tú</strong> <span class="label label-default pull-right">Hace '.Interval($data['creation_date']).'</span></p>
    	<p class="list-group-item-text">'.$data['message'].'</p>
    	</li>';
    }
	
	$messages ='<ul class="list-group">'.$message_count.$message_list.'</ul>';

	return $messages;
}
function interval ($creation_date)
{
	$time_message=new DateTime($creation_date);
    $time=new DateTime(date("Y-m-d H:i:s"));
    $interval = $time_message->diff($time);

    if($interval->y>=1)
    {
    	$time_interval=$interval->format('%y');
    	if($interval->y>=2)
    	{
    		$time_interval.=' años';
    	}
    	else
    	{
    		$time_interval.=' año';
    	}
    }
    elseif($interval->m>=1)
    {
    	$time_interval=$interval->format('%m');
    	if($interval->m>=2)
    	{
    		$time_interval.=' meses';
    	}
    	else 
    	{
    		$time_interval.=' mes';
    	}
    }
    elseif($interval->d>=1)
    {
    	$time_interval=$interval->format('%d');
    	if ($interval->d>=2) 
    	{
    		$time_interval.=' dias';
    	}
    	else
    	{
    		$time_interval.=' dia';
    	}
    }
    elseif($interval->h>=1)
    {
    	$time_interval=$interval->format('%h');
    	if ($interval->h>=2) 
    	{
    		$time_interval.=' horas';
    	}
    	else
    	{
    		$time_interval.=' hora';
    	}
    }
    else
    {
    	$time_interval=$interval->format('%i');
    	if ($interval->i>=2 || $interval->i==0) 
    	{
    		$time_interval.=' minutos';
    	}
    	else
    	{
    		$time_interval.=' minuto';
    	}
    }

    return $time_interval;
}