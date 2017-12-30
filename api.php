<?php
//UMS API
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	session_start();
    include 'config.php';
	include 'mysql_db.php';
    if($_POST['ums']=='wiki')
    {
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
                    'table'=> $_POST['table'],
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
                
			     if($result)
			     {
				    SQLinsert(
            	   array(
                	'table'=>'content_wiki'
                	),
            	   array(
                	'datetime'=> date("Y-m-d H:i:s"),
                    'domain'=> UMSDOMAIN,
                    'table'=>$_POST['table'],
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
    if($_POST['ums']=='poll')
    {
        SQLinsert(
                array(
                    'table'=>'likes'
                    ),
                array(
                    'datetime'=>    date("Y-m-d H:i:s"),
                    'domain'=>      UMSDOMAIN,
                    'url'=>         strtok($_SERVER['HTTP_REFERER'],'?'),
                    'device'=>      $_SESSION['device']['id'],
                    'account'=>     $_SESSION['logged']['id'],
                    'asset'=>       'poll',
                    'asset_id'=>    $_POST['asset_id'], 
                    'like'=>        '1'
                    )
                );
    }
    if($_POST['location']=='true' && isset($_POST['country']))
    {
        $str_search=array("á","é","í","ó","ú","ñ"," ");
        $str_replace=array("a","e","i","o","u","n","-");

        $estados=SQLselect(
              array(
                  'table' => 'estados',
                  'query' => '
                  SELECT * from estados
                  WHERE `pais` = "'.$_POST['country'].'"
                  '
                )
        );
        if($_POST['country']=='mexico'){
            echo '
              <span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <select class="form-control location" name="state" data-target="#'.$_POST['formid'].'-county" required>
                <option value="all">Estado ...</option>
                <option value="all">Todos ...</option>';
            foreach ($estados as $key => $value) {
                echo '<option value="'.strtolower(str_replace($str_search,$str_replace,$value['estado'])).'">'.$value['estado'].'</option>';
            }
              echo '
              </select>
              <select class="form-control" name="county" id="'.$_POST['formid'].'-county" required>
                <option value="all">Seleccione ...</option>
              </select>
            ';
        }else{
            if($_POST['country']=='colombia'){
                $estado='Departamentos';
            }
            if($_POST['country']=='argentina'){
                $estado='Provincias';
            }
            echo '<span class="input-group-btn hidden-xxs" style="width:0px;"></span>
              <select class="form-control" name="state" required>
                <option value="all">'.$estado.' ...</option>
                <option value="all">Todos ...</option>';
            foreach ($estados as $key => $value) {
                echo '<option value="'.strtolower(str_replace($str_search,$str_replace,$value['estado'])).'">'.$value['estado'].'</option>';
            }
              echo '
              </select>
            ';
        }
        
    }
    if($_POST['location']=='true' && isset($_POST['state']))
    {
        $str_search=array("á","é","í","ó","ú","ñ"," ");
        $str_replace=array("a","e","i","o","u","n","-");

        $municipios=SQLselect(
              array(
                  'table' => 'municipios',
                  'query' => '
                  SELECT * from municipios
                  WHERE `estado` = "'.str_replace("-"," ",$_POST['state']).'"
                  '
                )
            );
        echo '{';
            echo '"Todos ...":"all",';
        foreach ($municipios as $key => $value) {
                $x++;
                if($x!=1){echo ',';}
                echo '"'.$value['municipio'].'":"'.strtolower(str_replace($str_search,$str_replace,$value['municipio'])).'"';
            }
        echo '}';
    }

}