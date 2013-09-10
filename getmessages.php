<?php
include("includes/connect.php");
 
	session_start();
	if(isset($_SESSION['user_id']))
	{
	$u_id=$_SESSION['user_id'];
	}
	else{
		
		header("location:login.php");
		die();
	 }

$result2 = mysql_query("select * from message where receiver_id='$u_id' ");
			$arr1 = array();
   			while($row1 = mysql_fetch_assoc($result2))
			{
				echo "from: ".$row1['sender_id']."<br>"."*#*#";
				echo "Message: ".$row1['content']."<br>"."*#*#";			
			}

?>
