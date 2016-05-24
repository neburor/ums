<div class="col-sm-push-1 col-sm-10 col-xs-12 xxs-nopadding">
<?php
echo HTML('div_intro_newmessage');
echo HTML('form_user_newmessage');
?>
  <div class="col-xs-12 xxs-nopadding">
    <hr>
<?php
include 'messages/functions.php';
echo MESSAGES($_SESSION['profile']['id']);

?>
     <ul class="list-group">
            <li class="list-group-item">
              <i class="fa fa-comments"></i> 15 comentarios
            </li>
            <li class="list-group-item container-fluid">
              <p class="list-group-item-heading"><strong><i class="fa fa-user"></i> Nebur Oirad</strong> <span class="label label-default pull-right"> Hace 5 minutos</span></p>
              <p class="list-group-item-text">Este es mi primer comentario</p>
          </li>
        </ul>
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