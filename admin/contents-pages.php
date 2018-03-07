<?php
#Content Pages

$pages=SQLselect(
            array(
                'table'=>'pages',
                'query'=>"SELECT 
                * 
                FROM `pages`
                WHERE `domain` = '".$dataForm['domain']."'
                ORDER BY `datetime` DESC
                "
                )
            );
if($pages)
{

	echo '<ul class="list-group">';
		
		foreach ($pages as $column => $value) 
    	{
            $data = json_decode($value['data'], true);
            $date=Interval($value['datetime']);
    		echo '	<li class="list-group-item page">
                		<div class="media">
                    		<div class="media-left">';
                if($data['thumbnail']!=''){
                    echo '<img class="thumbnail-pic" alt="'.$data['title'].'" src="'.$data['thumbnail'].'">';
                }        	
            echo '      </div>
                    	<div class="media-body">
                        	<span class="media-heading">
                            	<b>'.$data['title'].'</b> 
                                <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small>
                        	</span>
                    	</div>
                        
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                <ul class="nav nav-tabs">';

                if($value['status']=='1'){
                    echo '<li role="presentation"><button class="btn btn-link" data-action="archive" data-content="page:'.$value['id'].'" data-toggle="active" title="Archivar"><i class="fa fa-archive"></i></button></li>';
                }else{
                    echo '<li role="presentation"><button class="btn btn-link" data-action="active" data-content="page:'.$value['id'].'" data-toggle="archive" title="Publicar"><i class="fa fa-check-circle"></i></button></li>';
                }

            echo '  <li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#pageedit_'.$value['id'].'" aria-controls="pageedit_'.$value['id'].'" aria-expanded="false" title="Editar y publicar"><i class="fa fa-edit"></i></a></li>';
        echo ' </ul>
                <div class="tab-content">
                	<div role="tabpanel" class="tab-pane" id="pageedit_'.$value['id'].'">
                    	<form class="form save" role="form" method="post" action="">
            			<div class="response"></div>
                        <input type="hidden" name="formid" value="pageedit_'.$value['id'].'">
            			<input type="hidden" name="formtype" value="edit">
                        <input type="hidden" name="id" value="page:'.$value['id'].'">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-link"></i> URL</span>
                                <input type="text" name="url" placeholder="Escriba la URL ..." class="form-control" value="'.$value['url'].'">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-files-o"></i> Tipo</span>
                                <input type="text" name="type" placeholder="Tipo de contenido ..." class="form-control" value="'.$value['type'].'">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-user"></i> Cuenta</span>
                                <input type="text" name="account" placeholder="Cuenta de usuario ..." class="form-control" value="'.$value['account'].'">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-users"></i> Grupo</span>
                                <input type="text" name="group" placeholder="Grupo de usuario ..." class="form-control" value="'.$value['group'].'">
                            </div>
                        </div>';
                        if($data){
                            echo '<fieldset><legend>Datos:</legend>';
                            foreach ($data as $key => $val) {
                                echo '<div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-edit"></i> '.ucfirst($key).'</span>
                                <input type="text" name="data['.$key.']" placeholder="Escriba un valor ..." class="form-control" value="'.$val.'">
                            </div>
                        </div>';
                            }
                            echo '</fieldset>';
                        }
                echo '  <div class="form-group">
                            <button type="submit" class="btn btn-default"><i class="fa fa-save"></i> Guardar</button>
                        </div>
          				</form>
                  	</div>';
        echo '  </div>
                		</div>
              		</li>';
    		
    		
    	}
	echo '</ul>';	
}
else
{
	echo '	<div class="media">
                <div class="media-body text-center">
                  <i class="fa fa-book fa-4x"></i>
                  <b class="media-file-text">NINGUNA PAGINA</b>
                </div> 
        	</div>';
}