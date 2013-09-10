<?php
include("includes/connect.php");

$email = $_GET['email'];
$key = $_GET['key'];

$result = mysql_query("SELECT * FROM temp_login WHERE primary_email='$email' AND activation='$key' ORDER BY user_id DESC ") or die (mysql_error());
			if (mysql_num_rows($result)==1){
				
				$result3 = mysql_query("SELECT * FROM user WHERE premail_id='$email' ") or die (mysql_error());
				if (mysql_num_rows($result3)>0){
					echo "You have already Registerd! Please try to LogIn";
					return;
				}
				
				$row = mysql_fetch_assoc($result);
				 $name = $row['name'];
				 $email = $row['primary_email'];
				 $password = $row['password'];
				 $gender = $row['gender'];
				
												
				$result2 = mysql_query("INSERT INTO user (name,pswd,premail_id,gender) VALUES('$name','$password','$email','$gender') ") or die (mysql_error());
					if(!$result2){
						die('Could not insert into database: '.mysql_error());
					}else {
						echo "Successfully Registered! <a href=login.php> Click Here to LogIn </a> ";
					}

				
			}
			else if (mysql_num_rows($result)==0){
				echo "Please Retry with the link or try to register once Again.";
			}
			else{
				echo "Something went Wrong. Please Contact Site Administrators! ";
			}



?>