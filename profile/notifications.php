<?php
//Notifications

$notifications=SQLselect(
            array(
                'table'=>'notifications_app',
                'query'=>"SELECT 
    notifications_app.`id`,
    notifications_app.`datetime`,
    notifications_app.`from_id`,
    notifications_app.`to_id`,
    notifications_app.`asset`,
    notifications_app.`asset_id`,
    notifications_app.`status`,
    Case notifications_app.`asset`
        When 'message'
        Then (SELECT messages.`form` FROM `messages` WHERE messages.`id` = notifications_app.`asset_id`)
        When 'comment'
        Then (SELECT comments.`form` FROM `comments` WHERE comments.`id` = notifications_app.`asset_id`)
        When 'wiki'
        Then 'admin'
    END
    AS `form`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`,
    Case notifications_app.`asset`
        When 'message'
        Then (SELECT messages.`message` FROM `messages` WHERE messages.`id` = notifications_app.`asset_id`)
        When 'comment'
        Then (SELECT comments.`comment` FROM `comments` WHERE comments.`id` = notifications_app.`asset_id`)
        When 'wiki'
        Then 'Se publico tu edición.'
    END
    AS `text`,
    Case notifications_app.`asset`
        When 'comment'
        Then (SELECT comments.`url` FROM `comments` WHERE comments.`id` = notifications_app.`asset_id`)
        When 'wiki'
        Then (SELECT content_wiki.`url` FROM `content_wiki` WHERE content_wiki.`id` = notifications_app.`asset_id`)
    END
    AS `url`
    FROM `notifications_app` 
        LEFT JOIN `accounts`
            ON notifications_app.`from_id` = accounts.`id`
        LEFT JOIN `accounts_sn`
            ON notifications_app.`from_id` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
    WHERE notifications_app.`to_id` = '".$_SESSION['logged']['id']."'
    GROUP BY notifications_app.`id`
    ORDER BY notifications_app.`id`
    DESC"
                )
            );

if($notifications)
{
	echo '<ul class="list-group appstream">';
		foreach ($notifications as $key => $value) 
		{
			
			$date=Interval($value['datetime']);
			if($value['asset']=='message')
			{
				

				echo '<li class="list-group-item';
                if($value['status']==0)
                {
                    echo ' active';
                }
                echo '">
                  		<a href="'.URLMESSAGES.'?app=message:'.$value['id'].':'.$value['asset_id'].'#message_'.$value['asset_id'].'" class="media message">
                    		<div class="media-left"><img class="img-circle profile-pic" src="'.ADMINPIC.'"></div>
                    		<div class="media-body"><span class="media-heading"><b>'.ADMINNAME.'</b> <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small></span>
                    		<p><small><i class="fa fa-envelope"></i> Contacto</small></p>
                    		<p>'.$value['text'].'</p>
                    		</div>
                    		<div class="media-right"><i class="fa fa-chevron-right"></i></div>
                  		</a>
                	</li>';
			}
			if($value['asset']=='comment')
			{
                if($value['form']=='reply')
                {
                    $value['from_name']=ADMINNAME;
                    $value['from_pic']=ADMINPIC;
                }
				if(!$_SESSION['urls'][$value['url']])
            	{
                	$_SESSION['urls'][$value['url']]=get_meta_tags($value['url']);
            	}
				echo '<li class="list-group-item';
                if($value['status']==0)
                {
                    echo ' active';
                }
                echo '">
                  		<a href="'.$value['url'].'?app=comment:'.$value['id'].':'.$value['asset_id'].'#comment_'.$value['asset_id'].'" class="media comment">
                    		<div class="media-left"><img class="img-circle profile-pic" src="'.$value['from_pic'].'"></div>
                    		<div class="media-body"><span class="media-heading"><b>'.$value['from_name'].'</b> <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small></span>
                    		<p><small><i class="fa fa-commenting"></i> '.$_SESSION['urls'][$value['url']]['title'].'</small></p>
                    		<p>'.$value['text'].'</p>
                    		</div>
                    		<div class="media-right"><i class="fa fa-chevron-right"></i></div>
                  		</a>
                	</li>';
			}
            if($value['asset']=='wiki')
            {
                if($value['form']=='admin')
                {
                    $value['from_name']=ADMINNAME;
                    $value['from_pic']=ADMINPIC;
                }
                if(!$_SESSION['urls'][$value['url']])
                {
                    $_SESSION['urls'][$value['url']]=get_meta_tags($value['url']);
                }
                echo '<li class="list-group-item';
                if($value['status']==0)
                {
                    echo ' active';
                }
                echo '">
                        <a href="'.$value['url'].'?app=wiki:'.$value['id'].'" class="media wiki">
                            <div class="media-left"><img class="img-circle profile-pic" src="'.$value['from_pic'].'"></div>
                            <div class="media-body"><span class="media-heading"><b>'.$value['from_name'].'</b> <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small></span>
                            <p><small><i class="fa fa-files-o"></i> '.$_SESSION['urls'][$value['url']]['title'].'</small></p>
                            <p>'.$value['text'].'</p>
                            </div>
                            <div class="media-right"><i class="fa fa-chevron-right"></i></div>
                        </a>
                    </li>';
            }
		}
	echo '</ul>';
}
else
{
	echo '<div class="media">
                <div class="media-body text-center">
                  <i class="fa fa-bell fa-4x"></i>
                  <b class="media-heading">NINGUNA ALERTA</b>
                  <p>Participa en nuestra comunidad !</p>
                </div> 
              </div>';
}

/*echo '<ul class="list-group appstream">
                <li class="list-group-item">
                  <a href class="media message">
                    <div class="media-left"><img class="img-circle profile-pic" src="https://scontent-mia1-1.xx.fbcdn.net/v/t1.0-1/p40x40/13872767_10154306295915775_1841733233213666303_n.jpg?oh=2740478a54b915570cb74b16689a7db7&oe=587EDA67"></div>
                    <div class="media-body"><span class="media-heading"><b>Dario</b> <small class="pull-right"><span class="hidden-xs">hace </span>1 D<span class="hidden-xs">ia</span></small></span>
                    <p><small><i class="fa fa-inbox"></i> Cambio libro de el retorno de los brujos</small></p>
                    <p>Te interesa cambiaro por el de no somos los primeros?</p>
                    </div>
                    <div class="media-right"><i class="fa fa-chevron-right"></i></div>
                  </a>
                </li>
                <li class="list-group-item">
                  <a href class="media message">
                    <div class="media-left"><img class="img-circle profile-pic" src="img/O_M.png"></div>
                    <div class="media-body"><span class="media-heading"><b>Administracion</b> <small class="pull-right"><span class="hidden-xs">hace </span>6 D<span class="hidden-xs">ias</span></small></span>
                    <p><small><i class="fa fa-envelope"></i> Contacto</small></p>
                    <p>Hola, para poder descargar algun capitulo es necesario seguir el procedimiento.</p>
                    </div>
                    <div class="media-right"><i class="fa fa-chevron-right"></i></div>
                  </a>
                </li>
                <li class="list-group-item">
                  <a href class="media message">
                    <div class="media-left"><img class="img-circle profile-pic" src="imagenes/pic2.jpg"></div>
                    <div class="media-body"><span class="media-heading"><b>Monzerrat</b> <small class="pull-right"><span class="hidden-xs">hace </span>1 D<span class="hidden-xs">ia</span></small></span>
                    <p><small><i class="fa fa-commenting"></i> No somos los primeros</small></p>
                    <p>Excelenta aportacion</p>
                    </div>
                    <div class="media-right"><i class="fa fa-chevron-right"></i></div>
                  </a>
                </li>
                <li class="list-group-item">
                  <a href class="media message">
                    <div class="media-left"><img class="img-circle profile-pic" src="imagenes/pic.jpg"></div>
                    <div class="media-body"><span class="media-heading"><b>Ruben</b> <small class="pull-right"><span class="hidden-xs">hace </span>1 D<span class="hidden-xs">ia</span></small></span>
                    <p><small><i class="fa fa-thumbs-up"></i> Nosomos los primeros</small></p>
                    <p>Le gusta tu comentario</p>
                    </div>
                    <div class="media-right"><i class="fa fa-chevron-right"></i></div>
                  </a>
                </li>
              </ul>';
*/