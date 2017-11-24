<?php
#FormPublicar
$feedback=array('show'=>'warning',
                'status'=>$_SESSION['feedback'][$form['id']]['status']);

 if(isset($_SESSION['logged']))
{
      echo '<div class="media alert">
        <div class="media-left">
            <img src="'.ShowPic().'" class="profile-pic">
        </div>
        <div class="media-body">
            <strong class="media-heading">'.$_SESSION['logged']['name'].'</strong>
        </div>
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
          <legend class="text pyb">Datos de contacto</legend>
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
 
          
echo '  <fieldset>
          <legend class="text pyb">Información del perro</legend>
           <div class="form-group">
            <label for="calle" class="control-label">Sobre el perro :</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
              <input type="text" class="form-control" name="perro" placeholder="Nombre"';
              if(isset($_SESSION['feedback'][$form['id']]['perro'])){
                echo FeedbackValue($_SESSION['feedback'][$form['id']]['perro']);
              }
              echo ' required="requiered">
              <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <input type="text" class="form-control" name="edad" placeholder="Edad"';
              if(isset($_SESSION['feedback'][$form['id']]['edad'])){
                echo FeedbackValue($_SESSION['feedback'][$form['id']]['edad']);
              }
              echo ' required="requiered">
              <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <input type="text" class="form-control" name="color" placeholder="Color"';
              if(isset($_SESSION['feedback'][$form['id']]['color'])){
                echo FeedbackValue($_SESSION['feedback'][$form['id']]['color']);
              }
              echo ' required="requiered">
              <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <select class="form-control" name="sexo" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['sexo'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['sexo']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['sexo']).'</option>';
              }
          echo '
                <option value="">Sexo</option>
                <option value="macho">Macho</option>
                <option value="hembra">Hembra</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label">Perfil veterinario, esta :</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-sliders"></i></span>
              <select class="form-control" name="esterilizado" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['esterilizado'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['esterilizado']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['esterilizado']).'</option>';
              }
          echo '
                <option value="">Esterilizado ?</option>
                <option value="si">Si</option>
                <option value="talvez">Talvéz</option>
                <option value="nolose">No lo se</option>
                <option value="no">No</option>
              </select>
              <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <select class="form-control" name="vacunado" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['vacunado'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['vacunado']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['vacunado']).'</option>';
              }
          echo '
                <option value="">Vacunado ?</option>
                <option value="si">Si</option>
                <option value="talvez">Talvéz</option>
                <option value="nolose">No lo se</option>
                <option value="no">No</option>
              </select>
               <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <select class="form-control" name="desparacitado" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['desparacitado'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['desparacitado']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['desparacitado']).'</option>';
              }
          echo '
                <option value="">Desparacitado ?</option>
                <option value="si">Si</option>
                <option value="talvez">Talvéz</option>
                <option value="nolose">No lo se</option>
                <option value="no">No</option>
              </select>
               <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <select class="form-control" name="alergias" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['alergias'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['alergias']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['alergias']).'</option>';
              }
          echo '
                <option value="">Alergias ?</option>
                <option value="si">Si</option>
                <option value="talvez">Talvéz</option>
                <option value="nolose">No lo se</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label">Perfil social, convive con:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-sliders"></i></span>
              <select class="form-control" name="adultos" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['adultos'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['adultos']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['adultos']).'</option>';
              }
          echo '
                <option value="">Adultos ?</option>
                <option value="si">Si</option>
                <option value="talvez">Talvéz</option>
                <option value="nolose">No lo se</option>
                <option value="no">No</option>
              </select>
              <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <select class="form-control" name="ninos" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['ninos'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['ninos']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['ninos']).'</option>';
              }
          echo '
                <option value="">Niños ?</option>
                <option value="si">Si</option>
                <option value="talvez">Talvéz</option>
                <option value="nolose">No lo se</option>
                <option value="no">No</option>
              </select>
               <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <select class="form-control" name="gatos" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['gatos'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['gatos']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['gatos']).'</option>';
              }
          echo '
                <option value="">Gatos ?</option>
                <option value="si">Si</option>
                <option value="talvez">Talvéz</option>
                <option value="nolose">No lo se</option>
                <option value="no">No</option>
              </select>
               <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <select class="form-control" name="perros" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['perros'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['perros']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['perros']).'</option>';
              }
          echo '
                <option value="">Perros ?</option>
                <option value="si">Si</option>
                <option value="talvez">Talvéz</option>
                <option value="nolose">No lo se</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
          </fieldset>
          <fieldset>
            <legend class="text pyb">Informacion sobre la adopcion</legend>
           <div class="form-group">
            <label for="imagen" class="control-label">Requisitos para la adopcion:</label>
              <textarea rows="2" class="form-control" name="requisitos" placeholder="Describe todos los requisitos para adoptar este pitbull." required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['requisitos'])){
                echo FeedbackValueData($_SESSION['feedback'][$form['id']]['requisitos']);
              }
              echo '</textarea>
            </div>
             <div class="form-group">
            <label for="imagen" class="control-label">Puntos a conciderar:</label>
              <textarea rows="2" class="form-control" name="puntos" placeholder="Describe todas las necesidades basicas y especiales que requiere este pitbull." required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['puntos'])){
                echo FeedbackValueData($_SESSION['feedback'][$form['id']]['puntos']);
              }
              echo '</textarea>
            </div>
             <div class="form-group">
            <label for="imagen" class="control-label">Proceso de adopcion:</label>
              <textarea rows="2" class="form-control" name="proceso" placeholder="Describe el proceso de adopcion para este pitbull." required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['proceso'])){
                echo FeedbackValueData($_SESSION['feedback'][$form['id']]['proceso']);
              }
              echo '</textarea>
            </div>
          </fieldset>
          <fieldset>
            <legend class="text pyb">Detalles de la publicacion</legend>
            <div class="form-group">
            <label for="pais" class="control-label">Ubicacion :</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <select class="form-control location_country" name="pais" data-target="#'.$form['id'].'-estados" data-form="'.$form['id'].'" required="requiered">
                <option value="">Pais ...</option>
                <option value="México" selected="">México</option>
                <option value="Argentina">Argentina</option>
                <option value="Colombia">Colombia</option>
                <option value="Peru">Peru</option>
                <option value="España">España</option>
                <option value="Estados Unidos">Estados Unidos</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Chile">Chile</option>
                <option value="Panamá">Panamá</option>
                <option disabled>_________</option>';
foreach ($paises as $key => $value) {
      echo '<option value="'.$value['pais'].'">'.$value['pais'].'</option>';
}
              echo '</select>
            </div>
            </div>
            <div id="'.$form['id'].'-estados">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-dot-circle-o"></i></span>
              <select class="form-control location_state" name="estado" data-target="#'.$form['id'].'-municipios" required="requiered">
                <option value="">Estado ...</option>';
foreach ($estados as $key => $value) {
      echo '<option value="'.$value['estado'].'">'.$value['estado'].'</option>';
}
              echo '
              </select>
              <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <select class="form-control" name="municipio" id="'.$form['id'].'-municipios">
                <option value="">Municipio ...</option>
              </select>
            </div>
            </div>
            <div class="form-group">
            <label for="imagen" class="control-label">Imagen para la publicacion :</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-image"></i></span>
              <input type="file" class="form-control images" name="images[]" multiple accept="image/*" required="requiered">
            </div>
            <div class="thumbnails"></div>
          </div>
           <div class="form-group">
            <label for="titulo" class="control-label">Titulo de la publicacion :</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-bullhorn"></i></span>
              <input type="text" class="form-control" name="titulo" placeholder="Titulo corto y descriptivo"';
              if(isset($_SESSION['feedback'][$form['id']]['titulo'])){
                echo FeedbackValue($_SESSION['feedback'][$form['id']]['titulo']);
              }
              echo ' required="requiered">
            </div>
          </div>
           <div class="form-group">
              <textarea rows="2" class="form-control" name="descripcion" placeholder="Ahora te invitamos a que escribas un texto de el por qué deberian de adoptar a este pitbull." required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['descripcion'])){
                echo FeedbackValueData($_SESSION['feedback'][$form['id']]['descripcion']);
              }
              echo '</textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-default">Enviar publicación <i class="fa fa-share"></i></button>
            </div>
        </fieldset>
      </form>';

unset($_SESSION['feedback'][$form['id']]);