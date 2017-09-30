<?
//Comments
echo '<div class="panel panel-default">
      <div class="panel-heading navheading">
        <div class="media">
          <div class="media-left">
            <i class="fa fa-envelope-square fa-5x"></i>          
          </div>
          <div class="media-body"><h2 class="media-heading">Correos</h2>
            <ul class="nav nav-tabs hidden-xs">
          		<li role="presentation" class="active"><a href="#" data-target="#emails-resume" role="tab" data-toggle="tab" aria-controls="emails-recent" aria-expanded="true" data-hash="/emails/resume"> <i class="fa fa-bookmark"></i> <span>Resumen</span></a></li>
        	</ul>
          </div>
        </div>
        <ul class="nav nav-tabs nav-mobil nav-justified visible-xs">
          <li role="presentation" class="active"><a href="#" data-target="#emails-resume" role="tab" data-toggle="tab" aria-controls="emails-recent" aria-expanded="true" data-hash="/emails/resume"> <i class="fa fa-bookmark"></i> <span>Resumen</span></a></li>
        </ul>
      </div>
      <div class="panel-body">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="emails-resume">';
include 'emails-resume.php';              
echo '    </div>
        </div>
      </div>
    </div>';