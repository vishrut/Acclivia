<?php
include("includes/connect.php");
@session_start();
	if(isset($_SESSION['user_id']))
	{
	$u_id=$_SESSION['user_id'];
	}
	else{
		
		header("location:login.php");
		die();
	 }

	$result2 = mysql_query("select * from  user where user_id='$u_id' ");
   	$row1 = mysql_fetch_assoc($result2);
	$dob= $row1['dob'];
	echo $dob ;	
			

?>
