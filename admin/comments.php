<?
//Comments
echo '<div class="panel panel-default comments">
      <div class="panel-heading navheading">
        <div class="media">
          <div class="media-left">
            <i class="fa fa-commenting fa-5x"></i>          
          </div>
          <div class="media-body"><h2 class="media-heading">Comentarios</h2>
            <ul class="nav nav-tabs hidden-xs">
          		<li role="presentation" class="active"><a href="#" data-target="#comments-recent" role="tab" data-toggle="tab" aria-controls="comments-recent" aria-expanded="true" data-hash="/comments/recent"> <i class="fa fa-star"></i> <span>Nuevos</span></a></li>
         
          		<li role="presentation" class=""><a href="#" data-target="#comments-all" role="tab" data-toggle="tab" aria-controls="comments-all" aria-expanded="false" data-hash="/comments/all"> <i class="fa fa-archive"></i> <span>Todos</span></a></li>
        	</ul>
          </div>
        </div>
        <ul class="nav nav-tabs nav-mobil nav-justified visible-xs">
          <li role="presentation" class="active"><a href="/" data-target="#comments-recent" role="tab" data-toggle="tab" aria-controls="comments-recent" aria-expanded="true" data-hash="/comments/recent"> <i class="fa fa-star"></i> <span>Nuevos</span></a></li>
       
          <li role="presentation" class=""><a href="#" data-target="#comments-all" role="tab" data-toggle="tab" aria-controls="comments-all" aria-expanded="false" data-hash="/comments/all"> <i class="fa fa-archive"></i> <span>Todos</span></a></li>
           
        </ul>
      </div>
      <div class="panel-body">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="comments-recent">';
include 'comments-recent.php';              
echo '    </div>
          <div role="tabpanel" class="tab-pane" id="comments-all">
          </div>
        </div>
      </div>
    </div>';