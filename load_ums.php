<?php
#UMS - Administracion de usuarios WEB
include 'global/config.php';
include 'global/validations.php';
include 'global/views/localviews.php';

include 'account/sessions.php';

if($_POST || $_GET)
{
	include 'global/requests.php';
}
include 'global/views/htmls.php';