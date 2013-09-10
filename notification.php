<?php
session_start();
include("includes/connect.php");

if(isset($_SESSION['user_id']))
{
	$u_id = $_SESSION['user_id'];
}
else
{
	echo "Please Log in! ";
	die;
}


$result2 = mysql_query("select * from message where receiver_id='$u_id' and  read_status=0 ");
			$arr1 = array();
   			$num_rows = mysql_num_rows($result2);
			echo "$num_rows"; 
?>
