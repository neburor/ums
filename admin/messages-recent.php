<?php
#Messages Recent

$messages=SQLselect(
            array(
                'table'=>'messages',
                'query'=>"SELECT 
    messages.`id`,
    messages.`datetime`,
    messages.`from_id`,
    messages.`to_id`,
    messages.`message`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`,
    (select count(*) from `messages` where `from_id`= accounts.`id` and `status` = '0') AS `new_messages`,
    (select count(*) from `messages` where `status` and (`from_id`= accounts.`id` = '1' or `to_id`= accounts.`id` = '1')) AS `older_messages`
    FROM `messages` 
        INNER JOIN `accounts`
            ON messages.`from_id` = accounts.`id`
        INNER JOIN `accounts_sn`
            ON messages.`from_id` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
    WHERE messages.`domain` = '".$dataForm['domain']."'
    AND messages.`status`='0'
    GROUP BY messages.`id`
    ORDER BY messages.`id`
    ASC"
                )
            );

if($messages)
{
	echo '<ul class="list-group">';
		
		foreach ($messages as $column => $data) 
    	{
    		$formid[$data['from_id']]++;
    		if($formid[$data['from_id']]==1)
    		{
    			
    		echo '	<li class="list-group-item message">
                		<div class="media">
                    		<div class="media-left">
                        		<img class="media-object profile-pic" alt="'.$data['from_name'].'" src="'.$data['from_pic'].'">
                    		</div>
                    	<div class="media-body">
                        	<span class="media-heading">
                            	<b>'.$data['from_name'].'</b> 
                            
                        	</span>
                        	'; 
            if($data['older_messages']!=0)
            {
                $result=SQLselect(
                        array(
                            'table'=>'messages',
                            'query'=>"SELECT
                            * FROM `messages`
                            WHERE `status`='1'
                            AND (`from_id`='".$data['from_id']."' OR `to_id`='".$data['from_id']."')
                            ORDER BY `id`
                            ASC
                            "
                            )
                        );
                if($result) {
                    echo '<div class="collapse history" id="messagehistory_'.$data['from_id'].'">';
                    foreach ($result as $key => $value) {
                        $date=Interval($value['datetime']);
                        echo '<p';
                        if($data['from_id']==$value['to_id']){
                            echo ' class="reply"';
                        }
                        echo '><small class="pull-right">Hace '.$date[0].' '.$date[1].'</small> 
                      '.$value['message'].'</p>';
                        
                    
                    }
                    echo '</div>';
                }
            }
            foreach ($messages as $key => $value) {
            	if($data['from_id']==$value['from_id'])
            	{
            		$date=Interval($value['datetime']);
            		echo '<p><small class="pull-right">Hace '.$date[0].' '.$date[1].'</small> 
                      '.$value['message'].'</p>';
            	}
            	
            }
            echo           	'
                    	</div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                <ul class="nav nav-tabs">
                  	<li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#messagereply_'.$data['from_id'].'" aria-controls="messagereply_'.$data['from_id'].'" aria-expanded="false"><i class="fa fa-reply"></i></a></li>
                  	<li role="presentation" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-mail-reply-all"></i></a>
                    	<ul class="dropdown-menu">
                      	<li><a href="#">Adopciones</a></li>
                    	</ul>
     				</li>
                  	<li role="presentation"><button class="btn btn-link" data-action="archive" data-content="message:'.$data['from_id'].'"><i class="fa fa-archive"></i></button></li>';
        if($data['older_messages']!=0)
        {
            echo '<li role="presentation"><a href="#" role="button" data-toggle="collapse" data-target="#messagehistory_'.$data['from_id'].'" aria-expanded="false" aria-controls="messagehistory_'.$data['from_id'].'">'.$data['older_messages'].' <i class="fa fa-history"></i></a></li>';
        }
        echo ' </ul>
                <div class="tab-content">
                	<div role="tabpanel" class="tab-pane" id="messagereply_'.$data['from_id'].'">
                    	<form class="form reply" role="form" method="post" action="">
            			<div class="response"></div>
                        <input type="hidden" name="formid" value="messagereply_'.$data['from_id'].'">
            			<input type="hidden" name="formtype" value="reply">
                        <input type="hidden" name="toid" value="'.$data['from_id'].'">
            			<div class="form-group">
              				<div class="input-group">
                				<span class="input-group-addon"> <i class="fa fa-edit"></i></span>
               					<input type="text" name="message" placeholder="Su respuesta ..." class="form-control" maxlength="1024" minlength="10" required="">
               					<div class="input-group-btn">
               						<button type="submit" class="btn btn-default btn-block"><i class="fa fa-share"></i></button>
               					</div>
              				</div>
            			</div>
          				</form>
                  	</div>
                </div>
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
                  <i class="fa fa-commenting fa-4x"></i>
                  <b class="media-heading">NINGUN COMENTARIO NUEVO</b>
                </div> 
        	</div>';
}