<?php
//API WIKI
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	session_start();
	include '../mysql_db.php';
	if($_SESSION['logged'])
	{
		if(isset($_POST['content']))
		{
			SQLinsert(
            array(
                'table'=>'content_wiki'
                ),
            array(
                'datetime'=> date("Y-m-d H:i:s"),
                'url'=> strtok($_SERVER['HTTP_REFERER'],'?'),
                'account'=> $_SESSION['logged']['id'],
                'old'=>$_POST['old'],
                'status'=> '0', 
                'content'=> str_replace(array("'"),array("\'"), $_POST['content'])
                )
            );
		}
		elseif(isset($_POST['add']))
		{
			$result = SQLselect(
					array(
                	'table'=>'content_wiki',
                	'limit'=>'LIMIT 1',
                	'query'=>"SELECT * 
                	FROM `content_wiki` 
                	WHERE `datetime` = (
                		SELECT MAX(`datetime`) FROM `content_wiki` 
                		WHERE `url` = '".strtok($_SERVER['HTTP_REFERER'],'?')."' AND `status` = '1')
                        `url` = '".strtok($_SERVER['HTTP_REFERER'],'?')."' AND `status` = '1'
                	")
				);
			if($result)
			{
				SQLinsert(
            	array(
                	'table'=>'content_wiki'
                	),
            	array(
                	'datetime'=> date("Y-m-d H:i:s"),
                	'url'=> strtok($_SERVER['HTTP_REFERER'],'?'),
                	'account'=> $_SESSION['logged']['id'],
                    'old'=>$_POST['old'],
                	'status'=> '0', 
                	'content'=> str_replace(array("'"),array("\'"),$result['content']).str_replace(array("'"),array("\'"), $_POST['add'])
                	)
            	);
			}
		}
		
	}
}