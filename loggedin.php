<?php
session_start();
include("includes/connect.php");

if(!isset($_SESSION['user_id']))
{
		header('Location:login.php');
}
$user_id  = $_SESSION['user_id'];
$result = mysql_query("SELECT *	 FROM user WHERE user_id='$user_id'") or die (mysql_error());

$row = mysql_fetch_assoc($result);
$name = $row['name'];
echo "kudos,You are loggedin Have a cup of tee Mr/Mrs $name ";

echo "<a href=logout.php>Log out</a>";

?>