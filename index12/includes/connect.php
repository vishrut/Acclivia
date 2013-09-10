<?php
$connect = mysql_connect('localhost','root','');
if(!$connect){
	die( 'Could not connect'.mysql_error() );
}

$conn = mysql_select_db("acclivia");
if(!$conn){
	die( 'Could not select database'.mysql_error() );
}

?>