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
if(isset($_GET['gid']))
{
	$grp_id = $_GET['gid'];
	$msg = $_GET['eid'];
	
	//$email_id = $_GET['e_id'];
	$result2 = mysql_query("select * from belongs_to where grp_id=$grp_id and role=2 ");
	
	$row1 = mysql_fetch_assoc($result2);
	$s_id = $row1['user_id'];
	$result3 = mysql_query("select * from belongs_to where grp_id='$grp_id' and role!=2");
		if($result3)
		{	
			while($row3 = mysql_fetch_array($result3))
					{
						$r_id= $row3['user_id'];
					$result5 = mysql_query("INSERT INTO message(sender_id,receiver_id,content) values('$s_id','$r_id','$msg')");
				if($result5)
				{
				//	echo "Message sent!";	
				}
				else
				{
					echo "message not sent!";
					die("Error".mysql_error());		
				}
				
				
			}
			echo "Message Sent";
			
		}
		else
			{
				echo "Something went Wrong!";
			}	
		
	
}

	
			

?>
