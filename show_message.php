<?php
include("includes/connect.php");

$m_id = $_GET['m_id'];
$x = $_GET['x'];
if($x==0)
{

	$result2 = mysql_query("SELECT * FROM message WHERE message_id = '$m_id' ");
	$result4 = mysql_query("UPDATE message set read_status=1 where message_id='$m_id' ");

	$row = mysql_fetch_array($result2);

	$result3 = mysql_query("SELECT * FROM user WHERE user_id = $row[sender_id] ");	

	$row2 = mysql_fetch_array($result3);	
	echo $row2['name'].'*#*#';
	echo $row['content'];
}
if($x==1)
{


	$result2 = mysql_query("SELECT * FROM message WHERE message_id = '$m_id' ");

	$result4 = mysql_query("UPDATE message set read_status=1 where message_id='$m_id' ");

	$row = mysql_fetch_array($result2);

	$result3 = mysql_query("SELECT * FROM user WHERE user_id = $row[receiver_id] ");	

	$row2 = mysql_fetch_array($result3);	
	echo $row2['name'].'*#*#';
	echo $row['content'];
}

?>
