<?php
#Configuracion para Mysql DB
function MysqlConnect() {
$db['di']="db646861313.db.1and1.com"; 
$db['usuario']="dbo646861313"; 
$db['clave']="1rdcouoh.";
$db['db']='db646861313'; 
$mysql_connect=mysql_connect($db['di'],$db['usuario'],$db['clave']);
mysql_select_db($db['db'], $mysql_connect);
mysql_query("SET NAMES 'utf8'");
}