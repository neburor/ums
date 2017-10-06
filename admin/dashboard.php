<?php 
//DASHBOARD
$accounts=SQLselect(
            array(
                'table'=>'accounts',
                'query'=>"SELECT 
    DATE(accounts.`datetime`) AS day, 
     COUNT(*) AS users
    FROM accounts
    WHERE DATE_SUB(NOW(), INTERVAL 14 DAY) < accounts.`datetime`
    AND  `domain` = '".$_POST['domain']."'
    GROUP BY day 
    ORDER BY day desc"
                )
            );


for ($i=6; $i >= 0; $i--) { 
  $date=date('Y-m-d', strtotime('-'.$i.' days'));

  $data2[$date]['day']=$date;
  $data2[$date]['users']='0';
}
for ($i=13; $i >= 7; $i--) { 
  $date=date('Y-m-d', strtotime('-'.$i.' days'));
  $data1[$date]['day']=$date;
  $data1[$date]['users']='0';
}
foreach ($accounts as $key => $value) {
  if(isset($data1[$value['day']]))
  {
    $data1[$value['day']]['users']=$value['users']; 
  }
  elseif(isset($data2[$value['day']]))
  {
    $data2[$value['day']]['users']=$value['users']; 
  }
}

foreach ($data1 as $key => $value) {
  $x++;
  if($x!=1){$columns1.=',';}
  $columns1.='"'.$value['users'].'"';
  $data1t+=$value['users'];
}
foreach ($data2 as $key => $value) {
  $y++;
  if($y!=1){$columns2.=',';}
  $columns2.='"'.$value['users'].'"';
  $data2t+=$value['users'];
}
  $dataD=$data2t-$data1t;
  $dataP=($data2t*100)/$data1t-100;
  if($data2t>$data1t)
  {
    $dataL='<span class="text-success">+'.$dataD.', +'.round($dataP,2).'%</span>';  
  }
  else
  {
    $dataL='<span class="text-danger">'.$dataD.', '.round($dataP,2).'%</span>';
  }
  
$data_content ='{"bindto": "#dbregistros",
                "data": {
                   "json": {"data1":['.$columns1.'],"data2":['.$columns2.']}
                 },
               "color": { "pattern": ["#334a5a","#1f77b4"] },
               "axis" : {
                   "x" : {"show":false},
                   "y" : {"show":false}
               },
               "legend": { "hide": true },
               "tooltip": {"show": false },
               "size": { "height": 100 } 
             }';

echo '
<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading"><i class="fa fa-users"></i> '.$data2t.' Registros ('.$dataL.')</div>
      <div class="panel-body">
        <div class="chartc3" id="dbregistros" data-content=';
echo "'".$data_content."'";
echo      '></div> 
      </div>
    </div>
  </div>
';
$wiki=SQLselect(
            array(
                'table'=>'content_wiki',
                'query'=>"SELECT 
    DATE(content_wiki.`datetime`) AS day, 
     COUNT(*) AS wiki
    FROM content_wiki
    WHERE DATE_SUB(NOW(), INTERVAL 14 DAY) < content_wiki.`datetime`
    AND  `domain` = '".$_POST['domain']."'
    GROUP BY day 
    ORDER BY day desc"
                )
            );
$glosario=SQLselect(
            array(
                'table'=>'content_glossary',
                'query'=>"SELECT 
    DATE(content_glossary.`datetime`) AS day, 
     COUNT(*) AS glossary
    FROM content_glossary
    WHERE DATE_SUB(NOW(), INTERVAL 14 DAY) < content_glossary.`datetime`
    AND  `domain` = '".$_POST['domain']."'
    GROUP BY day 
    ORDER BY day desc"
                )
            );
$data1=$data2=array();
for ($i=6; $i >= 0; $i--) { 
  $date=date('Y-m-d', strtotime('-'.$i.' days'));
  $data2[$date]['day']=$date;
  $data2[$date]['content']=0;
}
for ($i=13; $i >= 7; $i--) { 
  $date=date('Y-m-d', strtotime('-'.$i.' days'));
  $data1[$date]['day']=$date;
  $data1[$date]['content']=0;
}
foreach ($wiki as $key => $value) {
  if(isset($data1[$value['day']]))
  {
    $data1[$value['day']]['content']=intval($value['wiki']); 
  }
  elseif(isset($data2[$value['day']]))
  {
    $data2[$value['day']]['content']=intval($value['wiki']); 
  }
}
foreach ($glosario as $key => $value) {
  if(isset($data1[$value['day']]))
  {
    $data1[$value['day']]['content']+=intval($value['glossary']); 
  }
  elseif(isset($data2[$value['day']]))
  {
    $data2[$value['day']]['content']+=intval($value['glossary']); 
  }
}
$columns1=$columns2='';
$x=$y=$data1t=$data2t=0;
foreach ($data1 as $key => $value) {
  $x++;
  if($x!=1){$columns1.=',';}
  $columns1.='"'.$value['content'].'"';
  $data1t+=$value['content'];
}
foreach ($data2 as $key => $value) {
  $y++;
  if($y!=1){$columns2.=',';}
  $columns2.='"'.$value['content'].'"';
  $data2t+=$value['content'];
}
  $dataD=$data2t-$data1t;
  $dataP=($data2t*100)/$data1t-100;
  if($data2t>$data1t)
  {
    $dataL='<span class="text-success">+'.$dataD.', +'.round($dataP,2).'%</span>';  
  }
  else
  {
    $dataL='<span class="text-danger">'.$dataD.', '.round($dataP,2).'%</span>';
  }

  $data_content ='{"bindto": "#dbcontents",
                  "data": {
                   "json": {"data1":['.$columns1.'],"data2":['.$columns2.']}
                 },
               "color": { "pattern": ["#334a5a","#1f77b4"] },
               "axis" : {
                   "x" : {"show":false},
                   "y" : {"show":false}
               },
               "legend": { "hide": true },
               "tooltip": {"show": false },
               "size": { "height": 100 } 
             }';

echo '
  <div class="col-xs-12 col-sm-6 col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading"><i class="fa fa-file-text"></i> '.$data2t.' Contenidos ('.$dataL.')</div>
      <div class="panel-body">
        <div class="chartc3" id="dbcontents" data-chart="dashboard" data-content=';
echo "'".$data_content."'";
echo      '></div> 
      </div>
    </div>
  </div>
</div>
';