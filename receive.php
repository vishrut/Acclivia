<?php
/*$lastreceived=$_POST['lastreceived'];
$room_file=file("room1.txt",FILE_IGNORE_NEW_LINES);
for($line=0;$line<count($room_file);$line++){
$messageArr=preg_split("<!@!>",$room_file[$line]);
if($messageArr[0]>$lastreceived)echo $messageArr[1]."<br>";
}
echo "<SRVTM>".$messageArr[0];*/

include("includes/connect.php");
if((isset($_GET['gid']))&& (isset($_GET['mid'])))
{
	$gid = $_GET['gid'];
	$mid = $_GET['mid'];
$result = mysql_query("SELECT * FROM chatbox WHERE grp_id= $gid AND meeting_id = $mid ORDER BY c_id") or die (mysql_error());
       	$ans = "";
          while($row = mysql_fetch_array($result)){
			$result2 = mysql_query("SELECT * FROM user where user_id=$row[sender_id]") or die (mysql_error());
            $row2 = mysql_fetch_array($result2);
			$ans .=  '<'.$row['send_time'].'>  '.$row2['name'].": ".$row['chat_message'].'<br>';
      }
	echo $ans;
}
?>

