<?php
//Polls
function htmlPoll($params=array())
{
	$params = array_merge(array(
        'datetime'      => date("Y-m-d H:i:s"),
        'domain'        => UMSDOMAIN,
        'tag'			=> 'p',
        'line'			=> 'transparent'
    ), $params);

	$Datapoll=SQLselect(
            array(
                'table'=>'polls',
                'order'=>'ASC'
                ),
            array(
                'poll'=> $params['id']
                )
            );
	foreach ($Datapoll as $key => $value) {
		if($value['type']=='vote')
		{
			$x++;
  			if($x!=1){$vote_list.=',';}
			$vote_list.=$value['id'];
		}
	}
	$PollLikes=SQLselect(
			array('table'=>'likes',
				'query'=>'
					SELECT 
					`asset_id`, 
					count(*),
					count(*) / t.`total` * 100 AS `percentage`, 
					t.`total`
					FROM `likes` 
					CROSS JOIN 
					(SELECT count(*) AS total FROM `likes` WHERE `asset_id` IN ('.$vote_list.')) t
                  	WHERE `asset_id` IN ('.$vote_list.')
                  	GROUP BY `asset_id`
				')
			);
	foreach ($PollLikes as $key => $value) {
		$Likes[$value['asset_id']]=$value['percentage'];
	}

	$htmlPoll='';
	foreach ($Datapoll as $key => $value) {
		if($value['type']=='title')
		{
			$htmlPoll.='<'.$params['tag'].'>'.$value['title'].'</'.$params['tag'].'>';
		}
	}

	$htmlPoll.='<ul class="list-group ums poll" id="poll_'.$params['id'].'">';
	foreach ($Datapoll as $key => $value) {
		if($value['type']=='vote')
		{
			$params['line']=$value['line'];
			$htmlPoll.='
			<li class="list-group-item">
		 		<div class="line-ind">
		 			<div class="line '.$params['line'].'" style="width: 1%" data-width="'.$Likes[$value['id']].'"></div>
		 			<p class="line-desc">'.$value['display'].'<span class="line-count"></span></p>
		 			<div class="input-group line-btn">
		 				<button class="btn btn-default pull-right" data-poll="vote:'.$params['id'].':'.$value['id'].':'.$value['display'].'">votar</button>
		 			</div>
		 		</div>
		 	</li>';
		 }
	}
	
	$htmlPoll1='<li class="list-group-item li-btn">
		<div class="collapse" id="collapse_'.$params['id'].'" aria-expanded="false" style="height: 0px;">
            <div class="well">
            <div class="resultado"></div>
            <form name="form-name" action="" role="form" method="post" class="form-name">
        		<div class="input-group">
          		<span class="input-group-addon transparent"><i class="fa fa-at"></i></span>
          		<input type="email" name="correo" class="form-control" placeholder="tucorreo@ejemplo.com">
          		<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-bar-chart"></i> Ver</button></span>
        	</div>
        	<input type="hidden" value="macho" name="genero">
        	</form>
            </div>
          </div>
		<button class="btn btn-default btn-block" data-toggle="collapse" href="#collapse_'.$params['id'].'" aria-expanded="false" aria-controls="collapse_'.$params['id'].'"><i class="fa fa-bar-chart"></i> Ver resultados</button></li>';
		$htmlPoll.='</ul>';

	return $htmlPoll;
}