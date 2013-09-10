<?php
include("includes/connect.php");

$m_id = $_GET['m_id'];
$x = $_GET['x'];
if ($x==0) {
	$result2 = mysql_query("UPDATE message set sender_delete=1 where message_id='$m_id' ");
	//$result4 = mysql_query("UPDATE message set read_status=1 where message_id='$m_id' ");
}
else if ($x==1) {
	$result2 = mysql_query("UPDATE message set receiver_delete=1 where message_id='$m_id' ");
	$result4 = mysql_query("UPDATE message set read_status=1 where message_id='$m_id' ");
}
else {
	echo "something went wrong...";
}

?>
