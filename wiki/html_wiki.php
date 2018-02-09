<?php
#Wiki
if($data['group']=='')
{
  $functions['wiki']=true;
}else{
  $functions['wiki']=false;
  foreach (explode(',', $data['group']) as $key => $value) {
      if (strpos($_SESSION['logged']['group'], $value) !== false) {
        $functions['wiki']=true;
    }
  }
}
if(isset($_GET['wiki']) && $_GET['wiki']=='history')
{
  $dataWikihistory = SQLselect(
                array(
                  'table'=>'content_wiki',
                  'query'=>'SELECT
                a.`id`,
                a.`datetime`,
                a.`url`,
                a.`account`,
                IFNULL(accounts.`name`, "'.ADMINNAME.'") AS `from_name`,
                IFNULL(accounts_sn.`pic`, "'.ADMINPIC.'") AS `from_pic`,
                IFNULL(b.`content`, "") AS `old`,
                a.`content` AS `new`
                FROM `content_wiki` a
                    LEFT OUTER JOIN `content_wiki` b 
                    ON a.`old` = b.`id`
                    LEFT JOIN `accounts`
                    ON a.`account` = accounts.`id`
                    LEFT JOIN `accounts_sn`
                    ON a.`account` = accounts_sn.`account` 
                    AND accounts.`pic` = accounts_sn.`network`
                WHERE a.`url` = "'.$url.'"
                AND a.`status` = "1"
                ORDER BY a.`datetime` DESC')
                );
    require_once 'Diff.php';
    require_once 'Diff/Renderer/Html/Changes.php';
    $str_search=array("<br>","<p>","<h2>","</p>","</h2>","<hr>","<blockquote>","</blockquote>","><");
    $str_replace=array("\n<br>\n","<p>\n","<h2>\n","\n</p>","\n</h2>","\n<hr>\n","<blockquote>\n","\n</blockquote>",">\n<");
    $html_wiki = '<div class="ums"><div class="panel-group" id="history" role="tablist" aria-multiselectable="true">';
    foreach ($dataWikihistory as $edit => $value) 
    {
      $a = explode("\n", str_replace($str_search,$str_replace,$value['old']));
      $b = explode("\n", str_replace($str_search,$str_replace,$value['new']));
      $diff = new Diff($a, $b, array());

      $changes = new Diff_Renderer_Html_Changes;
      $date=Interval($value['datetime']);
      $html_wiki.= '<div class="panel panel-default">
    
        <a class="panel-heading" role="button" data-toggle="collapse" data-parent="#history" href="#history-'.$value['id'].'" aria-expanded="true" aria-controls="history-'.$value['id'].'">
          <div class="media">
                        <div class="media-left">
                           <img class="media-object profile-pic" alt="'.$value['from_name'].'" src="'.$value['from_pic'].'">
                         </div>
                         <div class="media-body">
                           <span class="media-heading">
                             <b>'.$value['from_name'].'</b> 
                             <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small>
                           </span>
                         </div>
                         <div class="media-right"><i class="fa fa-chevron-right"></i></div>
                        </div>
        </a>
    
    <div id="history-'.$value['id'].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      '.$diff->render($changes).'
      </div>
    </div>
  </div>';
    }
    $html_wiki.= '</div></div>';
}
elseif(isset($_GET['wiki']) && isset($_SESSION['logged'])) {
  if($functions['wiki']==true)
  {
    $dataWikiuser =SQLselect(
          array(
                  'table'=>'content_wiki',
                  'limit'=> 'LIMIT 1',
                  'query'=>"SELECT * 
                  FROM `content_wiki` 
                  WHERE `datetime` = (
                    SELECT MAX(`datetime`) FROM `content_wiki` 
                    WHERE `url` = '".$url."' AND `status` = '0' AND `account` = '".$_SESSION['logged']['id']."')
                  AND `url` = '".$url."' AND `status` = '0' AND `account` = '".$_SESSION['logged']['id']."'
                  ")
        );
  if($dataWikiuser)
  {
    $dataWiki['content']=$dataWikiuser['content'];
  }
  if($_GET['wiki']=='add')
  {
    $html_wiki = $dataWiki['content']. '<div ums class="ums tab-content" id="add">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_wiki-edit">';
    if($wiki['warning'])
    {
      $html_wiki.=$wiki['warning'];
    }
    $html_wiki.='<div class="progress" id="progress-article_add">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0px;">100%</div>
          </div>
          <form class="form" role="form" method="post">
            <div class="form-group">
              <textarea class="form-control" id="article_add"><h2>Subtitulo</h2><p>Escribir ...</p></textarea>
            </div>
          </form>
          </div>
        </div>';

  }
  elseif ($_GET['wiki']=='preview') 
  {
    if($dataWikiuser['content'])
    {
      
    preg_match_all('|<h[^456r>]+>(.*)</h[^>]+>|iU', $dataWikiuser['content'], $matches,PREG_SET_ORDER);
    preg_match_all('|<img class="cke_iframe" (.*)">|iU', $dataWiki['content'], $iframes,PREG_SET_ORDER);
  
  foreach ($iframes as $key => $value) {
  preg_match_all('|data-cke-realelement="(.*)" |iU', $value[1], $iframe,PREG_SET_ORDER);
  $dataWikiuser['content']=str_replace($value[0], urldecode($iframe[0][1]),$dataWikiuser['content']);
  }
  if($functions['glossary'])
  {
    $glossary=SearchRef($dataWikiuser['content']);
    $dataWikiuser['content']=$glossary['content'];
  }
  if($functions['polls'])
  {
    $polls=SearchPolls($dataWikiuser['content']);
    $dataWikiuser['content']=$polls['content'];
  }
  
    $html_wiki='<div id="preview">'.$dataWikiuser['content'];
  if($functions['glossary'])
  {
    $html_wiki.=$glossary['glossary'];
  }
     
    }
    else
    {
      $html_wiki = '<div ums class="ums" id="preview">
                      <div class="media">
                        <div class="media-body text-center">
                          <i class="fa fa-edit fa-4x"></i>
                          <b class="media-heading">NO HAY CAMBIOS REALIZADOS</b>
                        </div> 
                      </div>
                    ';
    }
    $html_wiki.='</div>';
  }
  else
  {
    $html_wiki = '<div ums class="ums tab-content" id="edit">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_wiki-edit">';
    if($wiki['warning'])
    {
      $html_wiki.=$wiki['warning'];
    }
    $html_wiki.='<div class="progress" id="progress-article_edit">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0px;">100%</div>
          </div>
          <form class="form" role="form" method="post" >
          <input type="hidden" name="old" value="'.$dataWiki['id'].'">
            <div class="form-group">
              <textarea class="form-control" id="article_edit">'.$dataWiki['content'].'</textarea>
            </div>
          </form>
          </div>
        </div>';
    }
  }else{
    $html_wiki = '<div ums class="ums" id="preview">
                      <div class="media">
                        <div class="media-body text-center">
                          <i class="fa fa-warning fa-4x"></i>
                          <b class="media-heading">Sin permisos para editar</b>
                        </div> 
                      </div>
                      </div>
                    ';
  }
  }elseif (isset($_GET['wiki']) && !isset($_SESSION['logged'])) {

  if(isset($_GET['tab']))
  {
    $tab=$_GET['tab'];
  }
  else
  {
    $tab='tab_wiki-login';
  }

  echo '<div ums class="ums" id="edit">
          <div class="panel panel-default">
            <div class="panel-heading navheading">
            <i class="fa fa-edit fa-2x"></i> <b>Editar</b>
              <ul class="nav nav-tabs" role="tablist">
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

    echo '  </div>
            <div class="panel-body">
              <div class="tab-content">';
    echo '      <div role="tabpanel" class="tab-pane';
              if($tab=='tab_wiki-login')
              {
                echo ' fade active in';
              }
              echo '" id="tab_wiki-login">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_wiki-login',
      'type'  =>'login',
      'action'=>'?wiki=edit&tab=tab_wiki-login',
      'callback'=> array('error'=>'/ums/tab/tab_wiki-login','success'=>'/ums/tab/tab_wiki-edit'),
      'recovery'=>'<a  href="?wiki=edit&tab=tab_wiki-recovery#tab_wiki-recovery" data-target="#tab_wiki-recovery" data-hash="/ums/tab/tab_wiki-recovery" class="pull-right">Recuperar <i class="fa fa-lock"></i></a>',
      'connect'=>'&wiki=edit'
        );
include 'ums/login/html_login-tab.php';
  echo '        </div>';
  echo '        <div role="tabpanel" class="tab-pane';
              if($tab=='tab_wiki-signup')
              {
                echo ' fade active in';
              }
              echo '" id="tab_wiki-signup">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_wiki-signup',
      'type'  =>'signup',
      'action'=>'?wiki=edit&tab=tab_wiki-signup',
      'callback'=>array('error'=>'/ums/tab/tab_wiki-signup','success'=>'/ums/tab/tab_wiki-edit'),
      'connect'=>'&wiki=edit'
        );
include 'ums/login/html_signup-tab.php';
  echo '          </div>';
  echo '          <div role="tabpanel" class="tab-pane';
              if($tab=='tab_comment-recover')
              {
                echo ' fade active in';
              }
              echo '" id="tab_wiki-recovery">';
$div=array('intro'=>'col-sm-5','form'=>'col-sm-7');
$form=array(
      'id'    =>'tab_wiki-recovery',
      'type'  =>'recovery',
      'action'=>'?wiki=edit&tab=tab_wiki-recovery',
      'callback'=>array('error'=>'/ums/tab/tab_wiki-recovery','success'=>'/ums/tab/tab_wiki-recovery')
        );
include 'ums/login/html_recovery-tab.php';
  echo '          </div>
                </div>
                </div>
              </div>
            </div>';

}else{
  $html_wiki= $dataWiki['content'];
  preg_match_all('|<img class="cke_iframe" (.*)">|iU', $html_wiki, $iframes,PREG_SET_ORDER);
  
  foreach ($iframes as $key => $value) {
  preg_match_all('|data-cke-realelement="(.*)" |iU', $value[1], $iframe,PREG_SET_ORDER);
  $html_wiki=str_replace($value[0], urldecode($iframe[0][1]),$html_wiki);
  }
  if($functions['glossary'])
  {
    $glossary=SearchRef($html_wiki);
    $html_wiki=$glossary['content'];
    $html_wiki.=$glossary['glossary'];
  }
  if($functions['polls'])
  {
    $polls=SearchPolls($html_wiki);
    $html_wiki=$polls['content'];
  }
}


