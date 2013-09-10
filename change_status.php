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
 

$c_s = $_GET['c_s'];
$t_id = $_GET['tid'];

if($c_s==1)
{
	$var3 = date("Y-m-d H:i:s");

	$result2 = mysql_query("UPDATE group_task SET finish_status=1,task_end_date='$var3' where task_id = $t_id ");	
	if($result2)
	{
		echo "done";
	}
	else
	{
				echo "not done";
	}
}
else
{
	$var3 = '0000-00-00 00:00:00';
	
	$result2 = mysql_query("UPDATE group_task SET finish_status=0,task_end_date='$var3' where task_id = $t_id ");	
	if($result2)
	{
		echo "done";
	}
	else
	{
				echo "not done";
	}
	
	
}


?>
