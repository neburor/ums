<?php
//Functions Logged
function ShowName()
{
	$name = explode(' ',trim($_SESSION['logged']['name']));

	return $name[0];
}
function ShowPic()
{
	if($_SESSION['logged']['pic']=='facebook' || $_SESSION['logged']['pic']=='twitter')
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