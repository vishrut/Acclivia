<?php
session_start();
include("includes/connect.php");
include("includes/html_codes.php");

if(isset($_POST['signup'])){
	$error = array();
	
	//username
	if(empty($_POST['username'])){
		$error[] = 'Please enter a username. ';
	}else if( ctype_alnum($_POST['username']) ){
		$username = $_POST['username'];
	}else{
		$error[] = 'Username must consist of letters and numbers only. ';
	}
	
	//email
    if(empty($_POST['email'])){
        $error[] = 'Please enter your email. ';
    }else if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])){
		$email = mysql_real_escape_string($_POST['email']);
    }else{
		$error[] = 'Your e-mail address is invalid. ';
    }
	
	
	if (empty ($error)){
			$result = mysql_query("SELECT * FROM user WHERE premail_id='$email' or name='$username'") or die (mysql_error());
			if (mysql_num_rows($result)==0){
				$activation = md5(uniqid(rand(), true));
				$result2 = mysql_query("INSERT INTO temp_login (user_id,name,primary_email,password,activation) VALUES('','$username','$email','no pass','$activation') ") or die (mysql_error());
					if(!$result2){
						die('Choud not insert into database: '.mysql_error());
					}else {
						$message = "To Activate your account please Click on this link: \n\n";
						$message .= "http://lisa1986.com".'/actibe.php?email='.urlencode($email)."&key=$activation";
						mail($email, 'Registration Confirmation', $message);
						header('Location: prompt.php?x=1');
					}
			}else{
				header('Location:prompt.php?x=2');
			}
		}else{
			$error_message ='<span class="error">' ;
				foreach($error as $key => $values) {
					$error_message.= "$values";
				}
			$error_message.="</span> <br/><br/>";
		}

	

}



?>

<!DOCTYPE html>
<html lang="en">
    <head>
       
     	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"></link>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"></link>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css"></link>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css"></link>
        <link rel="stylesheet" type="text/css" href="css/login_style.css">
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style6.css" />
        <link rel='stylesheet' type='text/css' href='css/fonts.css'/>
		<link rel="stylesheet" type='text/css' href="css/popup.css"></link>
		
		<script type="text/javascript" src="js/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
		
			<script type="text/javascript" src="js/jquery.lettering.js"></script>
			<script type="text/javascript">
				$(function() {
					$("#letter-container h2 a").lettering();
				});
			</script>
          </head>
		      <title>ACCLIVIA:Grow With Groups</title>       


<body style="">
    <div class="First">
    <table id="row1">
        <tr>
            <td> 
                <div class="logo">
                <img src="images/Logo_Final.png" alt="Logo"></img>
            </div>
            </td>
						
            <td>
			<form class="form-inline">

			  <input type="email" class="input-small" id="email" name="email"  placeholder="Email">
			  <input type="password" class="input-small" placeholder="Password">    
            <button  class="btn">Log In</button>
			
  <a href="#" class="big-link" data-reveal-id="myModal">
            <button type="submit" class="btn">Sign Up</button>
			  </a>

<p style="color:#FF0000">   </p>  
  </form>    
        
		<div id="myModal" class="reveal-modal">
        
		    <table id="signup" border="0">
                <tr>
                    <td>
                        <br/>                    </td>   
                </tr>
                <tr>
                    <td><span id="sig">Sign Up</span></td>
                </tr>
                <tr>
                    <td style="color:#000000">It's free and always will be.</td>
                </tr>
                <tr>
                    <td>
                        <form method="post" action="">
                            <input type="text" name="username" id="username" placeholder="User Name" style="height:30px; width:200px;"> 
                          

                    </td>
                </tr>
                <tr>
                    <td>
                        <br/>                    </td>   
                </tr>   
                <tr>
                    <td>
 
                            <input type="email" name="email" id="email" placeholder="Email" style="height:30px; width:410px;">                    </td>
                </tr>
                <tr>
                    <td>
                        <br/>                    </td>   
                </tr>
                <tr>
                    <td style="color:#000000">
                                By clicking Sign Up, you agree to our Terms and that you have read <br/>our Data Use Policy, including our Cookie Use.                    </td>
                </tr>
                <tr>
                    <td>
                        <br/>                    </td>   
                </tr>
                <tr>
                    <td>

							<input type="submit" name="signup" id="signup" class="btn" value="Sign Up"/>
                        </form>
                    </td>
                </tr>
                </table>
            <p></p>
            <a class="close-reveal-modal">&#215;</a>        </div>
</form>
                </td>
        </tr>
    </table>
</div>

        
            <div id="letter-container" class="letter-container">
				<h2>
					<a >Grow with Groups...</a>
				</h2>
			</div>
		    <div href="#" id="bottom"> 
            <ul class="footer">
                <li><a href="#" class="menus">News</a></li>
                <li><a href="#" class="menus">Contact Us</a></li>
                <li><a href="#" class="menus">About Us</a></li>
                <li><a href="#" class="menus">Help Center</a></li>
            </ul>   
            <br/>
            <hr class="menus" style="margin-left:180px;margin-right:200px;"/>  
            <span id="copyright" class="menus">&copy Group:12. All copyrights reserved.</span>
        </div>  
        </div>
    </body>
</html>