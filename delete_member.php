<?php
include("includes/connect.php");

$u_id = $_GET['uid'];
$g_id = $_GET['gid'];


	$result2 = mysql_query("delete from belongs_to where user_id=$u_id and grp_id=$g_id ");

?>
