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
if(isset($_GET['gid']) && isset($_GET['e_id']))
{
	$grp_id = $_GET['gid'];
	$email_id = $_GET['e_id'];
	$result2 = mysql_query("select * from user where premail_id= '$email_id' ");
	if(mysql_num_rows($result2)==1)
	{
		//echo mysql_num_rows($result2);
		$row1 = mysql_fetch_assoc($result2);
		$result3 = mysql_query("select * from belongs_to where grp_id='$grp_id' and user_id= $row1[user_id]");
		if($result3)
		{	
		if(mysql_num_rows($result3)==0)
		{
			//$row1 = mysql_fetch_assoc($result2);
			//echo mysql_num_rows($result3);
			$result4 = mysql_query("INSERT INTO belongs_to(user_id,grp_id,role) values($row1[user_id],$grp_id,0)");
			
			if($result4)
			{
				$invite = 'Hi,You have been added to my group. Please join us <a href=group_page1.php?id='.$grp_id.'>Here</a>';
				$result5 = mysql_query("INSERT INTO message(sender_id,receiver_id,content) values('$u_id','$row1[user_id]','$invite')");
				if($result5)
				{
					echo "User added!";	
				}
				else
				{
					die('Could not insert into database: '.mysql_error());
				}

				
			}
			else
			{
				echo "Something went Wrong!";
			}	
		}
		else
		{
			echo "User Already Exists!";
		}
		}
		else
		{
			echo "query errors";	
		}
	}
	else
	{
		echo "Invalid EmailID!";	
	}
	
}

	
			

?>
