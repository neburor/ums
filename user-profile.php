<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header pull-left">
      <a class="navbar-brand" href="http://ums.hostingmex.com.mx/"><img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png" alt="Administracion de usuarios Web"></a>
    </div>
    <ul class="nav navbar-nav pull-right">
      <li><a href="?logout" class=""><i class="fa fa-power-off"></i> <span class="">Salir</span></a></li>
    </ul>
  </div><!-- /.container-fluid -->
</nav>

    <div class="cover-bg">
      <?php
      if($_SESSION['profile']['cover']=='facebook' || $_SESSION['profile']['cover']=='twitter')
      {
        echo '<img src="'.$_SESSION['profile']['networks'][$_SESSION['profile']['cover']]['cover'].'">';
      }
      elseif($_SESSION['profile']['cover']=='local')
      {
        echo '<img src="images/cover/cover_'.$_SESSION['profile']['id'].'.jpg">';
      }
      ?>
    </div>
  
    <div class="container cover-cont">
      <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading navheading">
        <div class="media cover-title">
          <div class="media-left">
            <?php
            if($_SESSION['profile']['pic']=='facebook' || $_SESSION['profile']['pic']=='twitter')
            {
              if($_SESSION['profile']['pic']=='twitter')
              {
                $_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic']=str_replace('_normal', '_bigger', $_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic']);
              }
              echo '<img src="'.$_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic'].'" class="img-circle">';
            }
            elseif($_SESSION['profile']['pic']=='local')
            {
              echo '<img src="images/pic/pic_'.$_SESSION['profile']['id'].'.jpg" class="img-circle">';
            }
            ?>
            
          </div>
          <div class="media-body"><h1 class="media-heading"><?php echo $_SESSION['profile']['name']?></h1>
          <?php
          $panel_tabs=array(
              '' => '', 
              'mensajes' => '', 
              'comentarios' => '', 
              'preferencias' => ''
              );
          
          if(isset($_GET['tab']))
          {

            foreach ($panel_tabs as $key => $value) {
            if($key==$_GET['tab'])
              {
                $panel_tabs[$key]='active';
              }
            }
          }
          else 
          {
            $panel_tabs['']='active';
          }

          ?>
          <ul class="nav nav-tabs cover-nav hidden-xs">
          <li role="presentation" class="<?php echo $panel_tabs[''] ?>"><a href="/" data-target="#profile-home" role="tab" data-toggle="tab" aria-controls="profile-home" aria-expanded="false"> <i class="fa fa-bookmark"></i> <span>Inicio</span></a></li>
          <li role="presentation" class="<?php echo $panel_tabs['mensajes'] ?>"><a href="?tab=mensajes" data-target="#profile-messages" role="tab" data-toggle="tab" aria-controls="profile-messages" aria-expanded="false"> <i class="fa fa-envelope"></i> <span>Mensajes</span></a></li>
          <li role="presentation" class="<?php echo $panel_tabs['comentarios'] ?>"><a href="?tab=comentarios" data-target="#profile-comments" role="tab" data-toggle="tab" aria-controls="profile-comments" aria-expanded="false"> <i class="fa fa-commenting"></i> <span>Comentarios</span></a></li>
           <li role="presentation" class="<?php echo $panel_tabs['preferencias'] ?>"><a href="?tab=preferencias" data-target="#profile-config" role="tab" data-toggle="tab" aria-controls="profile-config" aria-expanded="false"> <i class="fa fa-cog"></i> <span>Preferencias</span></a></li>
        </ul>
          </div>
        </div>
        <ul class="nav nav-tabs cover-nav-mobil nav-justified visible-xs">
          <li role="presentation" class="<?php echo $panel_tabs[''] ?>"><a href="/" data-target="#profile-home" role="tab" data-toggle="tab" aria-controls="profile-home" aria-expanded="false"> <i class="fa fa-bookmark"></i> <span>Inicio</span></a></li>
          <li role="presentation" class="<?php echo $panel_tabs['mensajes'] ?>"><a href="?tab=mensajes" data-target="#profile-messages" role="tab" data-toggle="tab" aria-controls="profile-messages" aria-expanded="false"> <i class="fa fa-envelope"></i> <span>Mensajes</span></a></li>
          <li role="presentation" class="<?php echo $panel_tabs['comentarios'] ?>"><a href="?tab=comentarios" data-target="#profile-comments" role="tab" data-toggle="tab" aria-controls="profile-comments" aria-expanded="false"> <i class="fa fa-commenting"></i> <span>Comentarios</span></a></li>
           <li role="presentation" class="<?php echo $panel_tabs['preferencias'] ?>"><a href="?tab=preferencias" data-target="#profile-config" role="tab" data-toggle="tab" aria-controls="profile-config" aria-expanded="false"> <i class="fa fa-cog"></i> <span>Preferencias</span></a></li>
        </ul>
      </div>
      <div class="panel-body">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane <?php echo $panel_tabs[''] ?>" id="profile-home">
          </div>
          <div role="tabpanel" class="tab-pane <?php echo $panel_tabs['comentarios'] ?>" id="profile-comments">
            <div class="col-sm-push-1 col-sm-10 col-xs-12 xxs-nopadding">
              <div class="col-xs-12 xxs-nopadding">
      <div class="media">
        <div class="media-body text-center">
          <i class="fa fa-commenting fa-4x"></i>
          <b class="media-heading">NINGUN COMENTARIO</b>
          <p>Realiza un comentario !</p>
        </div> 
      </div> 
      <hr>
      </div>
     
      <div class="col-xs-12 xxs-nopadding commenting">
        <ul class="breadcrumb">
          <li><img src="img/post_thumbnail.jpg"></li>
          <li><strong><a href="">Tipos de pitbull</a></strong></li>
          <li>35 <i class="fa fa-commenting"></i><span class="hidden-xs"> comentarios</span></li>
          <li>67 <i class="fa fa-share"></i><span class="hidden-xs"> compartidas</span></li>
        </ul>
              <div class="media">
                <div class="media-left">
                  <a href="#">
                    <img class="media-object" alt="" src="img/pic.jpg">
                  </a>
                </div>
                <div class="media-body">
                  <strong href="" class="media-heading">Nebur Oirad <span class="label label-default pull-right">Hace 3 dias</span></strong>
                   <p>Deben cambiar las descripciones arriba porque se enfatiza en la pelea de perros y de cierta forma se promueve la compra de un ejemplar específico para dicha tarea. Si las cruzas se crearon únicamente para pelea debe ser parte de su pasado y quedarse ahí; el tiempo cambia, si nos sentimos en la cumbre del ser humano entonces tratemos a nuestros amigos con la dignidad y respeto que merecen.
                   <br>
                   <small>25 Me gusta</small> <small>2 Respuestas</small>
                   </p>
                   <div class="media">
                    <div class="media-left">
                  <a href="#">
                    <img class="media-object" alt="" src="img/pic2.jpg">
                  </a>
                </div>
                <div class="media-body">
                  <small href="" class="media-heading">Monzerrat M. Mota Rodriguez <span class="label label-default pull-right">Hace 3 dias</span></small>
                   <p>Esta es una respuesta</p>
                </div>
                
              </div> 
              <div class="media">
                <div class="media-left">
                  <a href="#">
                    <img class="media-object" alt="" src="img/pic.jpg">
                  </a>
                </div>
                <div class="media-body">
                  <small href="" class="media-heading">Nebur Oirad <span class="label label-default pull-right">Hace 8 horas</span></small>
                   <p>Esta es una respuesta
                   </p>
                </div>
                
              </div>
              <div class="container-fluid">
                  <form class="form" role="form" tipo="reply">
              <input type="hidden" name="form" value="comentario">
              <input type="hidden" name="reply" value="31">
              <div class="result form-group">
              </div>
              <div class="form-group col-xs-12 xxs-nopadding">
                <div class="input-group">
                  <input name="comentario" placeholder="Agregar respuesta" class="form-control input-pyb">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default btn-pyb"><i class="fa fa-share"></i></button>
                  </div>
                </div>
              </div>
            </form></div>
                </div>
              </div>  
            </div>
            <div class="col-xs-12 xxs-nopadding commenting">
  <ul class="breadcrumb">
          <li><img src="img/post2_thumbnail.jpg"></li>
          <li><strong><a href="">25 Razones Por Las Que NADIE Debería Tener Un Pitbull Como Mascota</a></strong></li>
          <li>35 <i class="fa fa-commenting"></i><span class="hidden-xs"> comentarios</span></li>
          <li>67 <i class="fa fa-share"></i><span class="hidden-xs"> compartidas</span></li>
        </ul>
              <div class="media">
                <div class="media-left">
                  <a href="#">
                    <img class="media-object" alt="" src="img/pic.jpg">
                  </a>
                </div>
                <div class="media-body">
                  <strong href="" class="media-heading">Nebur Oirad <span class="label label-default pull-right">Hace 2 meses</span></strong>
                   <p>no tienen por ke hablar mal de los pit bull sino le gustan pues simplemente no digan nada pero no hable mentiras .... yo ten go 5 pitbull y no tengo nada malo ke decir todo lo ke dicen haya arriba es una calumnia . es todo lo contrario estos perros pueden ser mas amorosos y cariñosos ke kualkier otra raza 
                   <br>
                   <small>1 Respuesta</small>
                   </p>
                    <div class="media">
                    <div class="media-left">
                  <a href="#">
                    <img class="media-object" alt="" src="img/pic2.jpg">
                  </a>
                </div>
                <div class="media-body">
                  <small href="" class="media-heading">Monzerrat M. Mota Rodriguez <span class="label label-default pull-right">Hace 1 mes</span></small>
                   <p>Lee bien el articulo</p>
                </div>
                
              </div> 
              <div class="container-fluid">
                  <form class="form" role="form" tipo="reply">
              <input type="hidden" name="form" value="comentario">
              <input type="hidden" name="reply" value="31">
              <div class="result form-group">
              </div>
              <div class="form-group col-xs-12 xxs-nopadding">
                <div class="input-group">
                  <input name="comentario" placeholder="Agregar respuesta" class="form-control input-pyb">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default btn-pyb"><i class="fa fa-share"></i></button>
                  </div>
                </div>
              </div>
            </form></div>
                </div>
              </div>  
      </div>

            </div>
          </div>
          <div role="tabpanel" class="tab-pane <?php echo $panel_tabs['preferencias'] ?>" id="profile-config">
<?php
include 'user-settings.php';
?>
          </div>
          <div role="tabpanel" class="tab-pane <?php echo $panel_tabs['mensajes'] ?>" id="profile-messages">
            <div class="col-sm-push-1 col-sm-10 col-xs-12 xxs-nopadding">
      <div class="col-xs-12 xxs-nopadding">
      <div class="media">
        <div class="media-body text-center">
          <i class="fa fa-envelope fa-4x"></i>
          <b class="media-heading">NINGUN MENSAJE</b>
          <p>Escribenos un mensaje !</p>
        </div> 
      </div>
         <form class="form" role="form">
            <div class="result form-group">
            </div>
              <div class="form-group col-xs-12">
                <div class="input-group">
              <span class="input-group-addon addon-pyb"><i class="fa fa-edit"></i></span>
              <textarea name="mensaje" placeholder="Escriba su mensaje a la administracion ..." class="form-control input-pyb"></textarea>
            </div>
              </div>
              <div class="form-group text-right">
                 <button type="submit" class="btn btn-default btn-pyb"><i class="fa fa-envelope"></i> Enviar mensaje</button>
              </div>
            </form><hr>
      </div>
      <div class="col-xs-12 xxs-nopadding">
        <div class="media message reply">
                <div class="media-left"><small><span class="label label-default">Hace 8 horas</span></small></div>
                <div class="media-body text-right">
                  <small href="" class="media-heading">Admin</small>
                   <p>Hola, escribenos si necesitas ayuda</p>
                </div>
                
                <div class="media-right">
                  <a href="#">
                    <img class="media-object" alt="" src="img/pic_admin.jpg">
                  </a>
                </div>
              </div>
         <div class="media message">
                <div class="media-left">
                  <a href="#">
                    <img class="media-object" alt="" src="img/pic.jpg">
                  </a>
                </div>
                <div class="media-body">
                  <small href="" class="media-heading">Nebur Oirad <span class="label label-default pull-right">Hace 8 horas</span></small>
                   <p>Deseó adoptar una perita pitbull. soy de Guadalajara jal. mex.</p>
                </div>
                
              </div>
               <div class="media message reply">
                <div class="media-left"><small><span class="label label-default pull-right">Hace 8 horas</span></small></div>
                
                <div class="media-body text-right">
                  <small href="" class="media-heading">Admin</small>
                   <p>Hola, puedes <a href=""><i class="fa fa-search"></i> buscar</a> y completar el formulario de <a href=""><i class="fa fa-edit"></i> adoptantes</a> y en cuanto tengamos una coincidencia te lo notificaremos.</p>
                </div>
                <div class="media-right">
                  <a href="#">
                    <img class="media-object" alt="" src="img/pic_admin.jpg">
                  </a>
                </div>
              </div>
                <form class="form profile" role="form" tipo="contacto">
         
          <div class="form-group">
            <div class="input-group">
              <input name="mensaje" placeholder="Su mensaje a la administración ..." class="form-control input-pyb">
              <div class="input-group-btn">
              <button type="submit" class="btn btn-default btn-pyb"><i class="fa fa-share"></i></button>
            </div>
            </div>
          </div>
            <div class="result"></div>
        </form>
      </div>

    </div>
    </div>
        </div>
      </div>
    </div>
    </div>
</div>