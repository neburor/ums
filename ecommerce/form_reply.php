<?php
#FormReply

// $FormReply='
// 	<div class="media">
//         <div class="media-left">
//             <img src="'.ShowPic().'" class="profile-pic">
//         </div>
//       	<div class="media-body">
//             <strong class="media-heading">'.$_SESSION['logged']['name'].'</strong>';
    $FormReply='<form class="form" role="form" action="'.$form['action'].'#'.$form['callback'].'" method="POST">
              <input type="hidden" name="formid" value="'.$form['id'].'">
              <input type="hidden" name="formtype" value="'.$form['type'].'">
              <input type="hidden" name="form" value="'.$form['form'].'">
              <input type="hidden" name="to" value="'.$form['to'].'">';

$FormReply.='<div class="input-group">
                  <input name="message" placeholder="Enviar respuesta" class="form-control">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-share"></i></button>
                  </div>
                </div>';
// $FormReply.= '<div class="form-group '.FeedbackClass($_SESSION['feedback'][$form['id']]['comment']).'">';
             
//               if(isset($form['toid']))
//               {
//                 $FormComment.='<label class="toid">'.$form['toname'].' :</label>';
//               }

// $FormReply.=  '<label class="toid">'.$form['toname'].' :</label>
//               <textarea class="form-control" name="contact" placeholder="Escribe tu mensaje ..." minlength="8" maxlength="512" required=""></textarea>
//               '.FeedbackIcon($_SESSION['feedback'][$form['id']]['comment']).'
//               </div>
//               <div class="form-group response">'.Feedback($_SESSION['feedback'][$form['id']]).'</div>
//               <div class="form-group col-xs-12">
//                 <button type="submit" class="btn btn-default"><span>Enviar mensaje</span> <i class="fa fa-share"></i></button>
//               </div>';
$FormReply.='</form>';
// $FormReply.='</div>
//     </div>';


unset($_SESSION['feedback'][$form['id']]);