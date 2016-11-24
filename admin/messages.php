<?
//Messages
echo '<div class="panel panel-default messages">
      <div class="panel-heading navheading">
        <div class="media">
          <div class="media-left">
            <i class="fa fa-envelope fa-5x"></i>          
          </div>
          <div class="media-body"><h2 class="media-heading">Mensajes</h2>
            <ul class="nav nav-tabs hidden-xs">
          		<li role="presentation" class="active"><a href="#" data-target="#messages-recent" role="tab" data-toggle="tab" aria-controls="messages-recent" aria-expanded="true" data-hash="/messages/recent"> <i class="fa fa-star"></i> <span>Nuevos</span></a></li>
         
          		<li role="presentation" class=""><a href="#" data-target="#messages-all" role="tab" data-toggle="tab" aria-controls="messages-all" aria-expanded="false" data-hash="/messages/all"> <i class="fa fa-archive"></i> <span>Todos</span></a></li>
        	</ul>
          </div>
        </div>
        <ul class="nav nav-tabs nav-mobil nav-justified visible-xs">
          <li role="presentation" class="active"><a href="/" data-target="#messages-recent" role="tab" data-toggle="tab" aria-controls="messages-recent" aria-expanded="true" data-hash="/messages/recent"> <i class="fa fa-star"></i> <span>Nuevos</span></a></li>
       
          <li role="presentation" class=""><a href="#" data-target="#messages-all" role="tab" data-toggle="tab" aria-controls="messages-all" aria-expanded="false" data-hash="/messages/all"> <i class="fa fa-archive"></i> <span>Todos</span></a></li>
           
        </ul>
      </div>
      <div class="panel-body">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="messages-recent">';
include 'messages-recent.php';              
echo '    </div>
          <div role="tabpanel" class="tab-pane" id="messages-all">
          </div>
        </div>
      </div>
    </div>';