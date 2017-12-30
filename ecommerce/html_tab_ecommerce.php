<?php
#Ecommerce
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
  $tab='tab_ecommerce-search';
}

echo '<div ums class="ums ecommerce col-xs-12 nopadding"';
  if($ecommerce['tab']['id']!='')
  {
    echo ' id="'.$ecommerce['tab']['id'].'"';
  }
echo '>
        <div class="panel panel-default">
          <div class="panel-heading navheading">
            '.$ecommerce['tab']['title'].'
            <ul class="nav nav-tabs nav-login">
              <li role="presentation" ';
              if($tab=='tab_ecommerce-search')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_ecommerce-search#tab_ecommerce-search" data-target="#tab_ecommerce-search" data-hash="/ums/tab/tab_ecommerce-search" role="tab" data-toggle="tab" aria-controls="tab_ecommerce-search" aria-expanded="false"> <i class="fa fa-search"></i> <span class="hidden-xxs">Buscar</span></a></li>
              <li role="presentation" ';
              if($tab=='tab_ecommerce-post')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_ecommerce-post#tab_ecommerce-post" data-target="#tab_ecommerce-post" data-hash="/ums/tab/tab_ecommerce-post" role="tab" data-toggle="tab" aria-controls="tab_ecommerce-post" aria-expanded="false"> <i class="fa fa-edit"></i> <span class="hidden-xxs">Publicar</span></a></li>';

  echo '</ul>
          </div>
          <div class="panel-body">
            <div class="tab-content">';
    echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_ecommerce-search')
              {
                echo ' fade active in';
              }
              echo '" id="tab_ecommerce-search">
    <div class="col-xs-12">
      '.$ecommerce['search']['text'].'
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
              if($tab=='tab_ecommerce-post')
              {
                echo ' fade active in';
              }
              echo '" id="tab_ecommerce-post">';
$form=array(
      'id'    =>'tab_ecommerce-post',
      'type'  =>'ecommerce',
      'action'=>'?tab=tab_ecommerce-post',
      'callback'=> '/ums/tab/tab_ecommerce-post'
    );
  echo '<div class="row"><div class="col-xs-12">
  <div class="col-md-8 col-xs-12 col-md-offset-2 xxs-nopadding">
  '.$ecommerce['post']['text'].'';
include 'ums/ecommerce/form_post.php';
  echo '</div></div></div></div>';
  
echo '
            </div>
          </div>
        </div>
      </div>
';