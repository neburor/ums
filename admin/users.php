<?
//Comments
echo '<div class="panel panel-default">
      <div class="panel-heading navheading">
        <div class="media">
          <div class="media-left">
            <i class="fa fa-users fa-5x"></i>          
          </div>
          <div class="media-body"><h2 class="media-heading">Usuarios</h2>
            <ul class="nav nav-tabs hidden-xs">
          		<li role="presentation" class="active"><a href="#" data-target="#users-resume" role="tab" data-toggle="tab" aria-controls="users-recent" aria-expanded="true" data-hash="/users/resume"> <i class="fa fa-bookmark"></i> <span>Resumen</span></a></li>
        	</ul>
          </div>
        </div>
        <ul class="nav nav-tabs nav-mobil nav-justified visible-xs">
          <li role="presentation" class="active"><a href="#" data-target="#users-resume" role="tab" data-toggle="tab" aria-controls="users-recent" aria-expanded="true" data-hash="/users/resume"> <i class="fa fa-bookmark"></i> <span>Resumen</span></a></li>
        </ul>
      </div>
      <div class="panel-body">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="users-resume">';
include 'users-resume.php';              
echo '    </div>
        </div>
      </div>
    </div>';