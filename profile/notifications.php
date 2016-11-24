<?php
//Notifications

$notifications=SQLselect(
            array(
                'table'=>'notifications',
                'query'=>"SELECT 
    notifications.`id`,
    notifications.`datetime`,
    notifications.`from_id`,
    notifications.`to_id`,
    notifications.`asset`,
    notifications.`asset_id`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`,
    Case notifications.`asset`
        When 'message'
        Then (SELECT messages.`message` FROM `messages` WHERE messages.`id` = notifications.`asset_id`)
        When 'comment'
        Then (SELECT comments.`comment` FROM `comments` WHERE comments.`id` = notifications.`asset_id`)
    END
    AS `text`,
    Case notifications.`asset`
        When 'comment'
        Then (SELECT comments.`url` FROM `comments` WHERE comments.`id` = notifications.`asset_id`)
    END
    AS `url`
    FROM `notifications` 
        INNER JOIN `accounts`
            ON notifications.`from_id` = accounts.`id`
        INNER JOIN `accounts_sn`
            ON notifications.`from_id` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
    WHERE notifications.`to_id` = '".$_SESSION['logged']['id']."'
    AND notifications.`status`='0'
    GROUP BY notifications.`id`
    ORDER BY notifications.`id`
    ASC"
                )
            );
$admin=SQLselect(
				array('table'=>'accounts_sn','limit'=>'LIMIT 1'),
				array('domain'=>UMSDOMAIN,'account'=>'1')
				);
if($notifications)
{
	echo '<ul class="list-group appstream">';
		foreach ($notifications as $key => $value) 
		{
			
			$date=Interval($value['datetime']);
			if($key=='message')
			{
				

				echo '<li class="list-group-item">
                  		<a href="'.URLMESSAGES.'" class="media message">
                    		<div class="media-left"><img class="img-circle profile-pic" src="'.$admin['pic'].'"></div>
                    		<div class="media-body"><span class="media-heading"><b>'.$admin['name'].'</b> <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small></span>
                    		<p><small><i class="fa fa-envelope"></i> Contacto</small></p>
                    		<p>'.$value['text'].'</p>
                    		</div>
                    		<div class="media-right"><i class="fa fa-chevron-right"></i></div>
                  		</a>
                	</li>';
			}
			if($key=='comment')
			{
				if(!$_SESSION['urls'][$value['url']])
            	{
                	$_SESSION['urls'][$value['url']]=get_meta_tags($value['url']);
            	}
				echo '<li class="list-group-item">
                  		<a href="'.$value['url'].'" class="media comment">
                    		<div class="media-left"><img class="img-circle profile-pic" src="'.$value['from_pic'].'"></div>
                    		<div class="media-body"><span class="media-heading"><b>'.$value['from_name'].'</b> <small class="pull-right">Hace '.$date[0].' '.$date[1].'</small></span>
                    		<p><small><i class="fa fa-commenting"></i> '.$_SESSION['urls'][$value['url']]['title'].'</small></p>
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

echo '<ul class="list-group appstream">
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
