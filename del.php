<?php 
include("includes/connect.php");
$text = "shikhar [gshikhri@gmail.com]";
$l1= strrpos($text,"[");
$l2= strrpos($text,"]");

echo "$l1";
echo "$l2";
$l3 = $l2 - $l1 -1 ;
echo "$l3";

$l4 = substr("$text",$l1+1,$l3);
echo "$l4";

$result = mysql_query("SELECT * FROM user WHERE premail_id ='$l4' ") or die (mysql_error());
				if (mysql_num_rows($result)==1){
					while($row = mysql_fetch_array($result)){
						$sender =  $row['user_id'];
					}
			}else{
					echo "User Doesn't Exist. ";
			}
echo $sender;
//echo "$l2 - $l1";
//echo date("Y-m-d H:i:s")


 ?>