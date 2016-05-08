<?php
#Configuracion para Mysql DB
function MysqlConnect() {
$db['di']="db586995718.db.1and1.com"; 
$db['usuario']="dbo586995718"; 
$db['clave']="1adminwvt.";
$db['db']='db586995718'; 
$mysql_connect=mysql_connect($db['di'],$db['usuario'],$db['clave']);
mysql_select_db($db['db'], $mysql_connect);
mysql_query("SET NAMES 'utf8'");
}