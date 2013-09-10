<?php
include("includes/connect.php");

$pin_id = $_GET['fid'];
//$g_id = $_GET['gid'];
	$result2 = mysql_query("delete from pinned_groups where pin_id= '$pin_id' ");

?>
