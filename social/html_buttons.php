<?php
//Social buttons
if(isset($_SESSION['logged']))
{
   	$ref='?ref='.$_SESSION['logged']['user_hash'];
}
  echo '  
      <div ums>
        <div class="well well-sm col-sm-6 col-xs-12">
              <a href="'.URLSYSTEM.'links/redirect.php?click=share&btn=facebook&url=https://www.facebook.com/sharer/sharer.php?u='.str_replace(array(':','/'), array('%3A','%2F'), $url).$ref.'" target="_blank" rel="nofollow" title="Compartir" class="btn btn-default btn-block facebook_button">
                <i class="fa fa-facebook"></i> Compartir<span class="hidden-xxs"> en Facebook</span>
              </a>
          </div>
          <div class="well well-sm col-sm-6 col-xs-12">
                <a href="'.URLSYSTEM.'links/redirect.php?click=share&btn=twitter&url=https://twitter.com/intent/tweet?text='.$ttext.str_replace(array(':','/'), array('%3A','%2F'), $url).$ref.'" target="_blank" rel="nofollow" title="Compartir" class="btn btn-default btn-block twitter_button">
                  <i class="fa fa-twitter"></i> <span class="hidden-xxs">Mandar un </span>Tweet
                </a>
          </div>
        </div>';