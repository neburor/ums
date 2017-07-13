<?php
#FUNCTIONS
function ShowName()
{
    $name = explode(' ',trim($_SESSION['logged']['name']));

    return $name[0];
}
function ShowPic()
{
    if($_SESSION['logged']['pic']=='facebook' || $_SESSION['logged']['pic']=='twitter' || $_SESSION['logged']['pic']=='avatar')
    {
        if($_SESSION['logged']['pic']=='twitter')
        {
            $_SESSION['logged']['networks'][$_SESSION['logged']['pic']]['pic']=str_replace('_normal', '_bigger', $_SESSION['logged']['networks'][$_SESSION['logged']['pic']]['pic']);
        }
        return $_SESSION['logged']['networks'][$_SESSION['logged']['pic']]['pic'];
    }
    elseif($_SESSION['logged']['pic']=='local')
    {
        return 'images/pics/pic_'.$_SESSION['logged']['user_hash'].'.jpg';
    }
    else
    {
        return $_SESSION['logged']['networks'][$_SESSION['logged']['pic']]['pic'];
    }

   
}
function ShowCover ()
{
    if($_SESSION['logged']['cover']=='facebook' || $_SESSION['logged']['cover']=='twitter')
    {
        $cover = '<img src="'.$_SESSION['logged']['networks'][$_SESSION['logged']['cover']]['cover'].'"';
    }
    elseif($_SESSION['logged']['cover']=='local')
    {
        $cover = '<img src="images/cover/cover_'.$_SESSION['logged']['user_hash'].'.jpg"';
    }
    
    if(isset($_SESSION['logged']['networks'][$_SESSION['logged']['cover']]['cover_x']) || isset($_SESSION['logged']['networks'][$_SESSION['logged']['cover']]['cover_y']))
    {
        $cover.= ' style="';
        if(isset($_SESSION['logged']['networks'][$_SESSION['logged']['cover']]['cover_y']))
        {
            $cover.= 'margin-top: -'.$_SESSION['logged']['networks'][$_SESSION['logged']['cover']]['cover_y'].'px;';
        }
        if(isset($_SESSION['logged']['cover']['networks'][$_SESSION['logged']]['cover_x']))
        {
            $cover.= 'margin-left: -'.$_SESSION['logged']['networks'][$_SESSION['logged']['cover']]['cover_x'].'px;';
        }
        $cover.= '"';
    }
    $cover.= '>';

    return $cover;
}
function interval ($creation_date)
{
	$time_message=new DateTime($creation_date);
    $time=new DateTime(date("Y-m-d H:i:s"));
    $interval = $time_message->diff($time);

    if($interval->y>=1)
    {
    	$time_interval[0]=$interval->format('%y');
    	if($interval->y>=2)
    	{
    		$time_interval[1]='años';
    	}
    	else
    	{
    		$time_interval[1]='año';
    	}
        $time_interval[2]='a';
    }
    elseif($interval->m>=1)
    {
    	$time_interval[0]=$interval->format('%m');
    	if($interval->m>=2)
    	{
    		$time_interval[1]='meses';
    	}
    	else 
    	{
    		$time_interval[1]='mes';
    	}
        $time_interval[2]='m';
    }
    elseif($interval->d>=1)
    {
    	$time_interval[0]=$interval->format('%d');
    	if ($interval->d>=2) 
    	{
    		$time_interval[1]='dias';
    	}
    	else
    	{
    		$time_interval[1]='dia';
    	}
        $time_interval[2]='d';
    }
    elseif($interval->h>=1)
    {
    	$time_interval[0]=$interval->format('%h');
    	if ($interval->h>=2) 
    	{
    		$time_interval[1]='horas';
    	}
    	else
    	{
    		$time_interval[1]='hora';
    	}
        $time_interval[2]='h';
    }
    else
    {
    	$time_interval[0]=$interval->format('%i');
    	if ($interval->i>=2 || $interval->i==0) 
    	{
    		$time_interval[1]='minutos';
    	}
    	else
    	{
    		$time_interval[1]='minuto';
    	}
        $time_interval[2]='min';
    }

    return $time_interval;
}