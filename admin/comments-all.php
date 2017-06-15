<?php
#Messages All
$comments=SQLselect(
			array(
				'table'=>'comments',
                'query'=>"SELECT 
    comments.`id`,
    comments.`datetime`,
    comments.`from_id`,
    comments.`to_id`,
    comments.`form`,
    comments.`comment`,
    comments.`status`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`,
    Case accounts.`name`
        When comments.`to_id` = accounts.`id`
        Then (SELECT accounts.`name` FROM `accounts` WHERE comments.`to_id` = accounts.`id`)
    END
    AS `to_name`
    FROM `comments` 
        INNER JOIN `accounts`
            ON comments.`from_id` = accounts.`id`
        INNER JOIN `accounts_sn`
            ON comments.`from_id` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
    WHERE comments.`domain` = '".$dataForm['domain']."'
    GROUP BY comments.`id`
    ORDER BY comments.`id`
    DESC"
                )
			);
if($comments)
{
	echo '	<table class="table table-striped datatables" class="display" cellspacing="0" width="100%">
            	<thead cellspacing="0" width="100%"> <tr> <th>#</th><th>Fecha</th><th>Usuario</th> <th>Form</th> <th>Comentario</th> </tr> 
              	</thead> 
              	<tbody>';
	foreach ($comments as $column => $data) 
    {
    	echo '<tr>
                  <td><input type="checkbox"></td>
                  <td>'.$data['datetime'].'</td>
                  <td>'.$data['from_name'].'</td>
                  <td>'.$data['form'].'</td>
                  <td>';
        if($data['status']==0)
        {
        	echo '<span class="sr-only">nuevo</span> <i class="fa fa-star"></i> ';
        }
        if($data['status']==1)
        {
            echo '<span class="sr-only">publicado</span> <i class="fa fa-check-circle"></i> ';
        }
        if($data['status']==2)
        {
            echo '<span class="sr-only">respondido</span> <i class="fa fa-check-square"></i> '; 
        }
        if($data['status']==3)
        {
            echo '<span class="sr-only">editado</span> <i class="fa fa-edit"></i> ';
        }
        if($data['status']==4)
        {
            echo '<span class="sr-only">archivado</span> <i class="fa fa-archive"></i> ';
        }
        if($data['status']==5)
        {
            echo '<span class="sr-only">bloqueado</span> <i class="fa fa-ban"></i> ';
        }
        echo $data['comment'].'</td>
                </tr>';
    }
    echo '		</tbody>
          	</table>';
}
else
{
	echo '	<div class="media">
                <div class="media-body text-center">
                  <i class="fa fa-commenting fa-4x"></i>
                  <b class="media-heading">NINGUN COMENTARIO</b>
                </div> 
        	</div>';
}