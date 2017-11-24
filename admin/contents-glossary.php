<?php
#Messages Recent

$glossary=SQLselect(
            array(
                'table'=>'content_glossary',
                'query'=>"SELECT 
    content_glossary.`id`,
    content_glossary.`datetime`,
    content_glossary.`term`,
    content_glossary.`display`,
    content_glossary.`syn`,
    content_glossary.`def`,
    content_glossary.`description`,
    content_glossary.`url`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`
    FROM `content_glossary` 
        INNER JOIN `accounts`
            ON content_glossary.`account` = accounts.`id`
        INNER JOIN `accounts_sn`
            ON content_glossary.`account` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
        INNER JOIN `accounts_notif`
            ON accounts.`id` = accounts_notif.`account` 
    WHERE content_glossary.`domain` = '".$dataForm['domain']."'
    AND content_glossary.`status`='0'
    GROUP BY content_glossary.`id`
    ORDER BY content_glossary.`id`
    ASC"
                )
            );

if($glossary)
{
	echo '<ul class="list-group">';
		
		foreach ($glossary as $column => $data) 
    	{
    	   $date=Interval($data['datetime']);
    		echo '	<li class="list-group-item glossary">
                		<div class="media">
                    		<div class="media-left">
                        		<img class="media-object profile-pic" alt="'.$data['from_name'].'" src="'.$data['from_pic'].'">
                    		</div>
                    	<div class="media-body">
                        	<span class="media-heading">
                            	<b>'.$data['from_name'].'</b> 
                                <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small>
                        	</span>
                    	</div>
                        <table class="table">
                        <tbody>
                        <tr><td>'.$data['display'].'</td><td>'.$data['description'].'</td></tr>
                        </tbody>
                        </table>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                <ul class="nav nav-tabs">
                  	<li role="presentation"><button class="btn btn-link" data-action="active" data-content="glossary:'.$data['id'].'" title="Publicar"><i class="fa fa-check-circle"></i></button></li>
                    <li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#glossaryedit_'.$data['id'].'" aria-controls="glossaryedit_'.$data['id'].'" aria-expanded="false" title="Editar y publicar"><i class="fa fa-edit"></i></a></li>
                  	<li role="presentation"><button class="btn btn-link" data-action="archive" data-content="glossary:'.$data['id'].'" title="Archivar"><i class="fa fa-archive"></i></button></li>
                    <li role="presentation"><button class="btn btn-link" data-action="ban" data-content="glossary:'.$data['id'].'" title="Bannear"><i class="fa fa-ban"></i></button></li>';
        echo ' </ul>
                <div class="tab-content">
                	<div role="tabpanel" class="tab-pane" id="glossaryedit_'.$data['id'].'">
                    	<form class="form reply" role="form" method="post" action="">
            			<div class="response"></div>
                        <input type="hidden" name="formid" value="glossaryedit_'.$data['id'].'">
            			<input type="hidden" name="formtype" value="edit">
                        <input type="hidden" name="id" value="glossary:'.$data['id'].'">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-edit"></i> Termino</span>
                                <input type="text" name="term" placeholder="Escriba un termino ..." class="form-control" maxlength="64" minlength="4" value="'.$data['term'].'">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-edit"></i> Display</span>
                                <input type="text" name="display" placeholder="Escriba un termino ..." class="form-control" maxlength="64" minlength="4" value="'.$data['display'].'">
                            </div>
                        </div>
            			<div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-edit"></i> Descripción</span>
                                <textarea name="description" class="form-control" maxlength="512" minlength="8" required="">'.$data['description'].'</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-edit"></i> Definiciones</span>
                                <textarea name="definitions" class="form-control" minlength="8" required="" rows="5">'.$data['def'].'</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-edit"></i> Sinónimos</span>
                                <input type="text" name="synonyms" placeholder="Sinónimos ..." class="form-control" maxlength="64" minlength="4" value="'.$data['syn'].'">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-edit"></i> URL</span>
                                <input type="text" name="url" placeholder="Escriba una url ..." class="form-control" maxlength="128" minlength="4" value="'.$data['url'].'">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default"><i class="fa fa-share"></i> Enviar</button>
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
                  <b class="media-heading">NINGUN TERMINO NUEVO</b>
                </div> 
        	</div>';
}