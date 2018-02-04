<?php
//Social buttons
if(isset($_SESSION['logged']))
{
  if($social['ref'])
  {
   	$ref='&ref='.$_SESSION['logged']['user_hash'];
  }else{
    $ref='?ref='.$_SESSION['logged']['user_hash'];
  }
}
if(!isset($social['url']))
{
  $social['url']=$url;
}
  echo '  
      <div class="ums social">
        <div class="well well-sm col-sm-6 col-xs-12">
              <a href="'.URLSYSTEM.'links/redirect.php?source=html&click=share&btn=facebook&url=https://www.facebook.com/sharer/sharer.php?u='.str_replace(array(':','/'), array('%3A','%2F'), $social['url']).$ref.'" target="_blank" rel="nofollow" title="Compartir" class="btn btn-default btn-block facebook_button">
                <i class="fa fa-facebook"></i> Compartir<span class="hidden-xxs"> en Facebook</span>
              </a>
          </div>
          <div class="well well-sm col-sm-6 col-xs-12">
                <a href="'.URLSYSTEM.'links/redirect.php?source=html&click=share&btn=twitter&url=https://twitter.com/intent/tweet?text='.$social['ttext'].str_replace(array(':','/'), array('%3A','%2F'), $social['url']).$ref.'" target="_blank" rel="nofollow" title="Compartir" class="btn btn-default btn-block twitter_button">
                  <i class="fa fa-twitter"></i> <span class="hidden-xxs">Mandar un </span>Tweet
                </a>
          </div>
        </div>';
