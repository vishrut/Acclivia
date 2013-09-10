<?php
/*$message=strip_tags($_POST['message']);
$message=stripslashes($message);
$user=$_POST['user'];

$room_file=file("room1.txt",FILE_IGNORE_NEW_LINES);

$room_file[]=time()."<!@!>".$user.": ".$message;
if (count($room_file)>20)$room_file=array_slice($room_file,1);
$file_save=fopen("room1.txt","w+");
flock($file_save,LOCK_EX);
for($line=0;$line<count($room_file);$line++){
fputs($file_save,$room_file[$line]."\n");
};
flock($file_save,LOCK_UN);
fclose($file_save);
echo "sentok";
exit();*/

include("includes/connect.php");
session_start();
session_start();
  if(isset($_SESSION['user_id']))
  {
  $u_id=$_SESSION['user_id'];
  }
  else{
    
    header("location:login.php");
    die();
   }
$message2=$_GET['message'];
$message2=mysql_real_escape_string($message2);

$gid2=$_GET['gid'];
$gid2=mysql_real_escape_string($gid2);

$mid2=$_GET['mid'];
$mid2=mysql_real_escape_string($mid2);

$result = mysql_query("INSERT INTO chatbox(sender_id,grp_id,meeting_id,chat_message) VALUES('$u_id','$gid2','$mid2','$message2')") or die (mysql_error());
echo "sentok";

?>

