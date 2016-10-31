<?php
#APPprofile
if(isset($_SESSION['logged']))
{
	echo '<div ums class="ums profile wrapper">
      <div class="profile sidebar col-md-4 col-sm-6 col-xs-12 nopadding pull-right">
        <div class="profile app sidebar-content col-xs-12 nopadding">
          <div class="media apptop">
            <div class="media-left">
              <button class="btn btn-link hidden-xs" data-ums="app.close.wrapper"><i class="fa fa-times fa-2x"></i></button>
              <button class="btn btn-link visible-xs" data-ums="app.close.offcanvas"><i class="fa fa-times fa-2x"></i></button>
            </div>
            <div class="media-body">
              <div class="media-heading text-center"><img src="'.ShowPic().'" class="profile-pic"> '.ShowName().'</div>
            </div>
            <div class="media-right">
              <button class="btn btn-link" type="button" data-show="app.settings.config" data-toggle="toggle" aria-controls="appconfig"><i class="fa fa-cog fa-2x"></i></button>
            </div>
          </div>
          <div class="tab-content appcontent container-fluid">
            <div role="tabpanel" class="tab-pane" id="appconfig">
              Configuracion
            </div>
          </div>
          <ul class="nav nav-tabs nav-justified nav-mobile appnav">
            <li role="presentation" class="active"><a href="#" data-target="#appnewsfeed" data-show="app.content.newsfeed" role="tab" data-toggle="tab" aria-controls="appnewsfeed" aria-expanded="true"><i class="fa fa-globe"></i> Noticias</a></li>
            <li role="presentation"><a href="#" data-target="#appnotifications" data-show="app.content.notifications" role="tab" data-toggle="tab" aria-controls="appnotifications" aria-expanded="false"><i class="fa fa-bell"></i> Notificaciones <span class="badge">4</span></a></li>
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
              <div class="media">
                <div class="media-body text-center">
                  <i class="fa fa-bell fa-4x"></i>
                  <b class="media-heading">NINGUNA ALERTA</b>
                  <p>Participa en nuestra comunidad !</p>
                </div> 
              </div>
              <hr>
              <ul class="list-group appstream">
                <li class="list-group-item">
                  <a href class="media message">
                    <div class="media-left"><img class="img-circle profile-pic" src="https://scontent-mia1-1.xx.fbcdn.net/v/t1.0-1/p40x40/13872767_10154306295915775_1841733233213666303_n.jpg?oh=2740478a54b915570cb74b16689a7db7&oe=587EDA67"></div>
                    <div class="media-body"><span class="media-heading"><b>Dario</b> <small class="pull-right"><span class="hidden-xs">hace </span>1 D<span class="hidden-xs">ia</span></small></span>
                    <p><small><i class="fa fa-inbox"></i> Cambio libro de el retorno de los brujos</small></p>
                    <p>Te interesa cambiaro por el de no somos los primeros?</p>
                    </div>
                    <div class="media-right"><i class="fa fa-chevron-right"></i></div>
                  </a>
                </li>
                <li class="list-group-item">
                  <a href class="media message">
                    <div class="media-left"><img class="img-circle profile-pic" src="img/O_M.png"></div>
                    <div class="media-body"><span class="media-heading"><b>Administracion</b> <small class="pull-right"><span class="hidden-xs">hace </span>6 D<span class="hidden-xs">ias</span></small></span>
                    <p><small><i class="fa fa-envelope"></i> Contacto</small></p>
                    <p>Hola, para poder descargar algun capitulo es necesario seguir el procedimiento.</p>
                    </div>
                    <div class="media-right"><i class="fa fa-chevron-right"></i></div>
                  </a>
                </li>
                <li class="list-group-item">
                  <a href class="media message">
                    <div class="media-left"><img class="img-circle profile-pic" src="imagenes/pic2.jpg"></div>
                    <div class="media-body"><span class="media-heading"><b>Monzerrat</b> <small class="pull-right"><span class="hidden-xs">hace </span>1 D<span class="hidden-xs">ia</span></small></span>
                    <p><small><i class="fa fa-commenting"></i> No somos los primeros</small></p>
                    <p>Excelenta aportacion</p>
                    </div>
                    <div class="media-right"><i class="fa fa-chevron-right"></i></div>
                  </a>
                </li>
                <li class="list-group-item">
                  <a href class="media message">
                    <div class="media-left"><img class="img-circle profile-pic" src="imagenes/pic.jpg"></div>
                    <div class="media-body"><span class="media-heading"><b>Ruben</b> <small class="pull-right"><span class="hidden-xs">hace </span>1 D<span class="hidden-xs">ia</span></small></span>
                    <p><small><i class="fa fa-thumbs-up"></i> Nosomos los primeros</small></p>
                    <p>Le gusta tu comentario</p>
                    </div>
                    <div class="media-right"><i class="fa fa-chevron-right"></i></div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div> 
    </div>';
}
else
{
	echo '<div ums class="ums profile wrapper">
      <div class="profile sidebar col-md-4 col-sm-6 col-xs-12 nopadding pull-right">
        <div class="profile app sidebar-content col-xs-12 nopadding">
          <div class="media apptop">
            <div class="media-left">
              <button class="btn btn-link hidden-xs" data-ums="app.close.wrapper"><i class="fa fa-times fa-2x"></i></button>
              <button class="btn btn-link visible-xs" data-ums="app.close.offcanvas"><i class="fa fa-times fa-2x"></i></button>
            </div>
            <div class="media-body">
            </div>
            <div class="media-right">
              <button class="btn btn-link" type="button" data-show="app.settings.login" data-toggle="show" aria-expanded="false" aria-controls="appsettings"><i class="fa fa-sign-in fa-2x"></i></button>
              </div>
            <div class="media-right">
              <button class="btn btn-link" type="button" data-show="app.settings.signup" data-toggle="show" aria-expanded="false" aria-controls="appsettings"><i class="fa fa-user-plus fa-2x"></i></button>
            </div>
          </div>
          
           <div class="tab-content appcontent container-fluid">
              <div role="tabpanel" class="tab-pane" id="applogin">
              ';
            $div=array('intro'=>'col-xs-12','form'=>'col-xs-12');
            $form=array(
                'id'    =>'app_settings-login',
                'type'  =>'login'
                  );
            include 'ums/login/html_login-tab.php';
            echo '
              </div>
              <div role="tabpanel" class="tab-pane" id="appsignup">
              ';
            $div=array('intro'=>'col-xs-12','form'=>'col-xs-12');
            $form=array(
                'id'    =>'app_settings-signup',
                'type'  =>'signup'
                  );
            include 'ums/login/html_signup-tab.php';
            echo '
              </div>
                    
          </div>
          <ul class="nav nav-tabs nav-justified nav-mobile appnav">
            <li role="presentation" class="active"><a href="#" data-target="#appnewsfeed" data-show="app.content.newsfeed" role="tab" data-toggle="tab" aria-controls="appnewsfeed" aria-expanded="true"><i class="fa fa-globe"></i> Noticias</a></li>
            <li role="presentation"><a href="#" data-target="#appnotifications" data-show="app.content.notifications" role="tab" data-toggle="tab" aria-controls="appnotifications" aria-expanded="false"><i class="fa fa-bell"></i> Notificaciones</a></li>
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
              <div class="media">
                <div class="media-body text-center">
                  <i class="fa fa-bell fa-4x"></i>
                  <b class="media-heading">NINGUNA ALERTA</b>
                  <p>Participa en nuestra comunidad !</p>
                </div> 
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div> 
    </div>';
}
