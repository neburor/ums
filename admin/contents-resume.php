<?
//Resume contents
$wiki=SQLselect(
            array(
                'table'=>'content_wiki',
                'query'=>"SELECT 
    DATE(content_wiki.`datetime`) AS day, 
     COUNT(*) AS wiki
    FROM content_wiki
    WHERE DATE_SUB(NOW(), INTERVAL 7 DAY) < content_wiki.`datetime`
    AND  `domain` = '".$_POST['domain']."'
    AND  `old` = '0' 
    GROUP BY day 
    ORDER BY day desc"
                )
            );
$edits=SQLselect(
            array(
                'table'=>'content_wiki',
                'query'=>"SELECT 
    DATE(content_wiki.`datetime`) AS day, 
     COUNT(*) AS edits
    FROM content_wiki
    WHERE DATE_SUB(NOW(), INTERVAL 7 DAY) < content_wiki.`datetime`
    AND  `domain` = '".$_POST['domain']."'
    AND  `old` != '0' 
    GROUP BY day 
    ORDER BY day desc"
                )
            );
$glossary=SQLselect(
            array(
                'table'=>'content_glossary',
                'query'=>"SELECT 
    DATE(content_glossary.`datetime`) AS day, 
     COUNT(*) AS glossary
    FROM content_glossary
    WHERE DATE_SUB(NOW(), INTERVAL 7 DAY) < content_glossary.`datetime`
    AND  `domain` = '".$_POST['domain']."'
    AND `status` = '1'
    GROUP BY day 
    ORDER BY day desc"
                )
            );

for ($i=7; $i >= 0; $i--) { 
  $date=date('Y-m-d', strtotime('-'.$i.' days'));
  $data[$date]['day']=$date;
  $data[$date]['wiki']='0';
  $data[$date]['edits']='0';
  $data[$date]['glossary']='0';
}
foreach ($wiki as $key => $value) {
  $data[$value['day']]['wiki']=$value['wiki']; 
}
foreach ($edits as $key => $value) {
  $data[$value['day']]['edits']=$value['edits']; 
}
foreach ($glossary as $key => $value) {
  $data[$value['day']]['glossary']=$value['glossary']; 
}
foreach ($data as $key => $value) {
  $x++;
  if($x!=1){$columns.=',';}
  $columns.='{"day":"'.$value['day'].'","wiki":'.$value['wiki'].',"edits":'.$value['edits'].',"glossary":'.$value['glossary'].'}';
}
$keys='{"x":"day","value":["wiki","edits","glossary"]}';
$names='{"wiki":"Wiki","edits":"Ediciones","glossary":"Glosario"}';

$data_content='{
              "bindto": "#resumecontents",
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

echo '<div class="chartc3" id="resumecontents"'; 
echo "data-content='".$data_content."'";
echo "></div>";

