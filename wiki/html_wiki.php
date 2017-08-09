<?php
#Wiki


if(isset($_GET['wiki']) && isset($_SESSION['logged'])) {
  if($_GET['wiki']=='add')
  {
    $html_wiki = $dataWiki['content']. '<div class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_wiki-edit">
          <form class="form" role="form" method="post" id="add">
            <div class="form-group">
              <textarea class="form-control" id="article_add"><h2>Subtitulo</h2><p>Escribir ...</p></textarea>
            </div>
          </form>
          </div>
        </div>';

  }
  elseif($_GET['wiki']=='history')
  {
    echo '<div class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_wiki-history">
          <div id="history">
          <h2>Hisotrial</h2>
          </div>
          </div>
        </div>';
  }
  else
  {
    echo '<div class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_wiki-edit">
          <form class="form" role="form" method="post" id="edit">
          <input type="hidden" name="old" value="'.$dataWiki['id'].'">
            <div class="form-group">
              <textarea class="form-control" id="article_edit">'.$dataWiki['content'].'</textarea>
            </div>
          </form>
          </div>
        </div>';
  }

  
}elseif (isset($_GET['wiki']) && !isset($_SESSION['logged'])) {

  if($_GET['wiki']=='history')
  {
    echo '<div class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_wiki-history">
          <div id="history">
          <h2>Hisotrial</h2>
          </div>
          </div>
        </div>';
  }
  else
  {

  if(isset($_GET['tab']))
  {
    $tab=$_GET['tab'];
  }
  else
  {
    $tab='tab_wiki-login';
  }

  echo '<div ums class="ums" id="edit"><ul class="nav nav-tabs" role="tablist">
    <li role="presentation" ';
              if($tab=='tab_wiki-login')
              {
                echo 'class="active"';
              }
              echo '><a href="?tab=tab_wiki-login#tab_wiki-login" aria-controls="tab_wiki-login" role="tab" data-toggle="tab">Iniciar Sesion</a></li>
    <li role="presentation" ';
              if($tab=='tab_wiki-signup')
              {
                echo 'tab_wiki-signup"';
              }
              echo '><a href="?tab=tab_wiki-signup#tab_wiki-signup" aria-controls="tab_wiki-signup" role="tab" data-toggle="tab">Registrarse</a></li><li role="presentation" class="pull-right"><a href="?tab=tab_wiki-recovery#tab_wiki-recovery" data-target="#tab_wiki-recovery" data-hash="/ums/tab/tab_wiki-recovery" role="tab" data-toggle="tab" aria-controls="tab_wiki-recovery" aria-expanded="false"></a></li></ul>';

  echo '<div class="tab-content">';
    echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_wiki-login')
              {
                echo ' fade active in';
              }
              echo '" id="tab_wiki-login">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_wiki-login',
      'type'  =>'login',
      'action'=>'?tab_wiki-login',
      'callback'=> array('error'=>'/ums/tab/tab_wiki-login','success'=>'/ums/tab/tab_wiki-edit'),
      'recovery'=>'<a  href="?tab=tab_wiki-recovery#tab_wiki-recovery" data-target="#tab_wiki-recovery" data-hash="/ums/tab/tab_wiki-recovery" class="pull-right">Recuperar <i class="fa fa-lock"></i></a>'
        );
include 'ums/login/html_login-tab.php';
  echo '</div>';
  echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_wiki-signup')
              {
                echo ' fade active in';
              }
              echo '" id="tab_wiki-signup">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_wiki-signup',
      'type'  =>'signup',
      'action'=>'?tab_wiki-signup',
      'callback'=>array('error'=>'/ums/tab/tab_wiki-signup','success'=>'/ums/tab/tab_wiki-edit')
        );
include 'ums/login/html_signup-tab.php';
  echo '</div>';
  echo '<div role="tabpanel" class="tab-pane';
              if($tab=='tab_comment-recover')
              {
                echo ' fade active in';
              }
              echo '" id="tab_wiki-recovery">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_wiki-recovery',
      'type'  =>'recovery',
      'action'=>'?tab_wiki-recovery',
      'callback'=>array('error'=>'/ums/tab/tab_wiki-recovery','success'=>'/ums/tab/tab_wiki-recovery')
        );
include 'ums/login/html_recovery-tab.php';
  echo '</div></div>';
}
}
else{
  $html_wiki= $dataWiki['content'];
}