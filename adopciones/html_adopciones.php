<?php
#Adopciones
$paises=SQLselect(
              array(
                  'table' => 'paises',
                  'query' => '
                  SELECT * from paises
                  '
                )
        );
$estados=SQLselect(
              array(
                  'table' => 'estados',
                  'query' => '
                  SELECT * from estados
                  WHERE `pais` = "México"
                  '
                )
        );

if(isset($_GET['tab']))
{
  $tab=$_GET['tab'];
}
else
{
  $tab='tab_adopciones-buscar';
}

echo '<div ums class="ums adopciones col-xs-12 nopadding"';
  if($params_adopciones['id']!='')
  {
    echo ' id="'.$params_adopciones['id'].'"';
  }
echo '>
        <div class="panel panel-default">
          <div class="panel-heading navheading">
            <i class="fa fa-paw fa-2x"></i> <b>Adopciones</b>
            <ul class="nav nav-tabs nav-login">
              <li role="presentation" ';
              if($tab=='tab_adopciones-buscar')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_adopciones-buscar#tab_adopciones-buscar" data-target="#tab_adopciones-buscar" data-hash="/ums/tab/tab_adopciones-buscar" role="tab" data-toggle="tab" aria-controls="tab_adopciones-buscar" aria-expanded="false"> <i class="fa fa-search"></i> <span class="hidden-xxs">Buscar</span></a></li>
              <li role="presentation" ';
              if($tab=='tab_adopciones-publicar')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_adopciones-publicar#tab_adopciones-publicar" data-target="#tab_adopciones-publicar" data-hash="/ums/tab/tab_adopciones-publicar" role="tab" data-toggle="tab" aria-controls="tab_adopciones-publicar" aria-expanded="false"> <i class="fa fa-edit"></i> <span class="hidden-xxs">Publicar</span></a></li>
              <li role="presentation" ';
              if($tab=='tab_adopciones-adoptante')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_adopciones-adoptante#tab_adopciones-adoptante" data-target="#tab_adopciones-adoptante" data-hash="/ums/tab/tab_adopciones-adoptante" role="tab" data-toggle="tab" aria-controls="tab_adopciones-adoptante" aria-expanded="false"> <i class="fa fa-user-plus"></i> <span class="hidden-xxs">Adoptantes</span></a></li>';

  echo '</ul>
          </div>
          <div class="panel-body">
            <div class="tab-content">';
    echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_adopciones-buscar')
              {
                echo ' fade active in';
              }
              echo '" id="tab_adopciones-buscar">
    <div class="col-xs-12">
      <h2 class="text pyb">Buscar perros pitbull en adopcion</h2>
      <p>Selecciona tu pais para mostrarte la lista de perros pitbulls en adopcion, en algunos paises puedes seleccionar la localidad también.</p>
    <nav class="navbar navbar-inverse nav-footer">
      <div class="container-fluid">
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <select class="form-control" id="pais" name="pais">
                <option value="pais">Seleccionar</option>
                <option value="Mexico" selected="">Mexico</option>
                <option value="Colombia">Colombia</option>
                <option value="Argentina">Argentina</option>
                <option value="España">España</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-dot-circle-o"></i></span>
              <select class="form-control" name="estado">
                <option>Estado ...</option>
              </select>
            <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <select class="form-control" name="municipio">
                <option>Municipio ...</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-block btn-black"><i class="fa fa-search"></i> Buscar</button>
          </div>
        </form>
      </div>
    </nav>
    </div>
  </div>';
    echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_adopciones-publicar')
              {
                echo ' fade active in';
              }
              echo '" id="tab_adopciones-publicar">';
$form=array(
      'id'    =>'tab_adopciones-publicar',
      'type'  =>'adopcion',
      'action'=>'?tab=tab_adopciones-publicar',
      'callback'=> '/ums/tab/tab_adopciones-publicar'
    );
  echo '<div class="row"><div class="col-xs-12">
  <div class="col-md-8 col-xs-12 col-md-offset-2 xxs-nopadding">
  <h2 class="text pyb">Publicar un pitbull en adopcion</h2>';
include 'ums/adopciones/form_publicar.php';
  echo '</div></div></div></div>';
   echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_adopciones-adoptante')
              {
                echo ' fade active in';
              }
              echo '" id="tab_adopciones-adoptante">';
$form=array(
      'id'    =>'tab_adopciones-adoptante',
      'type'  =>'adoptante',
      'action'=>'?tab=tab_adopciones-adoptante',
      'callback'=> '/ums/tab/tab_adopciones-adoptante'
    );
  echo '<div class="row"><div class="col-xs-12">
  <div class="col-md-8 col-xs-12 col-md-offset-2 xxs-nopadding">
  <h2 class="text pyb">Darse de alta como adoptante</h2>
  <p>La adopción es una responsabilidad que durara toda la vida del pitbull, que requiere de un trato digno y completo con comida, disciplina, ejercicio, y respeto. Si estas conciente del reto que conlleva te invitamos a llenar el siguiente formulario que nos ayudara a encontrar un integrante mas a tu familia. Despues te invitamos a leer toda la informacion de adopciones.</p>';
include 'ums/adopciones/form_adoptante.php';
  echo '</div></div></div></div>';
echo '
            </div>
          </div>
        </div>
      </div>
';