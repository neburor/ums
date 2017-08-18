<?php
//API WIKI
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	session_start();
    include '../config.php';
	include '../mysql_db.php';
	if($_SESSION['logged'])
	{
		if(isset($_POST['content']))
		{
            $resultado = SQLselect(
                            array(
                            'table'=>'content_wiki',
                            'limit'=>'LIMIT 1'
                                ),
                            array(
                            'url'=> strtok($_SERVER['HTTP_REFERER'],'?'),
                            'account'=> $_SESSION['logged']['id'],
                            'status'=> '0'
                                )
                            );
            if(!$resultado)
            {
                SQLinsert(
                array(
                    'table'=>'content_wiki'
                    ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> UMSDOMAIN,
                    'url'=> strtok($_SERVER['HTTP_REFERER'],'?'),
                    'account'=> $_SESSION['logged']['id'],
                    'old'=>$_POST['old'],
                    'status'=> '0', 
                    'content'=> str_replace(array("'"),array("\'"), $_POST['content'])
                    )
                );
            }
            else
            {
                SQLupdate(
                array(
                    'table'=>'content_wiki'
                    ),
                array(
                    'id'=>$resultado['id']
                    ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'content'=>str_replace(array("'"),array("\'"), $_POST['content'])
                    )
                );
            }
			
		}
		elseif(isset($_POST['add']))
		{
            $resultado = SQLselect(
                            array(
                            'table'=>'content_wiki',
                            'limit'=>'LIMIT 1'
                                ),
                            array(
                            'url'=> strtok($_SERVER['HTTP_REFERER'],'?'),
                            'account'=> $_SESSION['logged']['id'],
                            'status'=> '0'
                                )
                            );
            if(!$resultado)
            {
			     $result = SQLselect(
					array(
                	'table'=>'content_wiki',
                	'limit'=>'LIMIT 1',
                	'query'=>'SELECT * 
                	FROM `content_wiki` 
                	WHERE `datetime` = (
                		SELECT MAX(`datetime`) FROM `content_wiki` 
                		WHERE `url` = "'.strtok($_SERVER['HTTP_REFERER'],'?').'" AND `status` = "1")
                        AND `url` = "'.strtok($_SERVER['HTTP_REFERER'],'?').'" AND `status` = "1"
                	')
				    );
                 var_dump($result);
			     if($result)
			     {
				    SQLinsert(
            	   array(
                	'table'=>'content_wiki'
                	),
            	   array(
                	'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> UMSDOMAIN,
                	'url'=> strtok($_SERVER['HTTP_REFERER'],'?'),
                	'account'=> $_SESSION['logged']['id'],
                    'old'=>$result['id'],
                	'status'=> '0', 
                	'content'=> str_replace(array("'"),array("\'"),$result['content']).str_replace(array("'"),array("\'"), $_POST['add'])
                	)
            	   );
			     }
            }
            else
            {
                SQLupdate(
                array(
                    'table'=>'content_wiki'
                    ),
                array(
                    'id'=>$resultado['id']
                    ),
                array(
                    'datetime'=> date("Y-m-d H:i:s"),
                    'content'=>str_replace(array("'"),array("\'"),$resultado['content']).str_replace(array("'"),array("\'"), $_POST['add'])
                    )
                );
            }
		}
		
	}
}