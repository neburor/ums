<?php

if(isset($_SESSION['logged']))
{
	        echo '<div ums class="btn-group ums profile button">
        <a href="#" class="btn btn-default hidden-xs" data-ums="app.open.wrapper" data-show="app.content.notifications"><img src="'.ShowPic().'" class="profile-pic-small"> <span class="hidden-xs">'.ShowName().'</span></a>
         <a href="#" class="btn btn-default visible-xs" data-ums="app.open.offcanvas" data-show="app.content.notifications"><img src="'.ShowPic().'" class="profile-pic-small"> <span class="hidden-xs">'.ShowName().'</span></a>
         <a href="?logout" class="btn btn-default"><i class="fa fa-power-off"></i></a>
      </div>';

}
else
     {
          echo '<div ums class="btn-group ums profile button">
        <a href="#" class="btn btn-default hidden-xs" data-ums="app.open.wrapper"><i class="fa fa-user"></i> <span class="hidden-xs">Mi perfil</span></a>
         <a href="perfil.html" class="btn btn-default visible-xs" data-ums="app.open.offcanvas"><i class="fa fa-user"></i> <span class="hidden-xs">Mi perfil</span></a>
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
          <ul class="dropdown-menu dropdown-menu-right">
            <li class="hidden-xs"><a href="#" class="" data-ums="app.open.wrapper" data-show="app.settings.login" data-toggle="show"><i class="fa fa-sign-in"></i> Iniciar sesión</a></li>
            <li class="visible-xs"><a href="#" class="" data-ums="app.open.offcanvas" data-show="app.settings.login" data-toggle="show"><i class="fa fa-sign-in"></i> Iniciar sesión</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header"><i class="fa fa-unlock-alt"></i> Conectarse</li>
            <li><a href="?login=facebook" class=""><i class="fa fa-facebook"></i> Facebook</a></li>
            <li><a href="?login=twitter" class=""><i class="fa fa-twitter"></i> Twitter</a></li>
            <li role="separator" class="divider"></li>
            <li class="hidden-xs"><a href="#" data-ums="app.open.wrapper" data-show="app.settings.signup" data-toggle="show"><i class="fa fa-user-plus"></i> Registrarse</a></li>
            <li class="visible-xs"><a href="#" data-ums="app.open.offcanvas" data-show="app.settings.signup" data-toggle="show"><i class="fa fa-user-plus"></i> Registrarse</a></li>
          </ul>
      </div>';
        }