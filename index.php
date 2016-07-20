<?php
session_start();
include 'load_ums.php';
#echo '<pre>';
#var_dump($_SESSION);
#echo '</pre>';
?>
<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="http://www.hostingmex.com.mx/img/favicon.png">

<meta name="MobileOptimized" content="width" />
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UMS</title>
<meta name="description" content="Perfil de usuario" />
<link rel="image_src" href="" />

    <!-- Bootstrap core CSS -->
   <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
   <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
   <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

   <!-- Custom styles for this template -->
  <link href="/themes/base/custom-bootstrap.css" rel="stylesheet">
   <link href="/themes/base/bootstrap-social.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body> 
<?php

if($_SESSION['feedback']['top'])
{
  echo alerts($_SESSION['feedback']['top']['alert']);
  unset($_SESSION['feedback']['top']['alert']);
}

if(isset($_SESSION['profile']))
{
  echo '<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header pull-left">
      <a class="navbar-brand" href="http://ums.hostingmex.com.mx/"><img src="http://www.hostingmex.com.mx/imagenes/hostingmex-logo.png" alt="Administracion de usuarios Web"></a>
    </div>
    <ul class="nav navbar-nav pull-right">
      <li><a href="?logout" class=""><i class="fa fa-power-off"></i> <span class="">Salir</span></a></li>
    </ul>
  </div><!-- /.container-fluid -->
</nav>';
 #include 'user-profile.php';
}
else
{
 #include 'login-signup.php'; 
}
echo '<div class="container"><div class="row">
  <div class="col-md-8 col-md-push-2">';
 include 'messages/messages.php';
echo '</div></div></div>';
echo '<div class="container"><div class="row">
  <div class="col-md-8 col-md-push-2">';
 include 'comments/comments.php';
echo '</div></div></div>';

?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap1.min.js"></script>
    <script type='text/javascript' src="js/1ums.js"></script>
  </body>
</html>