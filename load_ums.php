<?php
#UMS - Administracion de usuarios WEB
#include 'config.php';
#include 'settings/validations.php';
#include 'views/localviews.php';

include 'account/sessions.php';

#if($_POST || $_GET)
#{
#	include 'controllers/requests.php';
#}
#include 'views/htmls.php';