<?php
#Ecommerce Recent
$ecommerce=SQLselect(
            array(
                'table'=>'ecommerce',
                'query'=>"SELECT 
    ecommerce.`id`,
    ecommerce.`datetime`,
    ecommerce.`type`,
    ecommerce.`account`,
    ecommerce.`status`,
    ecommerce.`cat`,
    ecommerce.`location`,
    ecommerce.`data`,
    ecommerce.`images`,
    ecommerce.`title`,
    ecommerce.`description`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`
    FROM `ecommerce` 
        INNER JOIN `accounts`
            ON ecommerce.`account` = accounts.`id`
        INNER JOIN `accounts_sn`
            ON ecommerce.`account` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network` 
    WHERE ecommerce.`domain` = '".$dataForm['domain']."'
    AND ecommerce.`status`='0'
    GROUP BY ecommerce.`id`
    ORDER BY ecommerce.`id`
    ASC"
                )
            );

if($ecommerce)
{
	echo '<ul class="list-group">';
		
		foreach ($ecommerce as $column => $data) 
    	{
            
    		$date=Interval($data['datetime']);
    		echo '	<li class="list-group-item ecommerce">
                		<div class="media">
                    		<div class="media-left">
                        		<img class="profile-pic" alt="'.$data['from_name'].'" src="'.$data['from_pic'].'">
                    		</div>
                    	<div class="media-body">';
            echo '      <span class="media-heading">'.$data['from_name'].' en <b>'.$data['cat'].'</b>
                                <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small></span>';
            echo '           
                        </div>
                        <p><strong>'.$data['title'].'</strong></p>
                        <p>'.$data['description'].'</p>';
                    if($images=json_decode($data['images'], true)){
              echo '<div class="thumbnails clearfix">';
              foreach ($images['list'] as $key => $value) {
                
                echo '<img src="'.$images['dir'].$value['name'].'_thumbnail.jpg">';
              }
              echo '</div>';
            }
                echo '  <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                <ul class="nav nav-tabs">
                    <li role="presentation"><button class="btn btn-link" data-source="" data-action="active" data-content="ecommerce:'.$data['id'].'" title="Publicar"><i class="fa fa-check-circle"></i></button></li>';
            echo '  <li role="presentation"><button class="btn btn-link" data-action="archive" data-source="" data-content="ecommerce:'.$data['id'].'" title="Archivar"><i class="fa fa-archive"></i></button></li>
                    <li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#ecommerceedit_'.$data['id'].'" aria-controls="ecommerceedit_'.$data['id'].'" aria-expanded="false" title="Editar"><i class="fa fa-edit"></i></a></li>
                  	<li role="presentation"><button class="btn btn-link" data-action="ban" data-content="ecommerce:'.$data['id'].'" title="Bannear"><i class="fa fa-ban"></i></button></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane" id="ecommerceedit_'.$data['id'].'">
        <form class="form reply" role="form" action="" method="POST">
        <input type="hidden" name="formid" value="ecommerceedit_'.$data['id'].'">
        <input type="hidden" name="formtype" value="edit">
        <input type="hidden" name="id" value="ecommerce:'.$data['id'].'">
        <fieldset>
            <legend>Detalles de la publicacion</legend>
            <div class="form-group">
            <label for="country" class="control-label">Ubicacion :</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>';
              if($location=json_decode($data['location'], true))
              {
                echo '<select class="form-control location" name="country" disabled>
                <option value="" selected="">'.$location['country'].'</option>
                </select>';
              }
              
              if($location['state']){
                echo '<span class="input-group-btn hidden-xs" style="width:0px;"></span><select class="form-control location" name="state" disabled>
                <option value="" selected="">'.$location['state'].'</option>
                </select>';
              }
              if($location['county']){
                echo '<span class="input-group-btn hidden-xs" style="width:0px;"></span><select class="form-control location" name="county" disabled>
                <option value="" selected="">'.$location['county'].'</option>
                </select>';
              }
        echo '</div>
            </div>';
    echo '
            <div class="thumbnails clearfix">
            ';
            if($images=json_decode($data['images'], true)){
              echo '<legend>Imagenes publicadas:</legend><small class="clearfix"><i class="fa fa-info-circle"></i> Click para indicar cual eliminar.</small>';
              foreach ($images['list'] as $key => $value) {
                if($value['status']){
                  $x++;
                  echo '<label class="pic">
          <input type="checkbox" name="images[]" value="'.$value['name'].'" checked>
            <img src="'.$images['dir'].$value['name'].'_thumbnail.jpg">
        </label>';
                }
              }
            }
           echo '
          </div>
           <div class="form-group">
            <label for="title" class="control-label">Titulo de la publicación:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-bullhorn"></i></span>
              <input type="text" class="form-control" name="title" placeholder="Titulo corto y descriptivo" value="'.$data['title'].'" required="requiered">
            </div>
          </div>
           <div class="form-group">
           <label for="ec_description" class="control-label">Descripción de la publicación:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-edit"></i></span>
              <textarea rows="2" class="form-control" name="ec_description" placeholder="Descripcion de la publicación" required="requiered">'.$data['description'].'</textarea>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-default">Publicar <i class="fa fa-share"></i></button>
            </div>
        </fieldset>
      </form>

                        </div>
                    </div>
                    </div>
                    </li>';	
    	}
	echo '</ul>';	
}
else
{
	echo '	<div class="media">
                <div class="media-body text-center">
                  <i class="fa fa-newspaper-o fa-4x"></i>
                  <b class="media-heading">NINGUNA PUBLICACION</b>
                </div> 
        	</div>';
}