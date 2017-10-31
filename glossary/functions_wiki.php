<?php
//Wiki Functions
$functions['glossary']=true;
function SearchRef($content)
{
	// preg_match_all('|<a class="glossary"(.*)>#</a>|iU', $content, $glossary,PREG_SET_ORDER);
	// foreach ($glossary as $key => $value) {
 //  		preg_match_all('|id="(.*)"|iU', $value[0], $term,PREG_SET_ORDER);
 //  		$content=str_replace($value[0], '<a href="#ref-'.$term[0][1].'" class="scroll" data-btn="ref_content" id="cite-ref-'.$term[0][1].'"><sup>'.$term[0][1].'</sup></a>',$content);
 //  		$x++;
 //  		if($x!=1){$glossaryList.=',';}
 //  		$glossaryList.=$term[0][1];
 //  	}
    preg_match_all('|<sup class="glossary"(.*)>(.*)</sup>|iU', $content, $glossary,PREG_SET_ORDER);
    foreach ($glossary as $key => $value) {
      $content=str_replace($value[0], '<a href="#ref-'.$value[2].'" class="scroll" data-btn="ref_content" id="cite-ref-'.$value[2].'"><sup>'.$value[2].'</sup></a>',$content);
      $x++;
      if($x!=1){$glossaryList.=',';}
      $glossaryList.=$value[2];
    }
  	$result['content']=$content;
  	if(isset($glossary)){
      $glossaryDB =SQLselect(
          array(
                  'table'=>'content_glossary',
                  'query'=>"SELECT * 
                  FROM `content_glossary` 
                  WHERE `id` IN (".$glossaryList.")")
        );
      $result['glossary'].= '<dl>';
      foreach ($glossaryDB as $key => $value) {
        $result['glossary'].='<dt><a href="#cite-ref-'.$value['id'].'" class="scroll" data-btn="menu_ref"><i class="fa fa-long-arrow-up"></i></a><sup id="ref-'.$value['id'].'">'.$value['id'].'</sup> '.$value['display'].'</dt>';
        $result['glossary'].='<dd>'.$value['description'].'</dd>';
      }
      $result['glossary'].='</dl>';
    }
  	return $result;
}