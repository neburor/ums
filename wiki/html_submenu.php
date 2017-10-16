<?php
//wiki submenu
echo ' <div class="clearfix"></div>
                <ul class="nav nav-tabs nav-mobile nav-justified" id="editar">
                  <li><a href="'.strtok($_SERVER["REQUEST_URI"],'?').'#articulo"><i class="fa fa-file-text"></i><span> Leer</span></a></li>';
if(!isset($_GET['wiki']))
{
  echo '   <li><a href="?wiki#edit"><i class="fa fa-edit"></i><span> Editar</span></a></li>';
}
else
{
  if($_GET['wiki']=='advanced')
  {
    echo ' <li><a href="?wiki#edit"><i class="fa fa-edit"></i><span> Basico</span></a></li>
                  <li><a href="?wiki=preview#preview"><i class="fa fa-files-o"></i><span> Preview</span></a></li>';
  }
  else
  {
    echo ' <li><a href="?wiki=advanced#edit"><i class="fa fa-edit"></i><span> Avanzado</span></a></li>
                  <li><a href="?wiki=preview#preview"><i class="fa fa-files-o"></i><span> Preview</span></a></li>';
  }
}
echo '     <li><a href="?wiki=add#add"><i class="fa fa-sticky-note"></i><span> Agregar</span></a></li>
                  <li><a href="?wiki=history#history"><i class="fa fa-history"></i><span> Historial</span></a></li>                  
                </ul>';