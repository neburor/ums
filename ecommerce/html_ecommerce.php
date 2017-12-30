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
}elseif(isset($_GET['p'])){
  echo 'Lista completa';
}elseif(isset($_GET['search'])){
  echo 'Busqueda';
}