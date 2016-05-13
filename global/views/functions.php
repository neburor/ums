<?php
#Functions
function HTMLnavprofile ()
{
	if($_SESSION['profile'])
{
  $name=explode(' ',trim($_SESSION['profile']['name']));

  $htmlnavprofile = '<div class="btn-group navbar-btn pull-right">';
  $htmlnavprofile.= '<a href="'.URLSYSTEM.'" class="btn btn-default profile">';
  if($_SESSION['profile']['facebook_id']!='')
  {
    $htmlnavprofile.= '<img src="//graph.facebook.com/'.$_SESSION['profile']['facebook_id'].'/picture" style="height:18px; width:auto;">';
  }elseif($_SESSION['profile']['twitter_id']!='')
  {
    $htmlnavprofile.= '<img src="https://twitter.com/'.$_SESSION['profile']['name'].'/profile_image?size=mini" style="height:18px; width:auto;">';
  }
  else
  {
    $htmlnavprofile.= '<i class="fa fa-user"></i>';
  }
  
  $htmlnavprofile.= ' <b>'.$name[0].'</b></a>';

  $htmlnavprofile.= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button><ul class="dropdown-menu">';
  $htmlnavprofile.= '<li><a href="http://ums.hostingmex.com.mx/ums/" class="btn-profile"><i class="fa fa-cog"></i> Configuración</a></li>';
  $htmlnavprofile.= '<li class="divider"></li>';
  $htmlnavprofile.= '<li><a href="http://ums.hostingmex.com.mx/ums/" class="btn-profile"><i class="fa fa-comments"></i> Mensajes</a></li>';
  $htmlnavprofile.= '<li><a href="http://ums.hostingmex.com.mx/ums/?logout" class="btn-profile"><i class="fa fa-commenting"></i> Comentarios</a></li>';
  $htmlnavprofile.= '<li class="divider"></li>';
  $htmlnavprofile.= '<li><a href="http://ums.hostingmex.com.mx/ums/?logout" class="btn-profile"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>';
  $htmlnavprofile.= '</ul></div>';
}
else
{
  $htmlnavprofile.= '<div class="btn-group navbar-btn pull-right">
              <a href="http://ums.hostingmex.com.mx/ums/" class="btn btn-default open profile"><i class="fa fa-user"></i> Mi perfil</a>
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="http://ums.hostingmex.com.mx/ums/" class="btn-profile"><i class="fa fa-sign-in"></i> Iniciar sesión</a></li>
                <li><a href="http://ums.hostingmex.com.mx/ums/?signup" class="btn-profile"><i class="fa fa-user-plus"></i> Registrarse</a></li>
              </ul>
            </div>';
}
	return $htmlnavprofile;
}