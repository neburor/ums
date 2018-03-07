<?php
#Ecommerce Recent
$ecommerce_messages=SQLselect(
            array(
                'table'=>'ecommerce_messages',
                'query'=> "SELECT 
    ecommerce_messages.`id`,
    ecommerce_messages.`datetime`,
    ecommerce_messages.`url`,
    ecommerce_messages.`from`,
    ecommerce_messages.`to`,
    ecommerce_messages.`message`,
    ecommerce_messages.`status`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`,
    Case accounts.`name`
        When ecommerce_messages.`to` = accounts.`id`
        Then (SELECT accounts.`name` FROM `accounts` WHERE ecommerce_messages.`to` = accounts.`id`)
    END
    AS `to_name`
    FROM `ecommerce_messages` 
        INNER JOIN `accounts`
            ON ecommerce_messages.`from` = accounts.`id`
        INNER JOIN `accounts_sn`
            ON ecommerce_messages.`from` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network` 
    WHERE ecommerce_messages.`domain` = '" .$dataForm['domain']. "'
    AND ecommerce_messages.`status`='0'
    GROUP BY ecommerce_messages.`id`
    ORDER BY ecommerce_messages.`id`
    ASC"
                )
            );

if($ecommerce_messages)
{
	echo '<ul class="list-group">';
		
		foreach ($ecommerce_messages as $column => $data){

            $formid[$data['from']]++;
            if($formid[$data['from']]==1){
            
                if(!$_SESSION['urls'][$data['url']]){
                    $_SESSION['urls'][$data['url']]=get_meta_tags($data['url'].'?metatags');
                }
                echo '	<li class="list-group-item ecommerce_message">
                		<div class="media">
                    		<div class="media-left">
                        		<img class="profile-pic" alt="'.$data['from_name'].'" src="'.$data['from_pic'].'">
                    		</div>
                    	<div class="media-body">';
                echo '      <span class="media-heading"><b>'.$data['from_name'].'</b>';
                if($data['to_name']!=NULL){
                    echo ' a <i>'.$data['to_name'].'</i>';
                }
                echo ' en <a href="'.$data['url'].'" target="_blank">'.$_SESSION['urls'][$data['url']]['title'].' <i class="fa fa-external-link-square"></i></a>
                                ';
                echo '           
                        </div>';
                foreach ($ecommerce_messages as $key => $value){
                    if($data['from']==$value['from']){
                        $date=Interval($value['datetime']);
                        echo '<p><small class="pull-right">Hace '.$date[0].' '.$date[1].'</small> 
                      '.$value['message'].'</p>';
                    }
                }

                echo '  <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                <ul class="nav nav-tabs">
                    <li role="presentation"><button class="btn btn-link" data-source="'.$data['url'].','.$_SESSION['urls'][$data['url']]['title'].'" data-action="active" data-content="ecommerce_message:'.$data['id'].':'.$data['from'].'" title="Activar"><i class="fa fa-check-circle"></i></button></li>';
                echo '  <li role="presentation"><button class="btn btn-link" data-action="archive" data-source="" data-content="ecommerce_message:'.$data['id'].':'.$data['from'].'" title="Archivar"><i class="fa fa-archive"></i></button></li>
                  	<li role="presentation"><button class="btn btn-link" data-action="ban" data-content="ecommerce:'.$data['id'].':'.$data['account'].'" title="Bannear"><i class="fa fa-ban"></i></button></li>
                    </ul>
                    </div>
                    </li>';	
            }
        }
	echo '</ul>';	
}
else
{
	echo '	<div class="media">
                <div class="media-body text-center">
                  <i class="fa fa-comments-o fa-4x"></i>
                  <b class="media-heading">NINGUN MENSAJE NUEVO</b>
                </div> 
        	</div>';
}