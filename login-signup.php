<?php
  echo '<div class="container"><div class="row">
  <div class="col-md-8 col-md-push-2">
    <a href="http://ums.hostingmex.com.mx/"><img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png" alt="Administracion de usuarios Web" class="img-responsive center-block"></a>
  </div>
</div>
<div class="row">
  <div class="col-md-8 col-md-push-2 xxs-nopadding">';

  if(isset($_GET['tab']))
  {
    echo HTML('panel_profile',array('tab'=>$_GET['tab'],'nav'=>$_GET['nav']));
  }
  else
  {
    echo HTML('panel_profile');
  }

  echo '</div>
</div>
<div class="row">
  <div class="col-md-8 col-md-push-2 text-center">
    <p>2015 © UMS de HostingMex.</p>
  </div>
</div></div>';