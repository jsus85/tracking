<?php
error_reporting(0);
define('DB_SERVER', 'localhost');
define('USER_DB', 'root');
define('PASSWORD_DB', '');
define('DATABASE', 'alba');

define("VAR_NROITEMS",20);
define("VAR_FOTOS",12);

$conexion=db_connect(DB_SERVER,USER_DB,PASSWORD_DB,DATABASE);

function db_connect($server = DB_SERVER, $user = USER_DB, $password = PASSWORD_DB, $database = DATABASE, $link = 'link_db'){
	global $$link;
	$$link   = @mysql_connect($server, $user, $password);
	if (!$$link) 
	{ 
  	 die('En este momento estamos trabajando por un mejor servicio (BD)'); 
	} 
	if($$link) mysql_select_db($database);
	return $$link;
}


function db_query($query, $link = 'link_db'){
	global $$link;
	$result = mysql_query($query) or die(mysql_error());
	return $result;
}

function db_fetch_array($query){
	return mysql_fetch_array($query);
}

function db_num_rows($query){
	return mysql_num_rows($query);
}

function db_insert_id(){
	return mysql_insert_id();
}
function db_close(){
	return mysql_close();	
}
?>