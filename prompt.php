<?php
	session_start();
	include("includes/connect.php");
	include("includes/html_codes.php");
	
	$x = $_GET['x'];
	function createMessage($x){
		if(is_numeric($x)){
			switch ($x) {
				case 0:
					$message = " Your account is now active You may now <a href=\"login.php\">Log In! </a>";
					break;
				case 1:
					$message = "Thank you for registering! A confrimation email has been sent to your email. 
					Please click on the activation link to active your account.";
					break;
				case 2:
					$message = " That email addres has already been registred.";
				break;
				case 3:
					$message = "Sorry, but that item has already been traded!";
				break;
				case 4:	
					$message ="Item successfully updated!";
				break;
				case 5:
					$message = "Item succsessfully dleted";
				break;
				case 6:
					$message = "Message has been sent!";
				break;
				case 7:
					$message = "Thank you for leaving feedback ";
				break;
				case 8:
					$message = "Item added Successfully";
				break;
				case 9:
					$message = "That is not your item";
				break;
				case 10:
					$message = "Thank you for registering! A confrimation email has been sent to your email. 
					Please click on the activation link to active your account.<br>";
					$get_email = $_GET['email'];
					$get_key = $_GET['key'];					
					$final_link = 'active.php?email='.$get_email."&key=$get_key";
				break;
				case 11:
					$message = 	"Your new password has been mailed to you.<br/><br/>Here is your new password: ".$_GET['pswd'];
					$message .= "<br><br><a href=login.php> Click Here to LogIn </a> ";					
			}
		
			echo '<br>';
			if($x==10)
				echo "<a href=$final_link> Please Click Here To Verify Your Email Address</a>";
			else 
				echo $message;
		

		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title> </title>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/prompt.css">
	</head>
	
	<body>
		<div id="wrapper">
		
			<div id="outer">
				<div id="inner"> 
					<?php createMessage($x);?>
				</div>
			</div>
	
		</div>
	</body>
</html>