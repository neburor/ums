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
    if(isset($_SESSION['logged']))
    {
        $sliked="`account` = '".$_SESSION['logged']['id']."'";
    }
    else
    {
        $sliked="`device` = '".$_SESSION['device']['id']."' AND `account` = '0'";
    }

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
					l.`asset_id`, 
					count(*),
					count(*) / t.`total` * 100 AS `percentage`, 
					t.`total`,
					(SELECT count(*) FROM `likes` WHERE l.`asset_id` = `asset_id`  AND '.$sliked.') AS `liked`
					FROM `likes` l 
					CROSS JOIN 
					(SELECT count(*) AS total FROM `likes` WHERE `asset_id` IN ('.$vote_list.')) t
                  	WHERE `asset_id` IN ('.$vote_list.')
                  	GROUP BY `asset_id`
				')
			);
	foreach ($PollLikes as $key => $value) {
		$Likes[$value['asset_id']]['percentage']=$value['percentage'];
		$Likes[$value['asset_id']]['liked']=$value['liked'];
		if($value['liked']=='1')
		{
			$PollLiked=true;
		}
	}
	$htmlPoll='';
	foreach ($Datapoll as $key => $value) {
		if($value['type']=='title')
		{
			$htmlPoll.='<'.$params['tag'].'>'.$value['display'].'</'.$params['tag'].'>';
		}
	}

	$htmlPoll.='<ul class="list-group ums poll" id="poll_'.$params['id'].'">';
	foreach ($Datapoll as $key => $value) {
		if($value['type']=='vote')
		{
			$params['line']=$value['line'];
			if($PollLiked){
				$disabled=' disabled="disabled"';
				$width=(isset($Likes[$value['id']])) ? $Likes[$value['id']]['percentage'] : '1';
				$btn_text=($Likes[$value['id']]['liked']==1) ? '<i class="fa fa-check"></i> <i class="fa fa-thumbs-up"></i>' : 'votar';
				$btn_class=($Likes[$value['id']]['liked']==1) ? ' liked' : '';
			}else{
				$btn_text='votar';
				$width='1';
			}
			$htmlPoll.='
			<li class="list-group-item">
		 		<div class="line-ind">
		 			<div class="line '.$params['line'].'" style="width: '.$width.'%" data-width="'.$Likes[$value['id']]['percentage'].'"></div>
		 			<p class="line-desc">'.$value['display'].'<span class="line-count"></span></p>
		 			<div class="input-group line-btn">
		 				<button class="btn btn-default pull-right'.$btn_class.'" data-poll="vote:'.$params['id'].':'.$value['id'].':'.$value['display'].'"'.$disabled.'>'.$btn_text.'</button>
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