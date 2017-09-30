<?
//Contents
echo '<div class="panel panel-default contents">
      <div class="panel-heading navheading">
        <div class="media">
          <div class="media-left">
            <i class="fa fa-file-text fa-5x"></i>          
          </div>
          <div class="media-body"><h2 class="media-heading">Contenidos</h2>
            <ul class="nav nav-tabs hidden-xs">
          		<li role="presentation" class="active"><a href="#" data-target="#contents-resume" role="tab" data-toggle="tab" aria-controls="contents-resume" aria-expanded="true" data-hash="/contents/resume"> <i class="fa fa-bookmark"></i> <span>Resumen</span></a></li>
              <li role="presentation"><a href="#" data-target="#contents-wiki" role="tab" data-toggle="tab" aria-controls="contents-wiki" aria-expanded="true" data-hash="/contents/wiki"> <i class="fa fa-files-o"></i> <span>Wiki</span></a></li>
        	</ul>
          </div>
        </div>
        <ul class="nav nav-tabs nav-mobil nav-justified visible-xs">
          <li role="presentation" class="active"><a href="#" data-target="#contents-resume" role="tab" data-toggle="tab" aria-controls="contents-resume" aria-expanded="true" data-hash="/contents/resume"> <i class="fa fa-bookmark"></i> <span>Resumen</span></a></li>
          <li role="presentation"><a href="#" data-target="#contents-wiki" role="tab" data-toggle="tab" aria-controls="contents-wiki" aria-expanded="true" data-hash="/contents/wiki"> <i class="fa fa-files-o"></i> <span>Wiki</span></a></li>
        </ul>
      </div>
      <div class="panel-body">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="contents-resume">';
include 'contents-resume.php';              
echo '    </div>
          <div role="tabpanel" class="tab-pane" id="contents-wiki">';
include 'contents-wiki.php';              
echo '    </div>
        </div>
      </div>
    </div>';