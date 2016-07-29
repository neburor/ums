<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header pull-left">
      <a class="navbar-brand" href="http://ums.hostingmex.com.mx/"><img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png" alt="Administracion de usuarios Web"></a>
    </div>
    <ul class="nav navbar-nav pull-right">
      <li><a href="?logout" class=""><i class="fa fa-power-off"></i> <span class="">Salir</span></a></li>
    </ul>
  </div><!-- /.container-fluid -->
</nav>

    <div class="cover-bg">
      <?php
      if($_SESSION['profile']['cover']=='facebook' || $_SESSION['profile']['cover']=='twitter')
      {
        echo '<img src="'.$_SESSION['profile']['networks'][$_SESSION['profile']['cover']]['cover'].'">';
      }
      elseif($_SESSION['profile']['cover']=='local')
      {
        echo '<img src="images/cover/cover_'.$_SESSION['profile']['id'].'.jpg">';
      }
      ?>
    </div>
  
    <div class="container cover-cont">
      <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading navheading">
        <div class="media cover-title">
          <div class="media-left">
            <?php
            if($_SESSION['profile']['pic']=='facebook' || $_SESSION['profile']['pic']=='twitter')
            {
              if($_SESSION['profile']['pic']=='twitter')
              {
                $_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic']=str_replace('_normal', '_bigger', $_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic']);
              }
              echo '<img src="'.$_SESSION['profile']['networks'][$_SESSION['profile']['pic']]['pic'].'" class="img-circle">';
            }
            elseif($_SESSION['profile']['pic']=='local')
            {
              echo '<img src="images/pic/pic_'.$_SESSION['profile']['id'].'.jpg" class="img-circle">';
            }
            ?>
            
          </div>
          <div class="media-body"><h1 class="media-heading"><?php echo $_SESSION['profile']['name']?></h1>
          <?php
          $panel_tabs=array(
              'inicio' => '', 
              'mensajes' => '', 
              'comentarios' => '', 
              'preferencias' => ''
              );
          
          if(isset($_GET['tabpanel']))
          {

            foreach ($panel_tabs as $key => $value) {
            if($key==$_GET['tabpanel'])
              {
                $panel_tabs[$key]='active';
              }
            }
          }
          else 
          {
            $panel_tabs['inicio']='active';
          }

          ?>
          <ul class="nav nav-tabs cover-nav hidden-xs">
          <li role="presentation" class="<?php echo $panel_tabs['inicio'] ?>"><a href="?tabpanel=inicio" data-target="#profile-home" role="tab" data-toggle="tab" aria-controls="profile-home" aria-expanded="false"> <i class="fa fa-bookmark"></i> <span>Inicio</span></a></li>
          <li role="presentation" class="<?php echo $panel_tabs['mensajes'] ?>"><a href="?tabpanel=mensajes" data-target="#profile-messages" role="tab" data-toggle="tab" aria-controls="profile-messages" aria-expanded="false"> <i class="fa fa-envelope"></i> <span>Mensajes</span></a></li>
          <li role="presentation" class="<?php echo $panel_tabs['comentarios'] ?>"><a href="?tabpanel=comentarios" data-target="#profile-comments" role="tab" data-toggle="tab" aria-controls="profile-comments" aria-expanded="false"> <i class="fa fa-commenting"></i> <span>Comentarios</span></a></li>
           <li role="presentation" class="<?php echo $panel_tabs['preferencias'] ?>"><a href="?tabpanel=preferencias" data-target="#profile-config" role="tab" data-toggle="tab" aria-controls="profile-config" aria-expanded="false"> <i class="fa fa-cog"></i> <span>Preferencias</span></a></li>
        </ul>
          </div>
        </div>
        <ul class="nav nav-tabs cover-nav-mobil nav-justified visible-xs">
          <li role="presentation" class="<?php echo $panel_tabs['inicio'] ?>"><a href="?tabpanel=inicio" data-target="#profile-home" role="tab" data-toggle="tab" aria-controls="profile-home" aria-expanded="false"> <i class="fa fa-bookmark"></i> <span>Inicio</span></a></li>
          <li role="presentation" class="<?php echo $panel_tabs['mensajes'] ?>"><a href="?tabpanel=mensajes" data-target="#profile-messages" role="tab" data-toggle="tab" aria-controls="profile-messages" aria-expanded="false"> <i class="fa fa-envelope"></i> <span>Mensajes</span></a></li>
          <li role="presentation" class="<?php echo $panel_tabs['comentarios'] ?>"><a href="?tabpanel=comentarios" data-target="#profile-comments" role="tab" data-toggle="tab" aria-controls="profile-comments" aria-expanded="false"> <i class="fa fa-commenting"></i> <span>Comentarios</span></a></li>
           <li role="presentation" class="<?php echo $panel_tabs['preferencias'] ?>"><a href="?tabpanel=preferencias" data-target="#profile-config" role="tab" data-toggle="tab" aria-controls="profile-config" aria-expanded="false"> <i class="fa fa-cog"></i> <span>Preferencias</span></a></li>
        </ul>
      </div>
      <div class="panel-body">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane <?php echo $panel_tabs[''] ?>" id="profile-home">
          </div>

          <div role="tabpanel" class="tab-pane <?php echo $panel_tabs['mensajes'] ?>" id="profile-messages">
<?php
include 'messages/user-messages.php';
?>
          </div>
          <div role="tabpanel" class="tab-pane <?php echo $panel_tabs['comentarios'] ?>" id="profile-comments">
<?php
include 'comments/user-comments.php';
?>
          </div>
          <div role="tabpanel" class="tab-pane <?php echo $panel_tabs['preferencias'] ?>" id="profile-config">
<?php
include 'user-settings.php';
?>
          </div>

        </div>
      </div>
    </div>
    </div>
</div>