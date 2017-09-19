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
  echo '<ul class="nav nav-tabs nav-mobile nav-justified social" id="compartir">
          <li><a href="'.URLSYSTEM.'links/redirect.php?source=amp&click=share&btn=facebook&url=https://www.facebook.com/sharer/sharer.php?u='.str_replace(array(':','/'), array('%3A','%2F'), $social['url']).$ref.'" target="_blank" rel="nofollow" title="Compartir" class="btn btn-default btn-block facebook_button">
                <i class="fa fa-facebook"></i> Compartir</a>
            </li>
            <li><a href="'.URLSYSTEM.'links/redirect.php?source=amp&click=share&btn=twitter&url=https://twitter.com/intent/tweet?text='.$social['ttext'].str_replace(array(':','/'), array('%3A','%2F'), $social['url']).$ref.'" target="_blank" rel="nofollow" title="Compartir" class="btn btn-default btn-block twitter_button">
                  <i class="fa fa-twitter"></i> Tweet </a>
            </li>
          </ul>';