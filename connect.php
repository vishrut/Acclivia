<?php
	$conn = mysql_connect("localhost","root","root");
	if(!$conn)
	{
		die('error in coonection'.mysql_error());
	}
	
  mysql_select_db("acclivia",$conn); //select db
?>