<div class="profile page">
    <div class="cover background">
      <?php
        echo '<img src="'.$_SESSION['profile']['cover']['source'].'"';
        if(isset($_SESSION['profile']['cover']['offset_x']) || isset($_SESSION['profile']['cover']['offset_y']))
        {
          echo ' style="';
            if(isset($_SESSION['profile']['cover']['offset_y']))
            {
              echo 'margin-top: -'.$_SESSION['profile']['cover']['offset_y'].'px;';
            }
            if(isset($_SESSION['profile']['cover']['offset_x']))
            {
              echo 'margin-left: -'.$_SESSION['profile']['cover']['offset_x'].'px;';
            }
          echo '"';
        }
        echo '>';

      ?>
    </div>
  
    <div class="container cover heading">
      <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="media">
          <div class="media-left">
            <img src="<?php echo $_SESSION['profile']['pic'] ?>" class="img-circle">
          </div>
          <div class="media-body"><h1 class="media-heading"><?php echo $_SESSION['profile']['name']?></h1>
          <ul class="nav nav-tabs hidden-xs">
          <li role="presentation" class="active"><a href="?tabpanel=inicio" data-target="#profile-home" role="tab" data-toggle="tab" aria-controls="profile-home" aria-expanded="false"> <i class="fa fa-bookmark"></i> <span>Inicio</span></a></li>
          <li role="presentation"><a href="?tabpanel=mensajes" data-target="#profile-messages" role="tab" data-toggle="tab" aria-controls="profile-messages" aria-expanded="false"> <i class="fa fa-envelope"></i> <span>Mensajes</span></a></li>
          <li role="presentation"><a href="?tabpanel=comentarios" data-target="#profile-comments" role="tab" data-toggle="tab" aria-controls="profile-comments" aria-expanded="false"> <i class="fa fa-commenting"></i> <span>Comentarios</span></a></li>
           <li role="presentation"><a href="?tabpanel=preferencias" data-target="#profile-config" role="tab" data-toggle="tab" aria-controls="profile-config" aria-expanded="false"> <i class="fa fa-cog"></i> <span>Preferencias</span></a></li>
        </ul>
          </div>
        </div>
        <ul class="nav nav-tabs nav-mobile nav-justified visible-xs">
          <li role="presentation" class="active"><a href="?tabpanel=inicio" data-target="#profile-home" role="tab" data-toggle="tab" aria-controls="profile-home" aria-expanded="false"> <i class="fa fa-bookmark"></i> <span>Inicio</span></a></li>
          <li role="presentation"><a href="?tabpanel=mensajes" data-target="#profile-messages" role="tab" data-toggle="tab" aria-controls="profile-messages" aria-expanded="false"> <i class="fa fa-envelope"></i> <span>Mensajes</span></a></li>
          <li role="presentation"><a href="?tabpanel=comentarios" data-target="#profile-comments" role="tab" data-toggle="tab" aria-controls="profile-comments" aria-expanded="false"> <i class="fa fa-commenting"></i> <span>Comentarios</span></a></li>
          <li role="presentation"><a href="?tabpanel=preferencias" data-target="#profile-config" role="tab" data-toggle="tab" aria-controls="profile-config" aria-expanded="false"> <i class="fa fa-cog"></i> <span>Preferencias</span></a></li>
        </ul>
      </div>
      <div class="panel-body">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active in" id="profile-home">
          </div>

          <div role="tabpanel" class="tab-pane" id="profile-messages">

          </div>
          <div role="tabpanel" class="tab-pane" id="profile-comments">

          </div>
          <div role="tabpanel" class="tab-pane" id="profile-config">

          </div>

        </div>
      </div>
    </div>
    </div>
</div>
</div>