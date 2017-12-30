<?php
#Navbar
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

$str_search=array("á","é","í","ó","ú","ñ"," ");
$str_replace=array("a","e","i","o","u","n","-");

echo '<div class="ums ecommerce"><nav class="navbar navbar-inverse navbar-bar" role="navigation">
        <div class="navbar-header">
          <div class="navbar-brand">
            <span class="fa fa-newspaper-o"></span> <b>Clasificados</b>
          </div>
          <div class="navbar-btn visible-xs">
          <a href="'.$ecommerce['post'].'" class="btn btn-default pull-right"><i class="fa fa-edit"></i> Publicar</a>
          </div>
        </div>
        <form class="navbar-form" role="search" action="'.$ecommerce['path'].'" method="post">
          <input type="hidden" name="search" value="ecommerce">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <select class="form-control location" name="country" data-target="#location-state" data-form="location" required>
                <option value="all" selected="">Pais ...</option>
                <option value="all">Todos ...</option>
                <option value="mexico">México</option>
                <option value="argentina">Argentina</option>
                <option value="colombia">Colombia</option>
                <option value="peru">Peru</option>
                <option value="espana">España</option>
                <option value="estados-unidos">Estados Unidos</option>
                <option value="ecuador">Ecuador</option>
                <option value="guatemala">Guatemala</option>
                <option value="chile">Chile</option>
                <option value="panama">Panamá</option>
                <option disabled>_________</option>';
foreach ($paises as $key => $value) {
      echo '<option value="'.strtolower(str_replace($str_search,$str_replace,$value['pais'])).'">'.$value['pais'].'</option>';
}
              echo '</select>
              <span class="input-group-btn hidden-xs" style="width:0px;"></span>
              <div id="location-state">';
//                 <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
//                 <select class="form-control location" name="state" data-target="#location-county" required>
//                 <option value="">Estado ...</option>
//                 <option value="all">Todos ...</option>';
// foreach ($estados as $key => $value) {
//       echo '<option value="'.strtolower(str_replace($str_search,$str_replace,$value['estado'])).'">'.$value['estado'].'</option>';
// }
//               echo '
//               </select>
//               <select class="form-control" name="county" id="location-county" required>
//                 <option value="">Seleccione ...</option>
//               </select>
//               <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
        echo '    </div>
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default btn-block"><i class="fa fa-search"></i> Buscar</button>
              </div>
             </div>
            </div>';
          // <div class="form-group">
          // <button type="submit" class="btn btn-black visible-xs"><i class="fa fa-search"></i> Buscar</button>
          // </div>
           echo ' <div class="navbar-right hidden-xs">
          <a href="'.$ecommerce['post'].'" class="btn btn-default pull-right"><i class="fa fa-edit"></i> Publicar</a>
          </div>
        </form>
      </nav></div>';