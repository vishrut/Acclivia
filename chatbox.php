<html>

<head>
<title>Acclivia-Grow with Groups</title>
<link rel="stylesheet" type="text/css" href="stylesheet/cb_style.css">
<link href="assets/css/bootstrap.css" rel="stylesheet">

<script type="text/javascript" src="js/chatbox.js"></script>

<?php
session_start();
if(isset($_SESSION['user_id']))
{
	$u_id=$_SESSION['user_id'];
}
else
{
	header("location:group_page.php?id=".$_GET['gid']);
	die();
}
include_once("connect.php");
$result3 = mysql_query("SELECT start_time, end_time FROM meeting WHERE meeting_id = $_GET[mid]");
$row3 = mysql_fetch_assoc($result3);

$current = date('Y-m-d H:i:s');
$current1 = getdate();

?>
<?php
	 if(isset($_POST['end_meeting']))
		{
			mysql_query("UPDATE meeting SET end_time = CURRENT_TIMESTAMP WHERE meeting_id=$_GET[mid]");
			header("location:chatbox.php?gid=".$_GET['gid']."&mid=".$_GET['mid']);
			die();
		}
?>

<script>
setInterval("updateInfo()",500);
function updateInfo(){
//serverRes.innerHTML="Updating"
//Ajax_Send("POST","users.php","",showUsers)

	 var gid="<?php echo $_GET['gid'] ?>";
	 var mid="<?php echo $_GET['mid'] ?>";
//	      alert(htmlString);
	//  alert(gid);
 if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
        	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
			document.getElementById("chatBox").innerHTML = xmlhttp.responseText;
			chatBox.scrollTop=chatBox.scrollHeight;
        }
        }
        xmlhttp.open("GET","receive.php?gid="+gid+"&mid="+mid,true);
        xmlhttp.send();	
}
</script>

</head>
<body>

        <?php include_once("header.php");
			$result = mysql_query("SELECT grp_name FROM groups JOIN meeting ON groups.grp_id = meeting.grp_id 
						WHERE meeting.grp_id = $_GET[gid] && meeting_id = $_GET[mid]");
			$row = mysql_fetch_assoc($result);
			$result2 =mysql_query("SELECT name, caller_id, agenda FROM user JOIN meeting ON user.user_id = meeting.caller_id
						WHERE grp_id = $_GET[gid] && meeting_id = $_GET[mid]");
			$row2 = mysql_fetch_assoc($result2);
		?> 
		
		<form class="form-inline" action="chatbox.php?gid=<?php echo $_GET['gid'];?>&mid=<?php echo $_GET['mid'];?>" method="post">
			<label style="width:80%"><h4 style='margin:0% 2%; margin-bottom:0; color:#437D94;'><?php echo($row['grp_name']." - Meeting Caller : ".$row2['name']); ?></h4></label>
			<?php
				if($_SESSION['user_id']==$row2['caller_id'] && ($row3['end_time']==0 || $current1<$row3['end_time']) && $current>$row3['start_time'])
				{
					?><input class="btn btn-medium btn-info" style="height:30px" type="submit" name="end_meeting" value="End Meeting">
				<?php
				}
			?>
		</form>
		<div style='margin-left:2%; margin-bottom:2%; margin-top:0; color:#76ACC0;'><?php echo "Agenda : ".$row2['agenda']; ?></div>
		
		<?php
		if($current<$row3['start_time'])
		{
			echo("<h2 style='margin:2%; color:#BFC9D6;'>Meeting has not started yet..!!<h2>");
			die();
		}
		?>
		
        <div id="chatBox" style="height:420px; width:1340px; padding-left:15px"></div>
    
    	<form onSubmit="sendMessage(<?php echo $_GET['gid'].",".$_GET['mid'];?>);return false" id="messageForm">
		<?php
		if($row3['end_time']==0 || $current1<$row3['end_time'])
		{?>
    	    <input style="margin:1%; height:30px" type="text" id="message" name="message" placeholder="Type something…">
            <button style="margin-top:1%" class="btn btn-medium btn-info" style="height:30px" type="button submit">Send</button>
		<?php
		}
		else
		{	
			echo("<h4> Meeting has finished !!</h4>");
		}
		?>	
    	</form>


    <script>
      $('.dropdown-toggle').dropdown()
	</script>
        
</body>
</html>

	<script>
	window.onload = function()
	{
 		if(document.getElementById("message"))
			document.getElementById("message").focus();
		else
			window.scrollTo(0, document.body.scrollHeight);
	}
    </script>