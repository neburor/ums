<?php
//Wiki Functions
$functions['polls']=true;
include 'ums/polls/html_poll.php';
//echo htmlPoll(array('id'=>'1','tag'=>'h3'));

function SearchPolls($content)
{
    preg_match_all('|<input class="poll"(.*)">|iU', $content, $polls,PREG_SET_ORDER);
    foreach ($polls as $key => $value) {
      preg_match_all('|value="(.*)" |iU', $value[1], $polls[$key]['value'],PREG_SET_ORDER);
      
    }
    foreach ($polls as $key => $value) {
      $content=str_replace($value[0], htmlPoll(array('id'=>$value['value'][0][1])),$content);
  }
  	$result['polls']=$polls;
  	$result['content']=$content;

  	return $result;
}