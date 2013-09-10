<?php
		session_start();
		include_once("includes/connect.php");
	   $cur_id = $_SESSION['user_id'];
	   $grp_id = $_GET['id'];
	   
	   $result2 = mysql_query("select * from belongs_to where grp_id= '$grp_id' and user_id= '$cur_id' ");
	   if(mysql_num_rows($result2)==1)
	   {
	   $row1 = mysql_fetch_assoc($result2);
		$role = $row1['role'];
		//		echo "$role";
		if($role=='0')
		{
		
			 header("location:member_page.php?id=$grp_id");
			die();            
		}
		else
		{
			header("location:group_page1.php?id=$grp_id");
			die();
		}
	   
	   }
	   else
	   {
		   header("location:view_group.php?id=$grp_id");
		}
?>