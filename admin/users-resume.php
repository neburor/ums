<?
//Resume emails
// $accounts=SQLselect(
//             array(
//                 'table'=>'accounts',
//                 'query'=>"SELECT 
//     DATE(accounts.`datetime`) AS day, 
//      COUNT(*) AS users
//     FROM accounts
//     WHERE DATE_SUB(NOW(), INTERVAL 30 DAY) < accounts.`datetime`
//     AND  `domain` = '".$_POST['domain']."'
//     GROUP BY day 
//     ORDER BY day desc"
//                 )
//             );

$accounts=SQLselect(
            array(
                'table'=>'accounts',
                'query'=>"SELECT 
    DATE(accounts.`datetime`) AS day, 
     COUNT(*) AS users
    FROM accounts
    WHERE DATE_SUB(NOW(), INTERVAL 28 DAY) < accounts.`datetime`
    AND  `domain` = '".$_POST['domain']."'
    GROUP BY day 
    ORDER BY day asc"
                )
            );
$Taccounts=SQLselect(
            array(
                'table'=>'accounts',
                'limit'=>'LIMIT 1',
                'query'=>"SELECT  
     COUNT(*) AS users
    FROM accounts
    WHERE  `domain` = '".$_POST['domain']."' LIMIT 1"
                )
            );

for ($i=28; $i >= 0; $i--) { 
  $date=date('Y-m-d', strtotime('-'.$i.' days'));
  $data[$date]['day']=$date;
  $data[$date]['users']='0';
}

// for ($i=8; $i >= 0; $i--) { 
//   $week=date('W')-$i;
//   $weeks[$week]['users']='0';
// }
foreach ($accounts as $key => $value) {
  $data[$value['day']]['users']=$value['users']; 
  $Tusers=$value['users']+$Tusers;
}
$data[date('Y-m-d', strtotime('-28 days'))]['users']=$data[date('Y-m-d', strtotime('-28 days'))]['users']+$Taccounts['users']-$Tusers;
foreach ($data as $key => $value) {
  $lastday=$data[$key]['users']=$value['users']+$lastday;
}
// foreach ($accounts as $key => $value) {

//   $lastWeek=$weeks[$value['week']]['users']=$value['users']+$lastWeek; 

// }

foreach ($data as $key => $value) {
  $x++;
  if($x!=1){$columns.=',';}
  $columns.='{"day":"'.$value['day'].'","register":'.$value['users'].'}';
}
// foreach ($weeks as $key => $value) {
//   $x++;
//   if($x!=1){$columns.=',';}
//   $columns.='{"week":"'.$key.'","register":'.$value['users'].'}';
// }
$keys='{"x":"day","value":["register"]}';
$names='{"register":"Registros"}';

$data_content='{
              "bindto": "#resumeusers",
              "data": {
                  "json": ['.$columns.'],
                  "keys": '.$keys.',
                  "names": '.$names.'
                },
              "axis":{
                  "x": {"type":"timeseries", "tick" :{"format":"%d"}},
                  "y": {"tick":{"count":"5"}}
                  },
                "size": {"height":"200"}
              }
              
            ';
// $data_content='"data": {
//                   "json": ['.$columns.'],
//                   "keys": '.$keys.',
//                   "names": '.$names.'
//                 },
//               "subchart":{"show":true},
//               "axis":{
//                   "x": {"type":"timeseries", "tick" :{"format":"%d"}, "extent":["'.date('Y-m-d', strtotime('-7 days')).'","'.date('Y-m-d').'"]
//                       }
//                   }
//             ';
// $data_content='"data": {
//                   "json": ['.$columns.'],
//                   "keys": '.$keys.',
//                   "names": '.$names.'
//                 }
//             ';

echo '<div class="chartc3 top" id="resumeusers"';
echo "data-content='".$data_content."'";
echo "></div>";

