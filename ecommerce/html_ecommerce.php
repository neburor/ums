<?php
#HTML ecommerce
if(isset($_GET['id'])){
	if(isset($_GET['edit']) && $post['account']==$_SESSION['logged']['id']){
		$form=array(
      		'id'    =>'form_ecommerce-edit',
      		'type'  =>'ecommerce',
      		'action'=>'',
      		'callback'=> 'form_ecommerce-edit'
    	);
		echo '<div class="ums col-md-8 col-xs-12 col-md-offset-2 xxs-nopadding" id="form_ecommerce-edit">';

		if(!isset($_SESSION['feedback'][$form['id']])){
			$_SESSION['feedback'][$form['id']]['title']['value']=$post['title'];
			$_SESSION['feedback'][$form['id']]['title']['status']='valid';
			$_SESSION['feedback'][$form['id']]['ec_description']['value']=$post['description'];
			$_SESSION['feedback'][$form['id']]['ec_description']['status']='valid';
		}
		include 'ums/ecommerce/form_edit.php';
		echo '</div>';
  	}else{

    	if($images=json_decode($post['images'], true)){
      		echo '<div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
        		<div id="images-carousel" class="carousel slide carousel-images" data-ride="carousel">
        		<div class="carousel-inner" role="listbox">';
      		foreach ($images['list'] as $key => $value) {
            if($value['status']){
            	echo '<div class="item';
            	if(!$x){$x=1; echo ' active';}
            	echo '">
            	<img src="'.$images['dir'].$value['name'].'_thumbnail.jpg" class="img-thumbnail center-block">
            	</div>';
            }
         	}
      		echo '
          	<ol class="carousel-indicators">';
            $to=0;
          	foreach ($images['list'] as $key => $value) {
              if($value['status']){
            	echo '<li data-target="#images-carousel" data-slide-to="'.$to.'"';
            	if(!$y){$y=1; echo ' class="active"';}
            	echo '></li>';
              $to++;
              }
          	}
      		echo '</ol></div></div></div>';
      		echo $post['description'];
    	}else{
      		echo $post['description'];
    	}
  	}
}
elseif(isset($_GET['post']))
{
  $form=array(
      'id'    =>'form_ecommerce-post',
      'type'  =>'ecommerce',
      'action'=>'',
      'callback'=> 'form_ecommerce-post'
    );
  echo '<div class="ums col-md-8 col-xs-12 col-md-offset-2 xxs-nopadding" id="form_ecommerce-post">
        <h2>Publicar en '.$_GET['cat'].'</h2>';
  include 'ums/ecommerce/form_post.php';
  echo '</div>';
}else {
    if (isset($_GET['p']) && !isset($_GET['search'])) {

        $start = 6 * ($_GET['p'] - 1);
        $list = SQLselect(
            array(
                'table' => 'ecommerce',
                'query' => "SELECT 
                * 
                FROM `ecommerce` 
                WHERE `status` = '1'
                AND `domain` = '" . UMSDOMAIN . "' 
                ORDER BY `id` DESC 
                LIMIT " . $start . ",6"
            )
        );

    }elseif(isset($_GET['search'])){
        if(!isset($_GET['p'])){ $_GET['p']=1;}
        $start = 6 * ($_GET['p'] - 1);
        $list = SQLselect(
            array(
                'table' => 'ecommerce',
                'query' => "SELECT 
                * 
                FROM `ecommerce` 
                WHERE `status` = '1'
                AND `domain` = '" . UMSDOMAIN . "' 
                AND `location` LIKE '%". $_GET['search'] ."%'
                ORDER BY `id` DESC 
                LIMIT " . $start . ",6"
            )
        );
    }

    echo '<div class="ums ecommerce result"><ul class="list-group">';
    foreach ($list as $key => $data) {
        $date = Interval($data['datetime']);
        $location = json_decode($data['location'], true);
        $images = json_decode($data['images'], true);
        $imgs = 0;
        foreach ($images['list'] as $key1 => $data1) {
            if ($data1['status'] == 1) {
                $imgs++;
                if ($imgs == 1) {
                    $imgsrc = $images['dir'] . $data1['name'] . '_thumbnail.jpg';
                }
            }

        }

        echo ' <li class="list-group-item">
                <div class="container-fluid nopadding">
                    <div class="col-xxs-12 col-xs-4 nopadding">
                        ';
        if ($imgs > 1) {
            echo '<span class="label label-default">' . $imgs . ' fotos</span>';
        }
        echo '<a href="' . $ecommerce['path'] . 'pub_' . $data['id'] . '.html">
                        <img src="' . $imgsrc . '" class="img-thumbnail center-block">
                        </a>
                        </div>
                    <div class="col-xxs-12 col-xs-8">
                        <h3>' . $data['title'] . '</h3>
                         <small class="pull-right">Hace ' . $date[0] . ' ' . $date[1] . '</small>
                         <span class="media-heading"><strong><i class="fa fa-map-marker"></i>';
        if ($location['county']) {
            echo ' ' . ucfirst($location['county']) . ',';
        }
        if ($location['state']) {
            echo ' ' . ucfirst($location['state']) . ',';
        }
        echo ' ' . ucfirst($location['country']);
        echo '</strong></span>
                        <p>' . $data['description'] . '</p>';
        if($_GET['search']=='old') {
         echo '<p>Nombre: '.$data['nombre'].', correo: '.$data['email'].'</p>';
        }
        echo '            <ul class="nav nav-tabs nav-mobile nav-justified">
                            <li><a href="' . $ecommerce['path'] . 'pub_' . $data['id'] . '.html#contactar"><i class="fa fa-commenting"></i><span> Contactar</span></a></li>                
                            <li><a href="' . $ecommerce['path'] . 'pub_' . $data['id'] . '.html#compartir"><i class="fa fa-share-square-o"></i><span> Compartir</span></a></li>
                        </ul>
                    </div>
                </div>
            </li>';
    }
    echo '</ul></div>';
}