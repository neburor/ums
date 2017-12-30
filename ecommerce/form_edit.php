<?php
#FormPublicar

 if(isset($_SESSION['logged']))
{

      echo '<div class="media alert">
        <div class="media-left">
            <img src="'.ShowPic().'" class="profile-pic">
        </div>
        <div class="media-body">
            <strong class="media-heading">'.$_SESSION['logged']['name'].'</strong></div>'; 
    echo' 
        </div>';
      }
echo '
  <form class="form wizard1" role="form" action="'.$form['action'].'#'.$form['callback'].'" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="formid" value="'.$form['id'].'">
        <input type="hidden" name="formtype" value="'.$form['type'].'">
        <input type="hidden" name="id" value="'.$post['id'].'">
        <div class="form-group response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
        ';          
echo '    <fieldset>
            <legend>Detalles de la publicacion</legend>
            <div class="form-group">
            <label for="country" class="control-label">Ubicacion :</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <select class="form-control location" name="country" data-target="#'.$form['id'].'-state" data-form="'.$form['id'].'" required="requiered">
                <option value="" selected="">Pais ...</option>
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
      echo '<option value="'.$value['pais'].'">'.$value['pais'].'</option>';
}
              echo '</select>
              <span class="input-group-btn hidden-xs" style="width:0px;"></span>
              <div id="'.$form['id'].'-state">
              </div>
            </div>
            </div>';
    echo '<div class="form-group">
            <label for="images" class="control-label">Imagenes para la publicación:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-image"></i></span>
              <input type="file" class="form-control images" name="images[]" multiple accept="image/*">
            </div>
            <small>Máximo 10, menores de 0.5Mb (512Kb) y de formato JPG o PNG.<br><i class="fa fa-info-circle"></i> Si envias desde celular, para que midan menos, selecciona de las enviadas por whatsapp.</small>
            <div class="thumbnails clearfix"></div><div class="clearfix">
            ';
            if($images=json_decode($post['images'], true)){
              echo '<legend>Imagenes publicadas:</legend><small class="clearfix"><i class="fa fa-info-circle"></i> Click para indicar cual eliminar.</small>';
              foreach ($images['list'] as $key => $value) {
                if($value['status']){
                  $x++;
                  echo '<label class="pic">
          <input type="checkbox" name="ec_images[]" value="'.$value['name'].'" checked>
            <img src="'.$images['dir'].$value['name'].'_thumbnail.jpg">
        </label>';
                }
              }
              echo '<input type="hidden" name="count" value="'.$x.'">';
            }
           echo '</div>
          </div>
           <div class="form-group">
            <label for="title" class="control-label">Titulo de la publicación:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-bullhorn"></i></span>
              <input type="text" class="form-control" name="title" placeholder="Titulo corto y descriptivo"';
              if(isset($_SESSION['feedback'][$form['id']]['title'])){
                echo FeedbackValue($_SESSION['feedback'][$form['id']]['title']);
              }
              echo ' required="requiered">
            </div>
          </div>
           <div class="form-group">
           <label for="ec_description" class="control-label">Descripción de la publicación:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-edit"></i></span>
              <textarea rows="2" class="form-control" name="ec_description" placeholder="Descripcion de la publicación" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['ec_description'])){
                echo FeedbackValueData($_SESSION['feedback'][$form['id']]['ec_description']);
              }
              echo '</textarea>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-default">Actualizar publicación <i class="fa fa-share"></i></button>
            </div>
        </fieldset>
      </form>';

unset($_SESSION['feedback'][$form['id']]);