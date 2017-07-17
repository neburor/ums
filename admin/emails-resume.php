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


for ($i=6; $i >= 0; $i--) { 
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
$keys='send,open,click';
$names='{"send":"Enviados","open":"Abiertos","click":"Clicks"}';

echo '<div class="chartc3 top" id="resumeemails"'; 
echo "data-content='[".$columns."]'";
echo "data-keys='".$keys."'";
echo "data-names='".$names."'";
echo "></div>";

