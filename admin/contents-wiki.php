<?php
#Contents Wiki
$wikis=SQLselect(
            array(
                'table'=>'content_wiki',
                'query'=> 'SELECT
                a.`id`,
                a.`datetime`,
                a.`table`,
                a.`url`,
                a.`account`,
                accounts.`name` AS `from_name`,
                accounts_sn.`pic` AS `from_pic`,
                b.`content` AS `old`,
                a.`content` AS `new`,
                c.`edits`,
                d.`content` AS `actual`
                FROM `content_wiki` a
                    LEFT OUTER JOIN `content_wiki` b 
                    ON a.`old` = b.`id`
                    LEFT JOIN 
                    (   SELECT `url` , count(*) as `edits`
                        FROM `content_wiki`
                        WHERE `status` = "0"
                        AND `domain` = "'.$dataForm['domain'].'"
                        GROUP BY `url`
                    ) c ON c.`url` = a.`url`
                    LEFT JOIN 
                    (   SELECT `id`, `url` , `content`
                        FROM `content_wiki`
                        WHERE `datetime` = (
                            SELECT MAX(`datetime`) FROM `content_wiki` 
                            WHERE `status` = "1")
                            AND `status` = "1"
                    ) d ON d.`url` = a.`url`
                    INNER JOIN `accounts`
                    ON a.`account` = accounts.`id`
                    INNER JOIN `accounts_sn`
                    ON a.`account` = accounts_sn.`account` 
                    AND accounts.`pic` = accounts_sn.`network`
                WHERE a.`domain` = "'.$dataForm['domain'].'"
                AND a.`status` = "0"
                ORDER BY a.`url`,a.`datetime` ASC
                '
                )
            );

if($wikis)
{
    require_once dirname(__FILE__).'/../wiki/Diff.php';
    $str_search=array("<br>","<p>","<h2>","</p>","</h2>","<hr>","<blockquote>","</blockquote>","><");
    $str_replace=array("\n<br>\n","<p>\n","<h2>\n","\n</p>","\n</h2>","\n<hr>\n","<blockquote>\n","\n</blockquote>",">\n<");

	echo '<ul class="list-group">';
	
		foreach ($wikis as $wiki => $data) 
    	{
            $a = explode("\n", str_replace($str_search,$str_replace,$data['old']));
            $b = explode("\n", str_replace($str_search,$str_replace,$data['new']));
            $diff = new Diff($a, $b, array());
            require_once dirname(__FILE__).'/../wiki/Diff/Renderer/Html/Changes.php';
            $changes = new Diff_Renderer_Html_Changes;

            require_once dirname(__FILE__).'/../wiki/Diff/Renderer/Html/Inline.php';
            $inline = new Diff_Renderer_Html_Inline;

            require_once dirname(__FILE__).'/../wiki/Diff/Renderer/Html/SideBySide.php';
            $sidebyside = new Diff_Renderer_Html_SideBySide;

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
                        <ul class="nav nav-tabs">';
                        if($data['actual'])
                        {
                            echo '<li role="presentation">
                                <span class="badge red">1</span></li>';
                        }     
                         echo ' 
                            <li role="presentation" class="active"><a href="#" role="tab" data-toggle="tab" data-target="#wiki_changes_'.$data['id'].'" aria-controls="wiki_changes_'.$data['id'].'" aria-expanded="true" title="Changes"><i class="fa fa-file-text-o"></i></a></li>
                            <li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#wiki_inline_'.$data['id'].'" aria-controls="wiki_inline_'.$data['id'].'" aria-expanded="false" title="InLIne"><i class="fa fa-file-o"></i></a></li>
                            <li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#wiki_sidebyside_'.$data['id'].'" aria-controls="wiki_sidebyside_'.$data['id'].'" aria-expanded="false" title="SidebySide"><i class="fa fa-files-o"></i></a></li>
                            <li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#wiki_edit_'.$data['id'].'" aria-controls="wiki_edit_'.$data['id'].'" aria-expanded="false" title="Edit"><i class="fa fa-edit"></i></a></li>';
                        if($data['edits']>1)
                        {
                           echo '<li role="presentation">
                                <span class="badge red">'.$data['edits'].'</span></li>';
                        }  
                echo '  </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active in" id="wiki_changes_'.$data['id'].'">
                           '.$diff->render($changes).'
                           </div>
                           <div role="tabpanel" class="tab-pane" id="wiki_inline_'.$data['id'].'">
                           '.$diff->render($inline).'
                           </div>
                           <div role="tabpanel" class="tab-pane" id="wiki_sidebyside_'.$data['id'].'">
                           '.$diff->render($sidebyside).'
                           </div>
                           <div role="tabpanel" class="tab-pane" id="wiki_edit_'.$data['id'].'">';
                           
                            if($data['actual'])
                            {
                                $c = explode("\n", str_replace($str_search,$str_replace,$data['actual']));
                                $diffA = new Diff($a, $c, array());
                                echo $diffA->render($sidebyside);
                            }
                            echo $diff->render($inline);
                            echo $diff->render($changes);
                            echo'
                                <form class="form" role="form" method="post">
                                    <div class="form-group">
                                        <input type="hidden" name="wiki_edit_text_'.$data['id'].'_data" id="wiki_edit_text_'.$data['id'].'_data" value="wiki:id:'.$data['id'].'">
                                        <textarea class="form-control ckeditor" id="wiki_edit_text_'.$data['id'].'">';
                            if($data['actual'])
                            {
                                echo $data['actual'];
                            }
                            else
                            {
                                echo $data['old'];
                            }
                            echo '      </textarea>
                                    </div>
                                </form>
                            </div>';
                        
                echo '  </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li role="presentation"><button class="btn btn-link" data-action="active" data-source="'.$data['url'].','.$_SESSION['urls'][$data['url']]['title'].'" data-content="wiki:'.$data['table'].':'.$data['id'].':'.$data['account'].'" title="Publicar"><i class="fa fa-check-circle"></i></button></li>';
                        if(!$data['actual'])
                        {
                              echo '<li role="presentation"><a href="#" role="tab" data-toggle="tab" data-target="#wiki_update_'.$data['id'].'" aria-controls="wiki_update_'.$data['id'].'" aria-expanded="false" title="Actualizar"><i class="fa fa-repeat"></i></a></li>';
                        }
                            
                    echo '  <li role="presentation"><button class="btn btn-link" data-action="archive" data-content="wiki:'.$data['id'].'" title="Archivar"><i class="fa fa-archive"></i></button></li>
                  	         <li role="presentation"><button class="btn btn-link" data-action="ban" data-content="comment:" title="Bannear"><i class="fa fa-ban"></i></button></li>
                        </ul>
                        <div class="tab-content">';
                            if(!$data['actual'])
                            {
                            echo '  <div role="tabpanel" class="tab-pane" id="wiki_update_'.$data['id'].'">
                                        <form class="form" role="form" method="post">
                                        <div class="form-group">
                                            <input type="hidden" name="wiki_update_text_'.$data['id'].'_data" id="wiki_update_text_'.$data['id'].'_data" value="wiki:url:'.$data['url'].'">
                                            <textarea class="form-control ckeditor" id="wiki_update_text_'.$data['id'].'">'.$data['new'].'</textarea>
                                        </div>
                                        </form>
                                    </div>';
                            }          
                echo '  </div>
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