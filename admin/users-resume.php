<?
//Resume emails


$accounts=SQLselect(
            array(
                'table'=>'accounts',
                'query'=>"SELECT 
                  DATE(accounts.`datetime`) AS day,
                  accounts_sn.`network`, 
                  COUNT(*) AS users
                FROM accounts
                LEFT JOIN `accounts_sn`
                  ON accounts.`id` = accounts_sn.`account`
                WHERE DATE_SUB(NOW(), INTERVAL 28 DAY) < accounts.`datetime`
                AND  accounts.`domain` = '".$_POST['domain']."'
                GROUP BY day, network 
                ORDER BY day asc"
                )
            );
$Taccounts=SQLselect(
            array(
                'table'=>'accounts',
                'query'=>"SELECT  
                    `network`, 
                    COUNT(*) AS users
                  FROM `accounts_sn`
                  WHERE  `domain` = '".$_POST['domain']."'
                  GROUP BY `network`
                  ORDER BY `network`"
                )
            );
$domain=strtok($_POST['domain'],'.');
foreach ($Taccounts as $key => $value) {
  $TotalAccounts=$value['users']+$TotalAccounts;
  $xs++;
  if($xs!=1){$columns_source.=',';}
  $network=($value['network']=='avatar')? 'email' : $value['network'];
  $columns_source.='["'.$network.'", "'.$value['users'].'"]';
}

for ($i=28; $i >= 0; $i--) { 
  $date=date('Y-m-d', strtotime('-'.$i.' days'));
  $data[$date]['day']=$date;
  $data[$date]['total']='0';
  $data[$date]['email']='0';
  $data[$date]['fb']='0';
  $data[$date]['gl']='0';
  $data[$date]['tw']='0';
}

foreach ($accounts as $key => $value) {
  if($value['network']=='avatar')
  {
    $data[$value['day']]['email']=$value['users'];  
  }
  if($value['network']=='facebook')
  {
    $data[$value['day']]['fb']=$value['users'];  
  }
  if($value['network']=='google')
  {
    $data[$value['day']]['gl']=$value['users'];  
  }
  if($value['network']=='twitter')
  {
    $data[$value['day']]['tw']=$value['users'];  
  }
}
foreach ($data as $key => $value) {
  $total=$data[$key]['total']=$value['email']+$value['fb']+$value['gl']+$value['tw'];
  $Tusers=$total+$Tusers; 
}

$data[date('Y-m-d', strtotime('-28 days'))]['total']=$data[date('Y-m-d', strtotime('-28 days'))]['total']+$TotalAccounts-$Tusers;
foreach ($data as $key => $value) {
  $lastday=$data[$key]['total']=$value['total']+$lastday;
}

// foreach ($data as $key => $value) {
//   $y++;
//   if($y!=1){$columns1.=',';}
//   $columns1.='"'.$value['users'].'"';
//   $data1t=$value['users'];
// }

foreach ($data as $key => $value) {
  $xt++;
  if($xt!=1){$columns_timeline.=',';}
  $columns_timeline.='{"day":"'.$value['day'].'","register":'.$value['total'].'}';
  $data1t=$value['total'];
}

$keys_timeline='{"x":"day","value":["register"]}';
$names_timeline='{"register":"Registros"}';

// $data_content='{
//               "bindto": "#resumeusers",
//               "data": {
//                   "json": ['.$columns.'],
//                   "keys": '.$keys.',
//                   "names": '.$names.'
//                 },
//               "axis":{
//                   "x": {"type":"timeseries", "tick" :{"format":"%d"}},
//                   "y": {"tick":{"count":"5"}}
//                   },
//                 "size": {"height":"200"}
//               }
              
//             ';
$data_content_source='{"bindto": "#registry_source_'.$domain.'",
                "data": {
                   "columns": ['.$columns_source.'],
                   "keys": {"value":"users"},
                   "type": "pie"
                 },
                "pie": {
                  "label": {"show":false}
                },
              "color": { "pattern": ["#333333","#3b5998","#dd4b39","#55acee"] },
               "legend": { "hide": true },
               "size": { "height": 100 } 
             }';

$data_content_timeline='{"bindto": "#registry_timeline_'.$domain.'",
                "data": {
                   "json": ['.$columns_timeline.'],
                   "keys": '.$keys_timeline.',
                   "names": '.$names_timeline.'
                 },
               "axis":{
                   "x": {"type":"timeseries", "show":false},
                   "y" : {"show":false}
               },
               "legend": { "hide": true },
               "size": { "height": 70 } 
             }';

echo '  <div class="col-xs-12 nopadding">
          <div class="panel panel-default">
            <div class="panel-heading"> '.$data1t.' registros hasta hoy</div>
            <div class="panel-body mobile">
              <div class="chartc3 col-sm-10 col-xs-8 nopadding" id="registry_timeline_'.$domain.'"';
            echo "data-content='".$data_content_timeline."'";
            echo "></div>";
echo '        <div class="chartc3 col-sm-2 col-xs-4 nopadding" id="registry_source_'.$domain.'"';
            echo "data-content='".$data_content_source."'";
            echo "></div>
            </div>
          </div>
        </div>";

for ($i=7; $i >= 0; $i--) { 
  $date=date('Y-m-d', strtotime('-'.$i.' days'));
  $xr++;
  if($xr!=1){$columns_resume.=',';}
  $columns_resume.='{"day":"'.$data[$date]['day'].'","email":'.$data[$date]['email'].',"fb":'.$data[$date]['fb'].',"gl":'.$data[$date]['gl'].',"tw":'.$data[$date]['tw'].'}';
}
$keys_resume='{"x":"day","value":["email","fb","gl","tw"]}';
$names_resume='{"email":"Correo","fb":"Facebook","gl":"Google","tw":"Twitter"}';

$data_content_resume='{
              "bindto": "#registry_resume_'.$domain.'",
              "data": {
                  "json": ['.$columns_resume.'],
                  "keys": '.$keys_resume.',
                  "names": '.$names_resume.'
                },
              "color": { "pattern": ["#333333","#3b5998","#dd4b39","#55acee"] },
              "axis":{
                  "x": {"type":"timeseries", "tick" :{"format":"%d" }
                      }
                  }
                }
            ';

echo '<div class="col-xs-12"><div class="chartc3" id="registry_resume_'.$domain.'"'; 
echo "data-content='".$data_content_resume."'";
echo "></div></div>";
$TForms=SQLselect(
            array(
                'table'=>'accounts',
                'query'=>"SELECT  
                    `form_id`, 
                    COUNT(*) AS total
                  FROM `accounts`
                  WHERE `domain` = '".$_POST['domain']."'
                  GROUP BY `form_id`
                  ORDER BY `total` DESC
                  LIMIT 10"
                )
            );
$TURLs=SQLselect(
            array(
                'table'=>'accounts',
                'query'=>"SELECT  
                    `url_ref`, 
                    COUNT(*) AS total
                  FROM `accounts`
                  WHERE `domain` = '".$_POST['domain']."'
                  GROUP BY `url_ref`
                  ORDER BY `total` DESC
                  LIMIT 10"
                )
            );
echo '<div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading"><i class="fa fa-align-left"></i> Formularios</div>
          <ul class="list-group">';
          foreach ($TForms as $key => $value) {
            if($value['form_id']==NULL){$value['form_id']='Sin datos';}
            echo '<li class="list-group-item"><span class="badge">'.$value['total'].'</span>'.$value['form_id'].'</li>';
          }
 echo '</ul></div>
      </div>';
echo '<div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading"><i class="fa fa-link"></i> URLs</div>
          <ul class="list-group">';
          foreach ($TURLs as $key => $value) {
            if($value['url_ref']==NULL){$value['url_ref']='Sin datos';}
            echo '<li class="list-group-item"><span class="badge">'.$value['total'].'</span>'.$value['url_ref'].'</li>';
          }
 echo '</ul></div>
      </div>';