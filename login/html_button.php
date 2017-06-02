<?php

if(isset($_SESSION['logged']))
{
	        echo '<div ums class="btn-group ums profile button">
        <a href="#" class="btn btn-default" data-hash="/app/content/notifications">';
        if($_SESSION['logged']['notifs_app'] && $_SESSION['logged']['notifs_app']!='0')
        {
          echo '<img src="'.ShowPic().'" class="hidden-xs profile-pic-small"> 
                <span class="hidden-xs">'.ShowName().'</span>
                <i class="fa fa-bell"></i><small class="badge">'.$_SESSION['logged']['notifs_app'].'</small>';
        }
        else
        {
          echo '<img src="'.ShowPic().'" class="profile-pic-small"> 
          <span class="hidden-xs">'.ShowName().'</span>';
        }

       
       echo ' </a>
         <a href="?logout" class="btn btn-default"><i class="fa fa-power-off"></i></a>
      </div>';

}
else
     {
          echo '<div ums class="btn-group ums profile button">
          <a href="#" class="btn btn-default" data-hash="/app/settings/login/open"><i class="fa fa-user"></i> <span class="hidden-xs">Mi perfil</span></a>
          <button type="button" class="btn btn-default dropdown-toggle hidden-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="#" class="" data-hash="/app/settings/login/open" data-toggle="show"><i class="fa fa-sign-in"></i> Iniciar sesión</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header"><i class="fa fa-unlock-alt"></i> Conectarse</li>
            <li><a href="?login=facebook" class=""><i class="fa fa-facebook"></i> Facebook</a></li>
            <li><a href="?login=twitter" class=""><i class="fa fa-twitter"></i> Twitter</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#" data-hash="/app/settings/signup/open" data-toggle="show"><i class="fa fa-user-plus"></i> Registrarse</a></li>
          </ul>
      </div>';
        }