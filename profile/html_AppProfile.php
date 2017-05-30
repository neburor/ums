<?php
#APPprofile
if(isset($_SESSION['logged']))
{
  if($_SESSION['logged']['notifs'])
  {
    echo '<div id="btn-profile"><a href="#" class="btn btn-default" data-hash="/app/content/notifications" id="cta_btn"><i class="fa fa-bell fa-2x"></i><small class="badge">'.$_SESSION['logged']['notifs'].'</small></a></div>';  
  }
  
  	echo '<div ums class="ums profile wrapper">
      <div class="profile sidebar col-md-4 col-sm-6 col-xs-12 nopadding pull-right">
        <div class="profile app sidebar-content col-xs-12 nopadding">
          <div class="media apptop">
            <div class="media-left">
              <button class="btn btn-link" data-hash="/app/close"><i class="fa fa-times fa-2x"></i></button>
            </div>
            <div class="media-body">
              <div class="media-heading text-center"><img src="'.ShowPic().'" class="profile-pic"> '.ShowName().'</div>
            </div>
            <div class="media-right">
              <button class="btn btn-link" type="button" data-hash="/app/settings/config" data-toggle="toggle" aria-controls="appconfig"><i class="fa fa-cog fa-2x"></i></button>
            </div>
            <div class="media-right">
              <a href="?logout" class="btn btn-link"><i class="fa fa-power-off fa-2x"></i></a>
            </div>
          </div>
          <div class="tab-content appcontent container-fluid">
            <div role="tabpanel" class="tab-pane" id="appconfig">
              Configuracion
            </div>
          </div>';
if($_SESSION['logged']['alert'])
{
  echo '<div class="tab-content appcontent"><div class="alert alert-'.key($_SESSION['logged']['alert']).' alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> '.$_SESSION['logged']['alert'][key($_SESSION['logged']['alert'])].'</div></div>';
}
      echo'<ul class="nav nav-tabs nav-justified nav-mobile appnav">
            <li role="presentation" class="active"><a href="#" data-target="#appnewsfeed" data-hash="/app/content/newsfeed" role="tab" data-toggle="tab" aria-controls="appnewsfeed" aria-expanded="true"><i class="fa fa-globe"></i> Noticias</a></li>
            <li role="presentation"><a href="#" data-target="#appnotifications" data-hash="/app/content/notifications" role="tab" data-toggle="tab" aria-controls="appnotifications" aria-expanded="false"><i class="fa fa-bell"></i> Notificaciones</a></li>
          </ul>
          <div class="tab-content appcontent">
            <div role="tabpanel" class="tab-pane active" id="appnewsfeed">
              <ul class="list-group appstream">
                <li class="list-group-item">
                  <div class="media comment">
                    <div class="media-left"><img class="img-circle profile-pic" src="https://scontent-mia1-1.xx.fbcdn.net/v/t1.0-1/p40x40/13872767_10154306295915775_1841733233213666303_n.jpg?oh=2740478a54b915570cb74b16689a7db7&oe=587EDA67"></div>
                    <div class="media-body"><span class="media-heading"><b>Dario</b> comento en <a href="">No somos los primeros</a> <small><span class="hidden-xs">hace </span>5 h<span class="hidden-xs">oras</span></small></span></div>
                    <div class="media-right"><a href="#"><img class="thumbnail-pic" src="imagenes/no-somos-los-primeros_pdf.jpg"></a></div>
                  </div>
                  <p>excelente libro, con bastante ejemplos de los misterios y dudas de las civilizaciones antiguas,
                  </p> 
                  <small>15 Me gusta 5 respuestas</small>
                  <ul class="nav nav-pills nav-justified nav-mobile">
                    <li><a href="#"><i class="fa fa-thumbs-up"></i></a></li>
                    <li><a href="#">Responder</a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  </ul>
                </li>
                <li class="list-group-item">
                  <div class="media comment">
                    <div class="media-left"><img class="img-circle profile-pic" src="https://scontent-mia1-1.xx.fbcdn.net/v/t1.0-1/p40x40/13872767_10154306295915775_1841733233213666303_n.jpg?oh=2740478a54b915570cb74b16689a7db7&oe=587EDA67"></div>
                    <div class="media-body"><span class="media-heading"><b>Dario</b> respondio a <small>Jorge</small> en <a href="">El retorno de los brujos</a> <small><span class="hidden-xs">hace </span>6 h<span class="hidden-xs">oras</span></small></span></div>
                    <div class="media-right"><a href="#"><img class="thumbnail-pic" src="imagenes/el-retorno-de-los-brujos_pdf.jpg"></a></div>
                  </div>
                  <p>La visión del futuro se hace más llevadera conociendo el mundo antiguos y sus ikmplicaciones con el mundo moderno
                  </p>
                  <ul class="nav nav-pills nav-justified nav-mobile">
                    <li><a href="#"><i class="fa fa-thumbs-up"></i></a></li>
                    <li><a href="#">Responder</a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <div role="tabpanel" class="tab-pane" id="appnotifications">
';
include 'notifications.php';
echo '      </div>
          </div>
        </div>
      </div> 
    </div>';
}
else
{
  echo '<div id="btn-profile"><a href="#" class="btn btn-default" data-hash="/app/settings/signup/open" id="cta_btn"><i class="fa fa-user-plus fa-2x"></i></a></div>';

	echo '<div ums class="ums profile wrapper">
      <div class="profile sidebar col-md-4 col-sm-6 col-xs-12 nopadding pull-right">
        <div class="profile app sidebar-content col-xs-12 nopadding">
          <div class="media apptop">
            <div class="media-left">
              <button class="btn btn-link" data-hash="/app/close"><i class="fa fa-times fa-2x"></i></button>
            </div>
            <div class="media-body">
            </div>
            <div class="media-right">
              <button class="btn btn-link" type="button" data-hash="/app/settings/login" data-toggle="show" aria-expanded="false" aria-controls="appsettings"><i class="fa fa-sign-in fa-2x"></i></button>
              </div>
            <div class="media-right">
              <button class="btn btn-link" type="button" data-hash="/app/settings/signup" data-toggle="show" aria-expanded="false" aria-controls="appsettings"><i class="fa fa-user-plus fa-2x"></i></button>
            </div>
          </div>
          
           <div class="tab-content appcontent container-fluid">
              <div role="tabpanel" class="tab-pane" id="applogin">
              ';
            $div=array('intro'=>'col-xs-12','form'=>'col-xs-12');
            $form=array(
                'id'    =>'app_settings-login',
                'type'  =>'login',
                'callback'=> array(
                            'success'=>'/app/content/newsfeed',
                            'error'=>'/app/settings/login'),
                'recovery'=>'<a href="#" data-hash="/app/settings/recovery" data-toggle="show" aria-expanded="false" aria-controls="appsettings">Recuperar <i class="fa fa-lock"></i></a>'
                  );
            include 'ums/login/html_login-tab.php';
            echo '
              </div>
              <div role="tabpanel" class="tab-pane" id="appsignup">
              ';
            $div=array('intro'=>'col-xs-12','form'=>'col-xs-12');
            $form=array(
                'id'    =>'app_settings-signup',
                'type'  =>'signup',
                'callback'=>array(
                            'success'=>'/app/content/newsfeed',
                            'error'=>'/app/settings/signup')
                  );
            include 'ums/login/html_signup-tab.php';
            echo '
              </div>
            <div role="tabpanel" class="tab-pane" id="apprecovery">
              ';
            $div=array('intro'=>'col-xs-12','form'=>'col-xs-12');
            $form=array(
                'id'    =>'app_settings-recovery',
                'type'  =>'recovery',
                'callback'=>array(
                            'success'=>'/app/settings/recovery',
                            'error'=>'/app/settings/recovery')
                  );
            include 'ums/login/html_recovery-tab.php';
            echo '
              </div>        
          </div>
        </div>
      </div> 
    </div>';
}
