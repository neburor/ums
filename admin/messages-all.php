<?php
#Messages All
$messages=SQLselect(
			array(
				'table'=>'messages',
                'query'=>"SELECT 
    messages.`id`,
    messages.`datetime`,
    messages.`from_id`,
    messages.`to_id`,
    messages.`form`,
    messages.`message`,
    messages.`status`,
    accounts.`name` AS `from_name`,
    accounts_sn.`pic` AS `from_pic`,
    Case accounts.`name`
        When messages.`to_id` = accounts.`id`
        Then (SELECT accounts.`name` FROM `accounts` WHERE messages.`to_id` = accounts.`id`)
    END
    AS `to_name`
    FROM `messages` 
        INNER JOIN `accounts`
            ON messages.`from_id` = accounts.`id`
        INNER JOIN `accounts_sn`
            ON messages.`from_id` = accounts_sn.`account` 
            AND accounts.`pic` = accounts_sn.`network`
    WHERE messages.`domain` = '".$dataForm['domain']."'
    GROUP BY messages.`id`
    ORDER BY messages.`id`
    DESC"
                )
			);
if($messages)
{
	echo '	<table class="table table-striped datatables" class="display" cellspacing="0" width="100%">
            	<thead cellspacing="0" width="100%"> <tr> <th>#</th><th>Fecha</th><th>Usuario</th> <th>Form</th> <th>Mensaje</th> </tr> 
              	</thead> 
              	<tbody>';
	foreach ($messages as $column => $data) 
    {
    	echo '<tr>
                  <td><input type="checkbox"></td>
                  <td>'.$data['datetime'].'</td>
                  <td>';
      if($data['form']=='reply') {
        echo $data['to_name'];
      } else {
        echo $data['from_name'];
      }
      echo '      </td>
                  <td>'.$data['form'].'</td>
                  <td>';
        if($data['status']==0)
        {
        	echo '<span class="sr-only">nuevo</span> <i class="fa fa-star"></i> ';
        }
        echo $data['message'].'</td>
                </tr>';
    }
    echo '		</tbody>
          	</table>';
}
else
{
	echo '	<div class="media">
                <div class="media-body text-center">
                  <i class="fa fa-envelope fa-4x"></i>
                  <b class="media-heading">NINGUN MENSAJE</b>
                </div> 
        	</div>';
}