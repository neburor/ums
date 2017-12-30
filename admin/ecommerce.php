<?
//Ecommerce
echo '<div class="panel panel-default ecommerce">
      <div class="panel-heading navheading">
        <div class="media">
          <div class="media-left">
            <i class="fa fa-newspaper-o fa-5x"></i>          
          </div>
          <div class="media-body"><h2 class="media-heading">Ecommerce</h2>
            <ul class="nav nav-tabs hidden-xs">
          		<li role="presentation" class="active"><a href="#" data-target="#ecommerce-recent" role="tab" data-toggle="tab" aria-controls="ecommerce-recent" aria-expanded="true" data-hash="/ecommerce/recent"> <i class="fa fa-star"></i> <span>Nuevos</span></a></li>
         
          		<li role="presentation" class=""><a href="#" data-target="#ecommerce-all" role="tab" data-toggle="tab" aria-controls="ecommerce-all" aria-expanded="false" data-hash="/ecommerce/all"> <i class="fa fa-archive"></i> <span>Todos</span></a></li>
        	</ul>
          </div>
        </div>
        <ul class="nav nav-tabs nav-mobil nav-justified visible-xs">
          <li role="presentation" class="active"><a href="/" data-target="#ecommerce-recent" role="tab" data-toggle="tab" aria-controls="ecommerce-recent" aria-expanded="true" data-hash="/ecommerce/recent"> <i class="fa fa-star"></i> <span>Nuevos</span></a></li>
       
          <li role="presentation" class=""><a href="#" data-target="#ecommerce-all" role="tab" data-toggle="tab" aria-controls="ecommerce-all" aria-expanded="false" data-hash="/ecommerce/all"> <i class="fa fa-archive"></i> <span>Todos</span></a></li>
           
        </ul>
      </div>
      <div class="panel-body">
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="ecommerce-recent">';
include 'ecommerce-recent.php';              
echo '    </div>
          <div role="tabpanel" class="tab-pane" id="ecommerce-all">
          </div>
        </div>
      </div>
    </div>';