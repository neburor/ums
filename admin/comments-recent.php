<?php
#Comments Recent
$comments=SQLselect(
            array(
                'table'=>'comments',
                'query'=>"SELECT 
    comments.`id`,
    comments.`datetime`,
    comments.`url`,
    comments.`from_id`,
    comments.`to_id`,
    comments.`in_id`,
    comments.`to_comm`,
    comments.`comment`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`,
    Case accounts.`name`
        When comments.`to_id` = accounts.`id`
        Then (SELECT accounts.`name` FROM `accounts` WHERE comments.`to_id` = accounts.`id`)
    END
    AS `to_name`,
    IFNULL(accounts_notif.`status` ,'0') AS `notif`
    FROM `comments` 
        INNER JOIN `accounts`
            ON comments.`from_id` = accounts.`id`
        INNER JOIN `accounts_sn`
            ON comments.`from_id` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
        LEFT JOIN `accounts_notif`
            ON accounts.`id` = accounts_notif.`account` 
    WHERE comments.`domain` = '".$dataForm['domain']."'
    AND comments.`status`='0'
    GROUP BY comments.`id`
    ORDER BY comments.`id`
    ASC"
                )
            );

if($comments)
{
	echo '<ul class="list-group">';
		
		foreach ($comments as $column => $data) 
    	{
            if(!$_SESSION['urls'][$data['url']])
            {
                $_SESSION['urls'][$data['url']]=get_meta_tags($data['url']);
            }
    		$date=Interval($data['datetime']);
    		echo '	<li class="list-group-item comment">
                		<div class="media">
                    		<div class="media-left">
                        		<img class="profile-pic" alt="'.$data['from_name'].'" src="'.$data['from_pic'].'">
                    		</div>
                    	<div class="media-body">';
            if($data['to_id']==0)
            {
                echo '<span class="media-heading"><b>'.$data['from_name'].'</b> en 
                                <a href="'.$data['url'].'" target="_blank">'.$_SESSION['urls'][$data['url']]['title'].' <i class="fa fa-external-link-square"></i></a>
                                <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small></span>';
            }
            else
            {
                echo '<span class="media-heading"><b>'.$data['from_name'].'</b> a <i>'.$data['to_name'].'</i> en <a href="'.$data['url'].'" target="_blank">'.$_SESSION['urls'][$data['url']]['title'].' <i class="fa fa-external-link-square"></i></a><small class="pull-right">Hace '.$date[0].' '.$date[1].'</small></span>';
            }
            echo '           
                        </div>
                        <div class="media-right">
                        <img class="thumbnail-pic" alt="'.$_SESSION['urls'][$data['url']]['title'].'" src="'.$_SESSION['urls'][$data['url']]['thumbnail'].'">
                        </div>
                        <p>'.$data['comment'].'</p> 
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                <ul class="nav nav-tabs">
                    <li role="presentation"><button class="btn btn-link" data-action="active" data-source="'.$data['url'].','.$_SESSION['urls'][$data['url']]['title'].'" data-content="comment:'.$data['id'];
            if($data['to_id']!=0)
            {
                echo ':'.$data['from_id'].':'.$data['to_id'].':'.$data['to_comm'];
            }
            echo'" title="Publicar"><i class="fa fa-check-circle"></i></button></li>
                  	<li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#commentreply_'.$data['id'].'" aria-controls="commentreply_'.$data['id'].'" aria-expanded="false" title="Responder"><i class="fa fa-reply"></i></a></li>
                  	<li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#commentedit_'.$data['id'].'" aria-controls="commentedit_'.$data['id'].'" aria-expanded="false" title="Responder y publicar"><i class="fa fa-commenting"></i></a></li>';
            if($data['notif']==1 || $data['notif']==2)
            {
                echo '<li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#commentmail_'.$data['id'].'" aria-controls="commentmail_'.$data['id'].'" aria-expanded="false" title="Enviar correo"><i class="fa fa-envelope-square"></i></a></li>';
            }
            echo '  <li role="presentation"><button class="btn btn-link" data-action="archive" data-content="comment:'.$data['id'].'" title="Archivar"><i class="fa fa-archive"></i></button></li>
                  	<li role="presentation"><button class="btn btn-link" data-action="ban" data-content="comment:'.$data['id'].'" title="Bannear"><i class="fa fa-ban"></i></button></li>
                </ul>
                <div class="tab-content">
                	<div role="tabpanel" class="tab-pane" id="commentreply_'.$data['id'].'">
                    	<form class="form reply" role="form" method="post" action="">
            			<div class="response"></div>
                        <input type="hidden" name="formid" value="commentreply_'.$data['id'].'">
            			<input type="hidden" name="formtype" value="reply">
                        <input type="hidden" name="publish" value="false">
                        <input type="hidden" name="comment" value="'.$data['comment'].'">
                        <input type="hidden" name="url" value="'.$data['url'].'">
                        <input type="hidden" name="title" value="'.$_SESSION['urls'][$data['url']]['title'].'">
                        <input type="hidden" name="route" value="'.$data['id'].':'.$data['from_id'].':'.$data['to_id'].':'.$data['to_comm'].':'.$data['in_id'].'">
            			<div class="form-group">
              				<div class="input-group">
                				<span class="input-group-addon"> <i class="fa fa-edit"></i></span>
               					<input type="text" name="reply" placeholder="Su respuesta ..." class="form-control" maxlength="1024" minlength="10">
               					<div class="input-group-btn">
               						<button type="submit" class="btn btn-default"><i class="fa fa-share"></i></button>
               					</div>
              				</div>
            			</div>
          				</form>
                  	</div>
                    <div role="tabpanel" class="tab-pane" id="commentedit_'.$data['id'].'">
                        <form class="form reply" role="form" method="post" action="">
                        <div class="response"></div>
                        <input type="hidden" name="formid" value="commentedit_'.$data['id'].'">
                        <input type="hidden" name="formtype" value="reply">
                        <input type="hidden" name="url" value="'.$data['url'].'">
                        <input type="hidden" name="title" value="'.$_SESSION['urls'][$data['url']]['title'].'">
                        <input type="hidden" name="route" value="'.$data['id'].':'.$data['from_id'].':'.$data['to_id'].':'.$data['to_comm'].':'.$data['in_id'].'">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-edit"></i></span>
                                <textarea name="comment" class="form-control" maxlength="1024" minlength="10" required="">'.$data['comment'].'</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-reply"></i></span>
                                <input type="text" name="reply" placeholder="Su respuesta ..." class="form-control" maxlength="1024" minlength="10">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default"><i class="fa fa-share"></i> Enviar</button>
                        </div>
                        </form>
                    </div>';
            if($data['notif']==1 || $data['notif']==2)
            {
                echo '<div role="tabpanel" class="tab-pane" id="commentmail_'.$data['id'].'">
                        <form class="form reply" role="form" method="post" action="">
                        <div class="response"></div>
                        <input type="hidden" name="formid" value="commentmail_'.$data['id'].'">
                        <input type="hidden" name="formtype" value="email">
                        <input type="hidden" name="toid" value="'.$data['from_id'].'">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-edit"></i></span>
                                <textarea name="response" class="form-control" maxlength="1024" minlength="10" placeholder="Su respuesta ..." required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default"><i class="fa fa-share"></i> Enviar</button>
                        </div>
                        </form>
                    </div>';
            }
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
                  <i class="fa fa-commenting fa-4x"></i>
                  <b class="media-heading">NINGUN COMENTARIO NUEVO</b>
                </div> 
        	</div>';
}