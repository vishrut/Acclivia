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
 

//$pin_id = $_GET['fid'];
$g_id = $_GET['gid'];
$result2 = mysql_query("select * from pinned_groups where user_id='$u_id' and grp_id= '$g_id' ");
	if(mysql_num_rows($result2)==0)
	{
$result2 = mysql_query("INSERT INTO pinned_groups (user_id,grp_id) values ('$u_id','$g_id') ");

	}
?>
