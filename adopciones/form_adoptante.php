<?php
#FormAdoptante
$feedback=array('show'=>'warning',
                'status'=>$_SESSION['feedback'][$form['id']]['status']);

$quiz=SQLselect(
              array(
                  'table' => 'quiz',
                  'query' => '
                  SELECT * from quiz
                  WHERE `type` = "adoptante"
                  AND `account` = "'.$_SESSION['logged']['id'].'"
                  '
                )
        ); 
if(isset($_SESSION['logged']))
{
      echo '<div class="media alert';
      if($quiz){ echo ' green';}
      echo '">
        <div class="media-left">
            <img src="'.ShowPic().'" class="profile-pic">
        </div>
        <div class="media-body">
            <strong class="media-heading">'.$_SESSION['logged']['name'].'</strong>';
        if($quiz){
          echo '<p>Cuestionario Enviado, para actualizarlo volver a enviarlo.</p>';
        }
        echo '</div>';
        if($quiz)
        {
          echo '<div class="media-right">
          <i class="fa fa-check-square-o fa-2x"></i>
          </div>';
        }
        echo '
        </div>';
      }
echo '
  <form class="form wizard1" role="form" action="'.$form['action'].'#'.$form['callback'].'" method="POST">
        <input type="hidden" name="formid" value="'.$form['id'].'">
        <input type="hidden" name="formtype" value="'.$form['type'].'">
        <div class="form-group response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
        <fieldset>
          <legend class="text pyb">Datos de contacto</legend>';

if(!isset($_SESSION['logged']))
{
echo '  <div class="row">
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
        </div></div>';

      }
       echo' <div class="form-group">
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
              <select class="form-control" name="municipio" id="'.$form['id'].'-municipios" required="requiered">
                <option value="">Municipio ...</option>
              </select>
            </div>
            </div>
          </fieldset>
        <fieldset>
          <legend class="text pyb">Cuestionario de adoptante</legend>
          <div class="form-group">
            <label for="" class="col-md-9 col-xs-8 col-xxs-12 control-label">La familia esta de acuerdo con la adopción?</label>
            <div class="col-md-3 col-xs-4 col-xxs-12">
              <select class="form-control" name="familia" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['familia'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['familia']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['familia']).'</option>';
              }
          echo '
                <option value="">Seleccione ...</option>
                <option value="si">Si</option>
                <option value="talvez">Talvéz</option>
                <option value="nolose">No lo se</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-md-9 col-xs-8 col-xxs-12 control-label">Conoces el reto que es adoptar un pitbull?</label>
            <div class="col-md-3 col-xs-4 col-xxs-12">
              <select class="form-control" name="reto" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['reto'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['reto']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['reto']).'</option>';
              }
          echo '
                <option value="">Seleccione ...</option>
                <option value="si">Si</option>
                <option value="talvez">Talvéz</option>
                <option value="nolose">No lo se</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-md-9 col-xs-8 col-xxs-12 control-label">Estas conciente de la responsabilidad que adquieres?</label>
            <div class="col-md-3 col-xs-4 col-xxs-12">
              <select class="form-control" name="responsabilidad" required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['responsabilidad'])){
                echo '<option value="'.FeedbackValueData($_SESSION['feedback'][$form['id']]['responsabilidad']).'" selected="selected">'.FeedbackValueData($_SESSION['feedback'][$form['id']]['responsabilidad']).'</option>';
              }
          echo '<option value="">Seleccione ...</option>
                <option value="si">Si</option>
                <option value="talvez">Talvéz</option>
                <option value="nolose">No lo se</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
           <div class="form-group">
              <textarea rows="8" class="form-control" name="porque" placeholder="Ahora te invitamos a que escribas un texto de el por qué quieres adoptar." required="requiered">';
              if(isset($_SESSION['feedback'][$form['id']]['porque'])){
                echo FeedbackValueData($_SESSION['feedback'][$form['id']]['porque']);
              }
              echo '</textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-default">Enviar formulario <i class="fa fa-share"></i></button>
            </div>
        </fieldset>
      </form>';

unset($_SESSION['feedback'][$form['id']]);