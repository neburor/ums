<?php
#FormPublicar
$feedback=array('show'=>'warning',
                'status'=>$_SESSION['feedback'][$form['id']]['status']);

 if(isset($_SESSION['logged']))
{
    $UserECpost=SQLselect(
              array('table' => 'ecommerce'),
              array(
                    'type'    => $ecommerce['type'],
                    'account' =>$_SESSION['logged']['id'],
                    'status'  =>'0',
                    'cat'     => $ecommerce['cat']
                    )
          );

      echo '<div class="media alert">
        <div class="media-left">
            <img src="'.ShowPic().'" class="profile-pic">
        </div>
        <div class="media-body">
            <strong class="media-heading">'.$_SESSION['logged']['name'].'</strong></div>';
        if($UserECpost)
        {
          echo '<div class="list-group">';
          foreach ($UserECpost as $key => $value) {
            $date=Interval($value['datetime']);

            echo '
                  <a href="'.$ecommerce['path'].'pub_'.$value['id'].'.html?edit" class="list-group-item">
                    <div class="media">
                    <div class="media-left">
                      <span class="fa fa-edit fa-2x"></span>
                    </div>
                    <div class="media-body">
                      <span class="media-heading"><b>'.$value['title'].'</b><small class="pull-right">Hace '.$date[0].' '.$date[1].'</small></span>
                    </div>
                    <div class="media-right"><i class="fa fa-chevron-right"></i></div>
                    </div>
                    </a>';
          }
          echo '</div>';
        }
    echo' 
        </div>';
      }
echo '
  <form class="form wizard1" role="form" action="'.$form['action'].'#'.$form['callback'].'" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="formid" value="'.$form['id'].'">
        <input type="hidden" name="formtype" value="'.$form['type'].'">
        <div class="form-group response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
        ';

if(!isset($_SESSION['logged']))
{
echo ' <fieldset>
          <legend>Datos de contacto</legend>
 <div class="row">
        <div class="form-group col-xs-12">
          <p><i class="fa fa-info-circle"></i> Complete los siguientes campos o <b><i class="fa fa-sign-in"></i> Inicie sesion</b> / <b><i class="fa fa-user-plus"></i> Registrese</b>.</p>
          <label>Conectarse con :</label> 
            <a class="btn btn-social-icon btn-facebook" href="?login=facebook';
            if($form['callback'])
            {
              echo '&callback='.$form['callback'];
            }
            if($form['btn'])
            {
              echo '&btn='.$form['btn'];
            }
            echo '" rel="nofollow"> <i class="fa fa-facebook"></i></a> 
            <a class="btn btn-social-icon btn-google" href="?login=google';
            if($form['callback'])
            {
              echo '&callback='.$form['callback'];
            }
            if($form['btn'])
            {
              echo '&btn='.$form['btn'];
            }
            echo '" rel="nofollow"> <i class="fa fa-google"></i></a>
            <a class="btn btn-social-icon btn-twitter" href="?login=twitter';
            if($form['callback'])
            {
              echo '&callback='.$form['callback'];
            }
            if($form['btn'])
            {
              echo '&btn='.$form['btn'];
            }
            echo '" rel="nofollow"> <i class="fa fa-twitter"></i></a>
        </div>
        <div class="form-group col-xs-12 col-sm-6'.FeedbackClass($_SESSION['feedback'][$form['id']]['name']).'">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" name="name" placeholder="Tu nombre ..." required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['name']).'>
            '.FeedbackIcon($_SESSION['feedback'][$form['id']]['name']).'
          </div>
        </div>
        <div class="form-group col-xs-12 col-sm-6'.FeedbackClass($_SESSION['feedback'][$form['id']]['email']).'">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-at"></i></span>
            <input type="email" class="form-control" name="email" placeholder="Tu correo ..." required="" '.FeedbackValue($_SESSION['feedback'][$form['id']]['email']).'>
            '.FeedbackIcon($_SESSION['feedback'][$form['id']]['email']).'
          </div>
          <div class="hidden"><input type="email" name="repeatmail" placeholder="Confirmar correo"></div>
        </div>
        <div class="form-group col-xs-12">
          <label><input type="checkbox" name="funnel" value="signon" checked=""> Crearme una cuenta <b>GRATIS!</b>.</label> Recibira un correo para confirmar.
        </div></div>
        </fieldset>';

      }
 
          
echo '    <fieldset>
            <legend>Detalles de la publicacion</legend>
            <div class="form-group">
            <label for="pais" class="control-label">Ubicacion :</label>
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
//             echo '<div id="'.$form['id'].'-estados">
//             <div class="input-group">
//               <span class="input-group-addon"><i class="fa fa-dot-circle-o"></i></span>
//               <select class="form-control location_state" name="estado" data-target="#'.$form['id'].'-municipios" required="requiered">
//                 <option value="">Estado ...</option>';
// foreach ($estados as $key => $value) {
//       echo '<option value="'.$value['estado'].'">'.$value['estado'].'</option>';
// }
//               echo '
//               </select>
//               <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
//               <select class="form-control" name="municipio" id="'.$form['id'].'-municipios">
//                 <option value="">Municipio ...</option>
//               </select>
//             </div>
//             </div>';
            echo '<div class="form-group">
            <label for="imagen" class="control-label">Imagenes para la publicación:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-image"></i></span>
              <input type="file" class="form-control images" name="images[]" multiple accept="image/*" required="requiered">
            </div>
            <small>Máximo 10, menores de 0.5Mb (512Kb) y de formato JPG o PNG.<br><i class="fa fa-info-circle"></i> Si envias desde celular, para que midan menos, selecciona de las enviadas por whatsapp.</small>
            <div class="thumbnails clearfix"></div>
           
          </div>
           <div class="form-group">
            <label for="title" class="control-label">Titulo de la publicación:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-bullhorn"></i></span>
              <input type="text" class="form-control" name="title" placeholder="Titulo corto y descriptivo"';
              if(isset($_SESSION['feedback'][$form['id']]['title'])){
                echo FeedbackValue($_SESSION['feedback'][$form['id']]['title'],$feedback);
              }
              echo ' required="requiered">
            </div>
          </div>
           <div class="form-group">
              <textarea rows="2" class="form-control" name="ec_description" placeholder="Descripcion de la publicación" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['ec_description'])){
                echo FeedbackValueData($_SESSION['feedback'][$form['id']]['ec_description'],$feedback);
              }
              echo '</textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-default">Enviar publicación <i class="fa fa-share"></i></button>
            </div>
        </fieldset>
      </form>';

unset($_SESSION['feedback'][$form['id']]);