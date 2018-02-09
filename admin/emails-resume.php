<?
//Resume emails
$send=SQLselect(
            array(
                'table'=>'emails',
                'query'=>"SELECT 
    DATE(emails.`send`) AS day, 
     COUNT(*) AS send
    FROM emails
    WHERE DATE_SUB(NOW(), INTERVAL 7 DAY) < emails.`send`
    AND  `domain` = '".$_POST['domain']."'
    GROUP BY day 
    ORDER BY day desc"
                )
            );
$open=SQLselect(
            array(
                'table'=>'emails',
                'query'=>"SELECT 
    DATE(emails.`open`) AS day, 
     COUNT(*) AS open
    FROM emails
    WHERE DATE_SUB(NOW(), INTERVAL 7 DAY) < emails.`open`
    AND  `domain` = '".$_POST['domain']."' 
    GROUP BY day 
    ORDER BY day desc"
                )
            );

$click=SQLselect(
            array(
                'table'=>'emails',
                'query'=>"SELECT 
    DATE(emails.`click`) AS day, 
     COUNT(*) AS click
    FROM emails
    WHERE DATE_SUB(NOW(), INTERVAL 7 DAY) < emails.`click` 
    AND  `domain` = '".$_POST['domain']."'
    GROUP BY day 
    ORDER BY day desc"
                )
            );

$domain=strtok($_POST['domain'],'.');
for ($i=7; $i >= 0; $i--) { 
  $date=date('Y-m-d', strtotime('-'.$i.' days'));
  $data[$date]['day']=$date;
  $data[$date]['send']='0';
  $data[$date]['open']='0';
  $data[$date]['click']='0';
}
foreach ($send as $key => $value) {
  $data[$value['day']]['send']=$value['send']; 
}

foreach ($open as $key => $value) {
  $data[$value['day']]['open']=$value['open'];
}

foreach ($click as $key => $value) {
  $data[$value['day']]['click']=$value['click'];
}

foreach ($data as $key => $value) {
  $x++;
  if($x!=1){$columns.=',';}
  $columns.='{"day":"'.$value['day'].'","send":'.$value['send'].',"open":'.$value['open'].',"click":'.$value['click'].'}';
}

$keys='{"x":"day","value":["send","open","click"]}';
$names='{"send":"Enviados","open":"Abiertos","click":"Clicks"}';

$data_content='{
                "bindto": "#resumeemails_'.$domain.'",
                "data": {
                  "json": ['.$columns.'],
                  "keys": '.$keys.',
                  "names": '.$names.'
                },
              "axis":{
                  "x": {"type":"timeseries", "tick" :{"format":"%d" }
                      }
                  }
                }
            ';

echo '<div class="chartc3 top" id="resumeemails_'.$domain.'"'; 
echo "data-content='".$data_content."'";
echo "></div>";
$Assets=SQLselect(
            array(
                'table'=>'accounts',
                'query'=>"SELECT 
                `asset`, 
                count(*) as total, 
                SUM(CASE WHEN `open`!= '0000-00-00 00-00-00' THEN 1 ELSE 0 END) 
                  AS `open`,
                SUM(CASE WHEN `click`!= '0000-00-00 00-00-00' THEN 1 ELSE 0 END) 
                  AS `click` 
                  FROM `emails` 
                  WHERE `domain` = '".$_POST['domain']."'
                  GROUP BY `asset` 
                  ORDER BY `total` 
                  DESC LIMIT 10"
                )
            );
echo '<div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading"><i class="fa fa-envelope"></i> Campañas</div>
          <table class="table table-striped"><thead><tr><th>Campaña</th><th>Enviados</th><th>Abiertos</th><th>Clicks</th></tr></thead><tbody>';
          foreach ($Assets as $key => $value) {
            $openP=($value['open']*100)/$value['total'];
            $clickP=($value['click']*100)/$value['open'];
            echo '<tr><th>'.$value['asset'].'</th>
              <td>'.$value['total'].'</td>
              <td>'.$value['open'].' <small class="label label-default">'.round($openP,1).'%</small></td>
              <td>'.$value['click'].' <small class="label label-default">'.round($clickP,1).'%</small></td>
              </tr>';

            $totalT+=$value['total'];
            $openT+=$value['open'];
            $clickT+=$value['click'];
          }
 echo '</tbody><thead><tr><th></th><th>'.$totalT.'</th><th>'.$openT.'</th><th>'.$clickT.'</th></tr></thead></table></div>
      </div>';
      $Templates=SQLselect(
            array(
                'table'=>'accounts',
                'query'=>"SELECT 
                `template`, 
                count(*) as total, 
                SUM(CASE WHEN `open`!= '0000-00-00 00-00-00' THEN 1 ELSE 0 END) 
                  AS `open`,
                SUM(CASE WHEN `click`!= '0000-00-00 00-00-00' THEN 1 ELSE 0 END) 
                  AS `click` 
                  FROM `emails` 
                  WHERE `domain` = '".$_POST['domain']."'
                  GROUP BY `template` 
                  ORDER BY `total` 
                  DESC LIMIT 10"
                )
            );
echo '<div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading"><i class="fa fa-files-o"></i> Plantillas</div>
          <table class="table table-striped"><thead><tr><th>Plantilla</th><th>Enviados</th><th>Abiertos</th><th>Clicks</th></tr></thead><tbody>';
          foreach ($Templates as $key => $value) {
            echo '<tr><th>'.$value['template'].'</th><td>'.$value['total'].'</td><td>'.$value['open'].'</td><td>'.$value['click'].'</td></tr>';
          }
 echo '</tbody></table></div>
      </div>';