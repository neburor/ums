<?php
#Contents Wiki
$wikis=SQLselect(
            array(
                'table'=>'content_wiki',
                'query'=> 'SELECT
                a.`id`,
                a.`datetime`,
                a.`url`,
                a.`account`,
                accounts.`name` AS `from_name`,
                accounts_sn.`pic` AS `from_pic`,
                b.`content` AS `old`,
                a.`content` AS `new`
                FROM `content_wiki` a
                    LEFT OUTER JOIN `content_wiki` b 
                    ON a.`old` = b.`id`
                    INNER JOIN `accounts`
                    ON a.`account` = accounts.`id`
                    INNER JOIN `accounts_sn`
                    ON a.`account` = accounts_sn.`account` 
                    AND accounts.`pic` = accounts_sn.`network`
                WHERE a.`status` = "0"
                ORDER BY a.`datetime` ASC
                '
                )
            );

if($wikis)
{
	echo '<ul class="list-group">';
	
		foreach ($wikis as $wiki => $data) 
    	{
            if(!$_SESSION['urls'][$data['url']])
            {
                $_SESSION['urls'][$data['url']]=get_meta_tags($data['url'].'?metatags');
            }
    		$date=Interval($data['datetime']);
    	echo ' <li class="list-group-item wiki">
                    <div class="media">
                        <div class="media-left">
                        	<img class="profile-pic" alt="'.$data['from_name'].'" src="'.$data['from_pic'].'">
                    	</div>
                    	<div class="media-body">
                            <span class="media-heading"><b>'.$data['from_name'].'</b> en 
                                <a href="'.$data['url'].'" target="_blank">'.$_SESSION['urls'][$data['url']]['title'].' <i class="fa fa-external-link-square"></i></a>
                                <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small>
                            </span>           
                        </div>
                        <div class="media-right">
                            <img class="thumbnail-pic" alt="'.$_SESSION['urls'][$data['url']]['title'].'" src="'.$_SESSION['urls'][$data['url']]['thumbnail'].'">
                        </div>
                        <p>'.$data['comment'].'</p> 
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <ul class="nav nav-tabs">
                  	         <li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#commentreply_'.$data['id'].'" aria-controls="commentreply_'.$data['id'].'" aria-expanded="false" title="Responder"><i class="fa fa-reply"></i></a></li>
                  	         <li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#commentedit_'.$data['id'].'" aria-controls="commentedit_'.$data['id'].'" aria-expanded="false" title="Responder y publicar"><i class="fa fa-commenting"></i></a></li>
                            <li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#commentmail_'.$data['id'].'" aria-controls="commentmail_'.$data['id'].'" aria-expanded="false" title="Enviar correo"><i class="fa fa-envelope-square"></i></a></li>
                            <li role="presentation"><button class="btn btn-link" data-action="archive" data-content="comment:" title="Archivar"><i class="fa fa-archive"></i></button></li>
                  	         <li role="presentation"><button class="btn btn-link" data-action="ban" data-content="comment:" title="Bannear"><i class="fa fa-ban"></i></button></li>
                        </ul>
                        <div class="tab-content">
                	       <div role="tabpanel" class="tab-pane" id="">
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
                  <i class="fa fa-files-o fa-4x"></i>
                  <b class="media-heading">NINGUNA EDICION NUEVA</b>
                </div> 
        	</div>';
}