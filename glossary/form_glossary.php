<?php
#FormContact
$feedback=array('show'=>'warning',
                'status'=>$_SESSION['feedback'][$form['id']]['status']);

if(isset($_SESSION['logged']))
{
echo '
	<div class="media">
        <div class="media-left">
            <img src="'.ShowPic().'" class="profile-pic">
        </div>
      	<div class="media-body">
            <strong class="media-heading">'.$_SESSION['logged']['name'].'</strong>
            <form class="form" role="form" action="'.$form['action'].'#'.$form['callback'].'" method="POST">
              <input type="hidden" name="formid" value="'.$form['id'].'">
              <input type="hidden" name="formtype" value="'.$form['type'].'">
              <input type="hidden" name="term" value="'.$data['term'].'">
              <input type="hidden" name="display" value="'.$data['display'].'">
             
              <div class="form-group col-xs-12'.FeedbackClass($_SESSION['feedback'][$form['id']]['description'],$feedback).'">
              <label>Descripción corta</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                <textarea class="form-control" name="description" placeholder="Descripción corta ..." minlength="8" maxlength="512" rows="5" required="">';
              if(isset($_SESSION['feedback'][$form['id']]['description'])){
                echo FeedbackValueData($_SESSION['feedback'][$form['id']]['description'],$feedback);
              }else{
                echo $data['description'];
              }

            echo '</textarea>
                '.FeedbackIcon($_SESSION['feedback'][$form['id']]['definitions'],$feedback).'
                </div>
              </div>
              <div class="form-group col-xs-12'.FeedbackClass($_SESSION['feedback'][$form['id']]['definitions'],$feedback).'">
              <label>Definiciones (separadas por doble dos puntos | :: )</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                <textarea class="form-control" name="definitions" placeholder="Definiciones ::..." minlength="8" rows="10">';
              if(isset($_SESSION['feedback'][$form['id']]['definitions'])){
                echo FeedbackValueData($_SESSION['feedback'][$form['id']]['definitions'],$feedback);
              }else{
                echo $data['def'];
              }

            echo '</textarea>
                '.FeedbackIcon($_SESSION['feedback'][$form['id']]['definitions'],$feedback).'
                </div>
              </div>
               <div class="form-group col-xs-12'.FeedbackClass($_SESSION['feedback'][$form['id']]['synonyms'],$feedback).'">
               <label>Sinónimos (separados por coma | , )</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-edit"></i></span>
            <input type="text" class="form-control" name="synonyms" placeholder="Sinónimos, ...," ';
            if (isset($_SESSION['feedback'][$form['id']]['synonyms'])) {
              echo FeedbackValue($_SESSION['feedback'][$form['id']]['synonyms'],$feedback);
            }else{
              echo ' value="'.$data['syn'].'"';
            }
    echo '>'.FeedbackIcon($_SESSION['feedback'][$form['id']]['synonyms'],$feedback).'</div>
        </div>
              <div class="form-group response col-xs-12">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
              <div class="form-group col-xs-12">
                <button type="submit" class="btn btn-default"><i class="fa fa-share"></i> Enviar término</button>
              </div>
            </form>
        </div>
    </div>
';
}
unset($_SESSION['feedback'][$form['id']]);