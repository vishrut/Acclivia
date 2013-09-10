<?php
session_start();
if(isset($_SESSION['user_id']))
  {
  //$u_id=$_SESSION['user_id'];
  header("location:home.php");
  }

$error_message = "";
include_once("includes/connect.php");

//Sign-up

if(isset($_POST['signup'])){
	$error = array();
	
	//username
	if(empty($_POST['name'])){
		$error[] = 'Please enter your name. ';
	}else if( preg_match("/\w* ?\w+/",($_POST['name'])) ){
		$name = mysql_real_escape_string($_POST['name']);
	}else{
		$error[] = 'Name must consist of letters, numbers or spaces only. ';
	}
	
	//email
    if(empty($_POST['email'])){
        $error[] = 'Please enter your email. ';
    }else if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])){
		$email = mysql_real_escape_string($_POST['email']);
    }else{
		$error[] = 'Your e-mail address is invalid. ';
    }
	
	//password
    if(empty($_POST['password'])){
        $error[] = 'Please enter your Password. ';
    }else {
		$password = mysql_real_escape_string($_POST['password']);
		$password = md5($password);
    }
	
	//password
    if(empty($_POST['password2'])){
        $error[] = 'Please Confirm Password. ';
    }else {
		$password2 = mysql_real_escape_string($_POST['password2']);
		$gendr = mysql_real_escape_string($_POST['gender']);
		$password2 = md5($password2);
		if($password!=$password2)
		{
			        $error[] = 'Password MissMatch. ';
		}
    }
	
	
	
	
	if (empty ($error)){
			$result = mysql_query("SELECT * FROM user WHERE premail_id='$email'") or die (mysql_error());
			if (mysql_num_rows($result)==0){
				$activation = md5(uniqid(rand(), true));
				$result2 = mysql_query("INSERT INTO temp_login (name,primary_email,password,activation,gender) VALUES('$name','$email','$password','$activation','$gendr') ") or die (mysql_error());
					if(!$result2){
						die('Could not insert into database: '.mysql_error());
					}else {
						$message = "To Activate your account please Click on this link: \n\n";
						$message .= "http://acclivia.com".'/active.php?email='.urlencode($email)."&key=$activation";
						$to = $email;
						$subject = "Registration Confirmation";
						$from = "acclivia@google.com";
						$headers = "From:" . $from;
						mail($to,$subject,$message,$headers);
						
						header('Location: prompt.php?x=10&email='.urlencode($email).'&key='.$activation);
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

//Sign up ends

//Sign-in

if(isset($_POST['signin'])){
	$error= array();
	
	//email		
	if(empty($_POST['email'])){
			$error[]='Please enter a email. ';
	}	else {
			$email = mysql_real_escape_string($_POST['email']);
	} 	
	
	//password
	if(empty($_POST['password'])){
		$error[]='Please enter a password. ';
	}	else {
			$password = mysql_real_escape_string ($_POST['password']);
			$password = md5($password);
	}	
	
	if (empty ($error)){
			$result = mysql_query("SELECT * FROM user WHERE premail_id ='$email' AND pswd	='$password' ")
			or die (mysql_error());
			if (mysql_num_rows($result)==1){
				while($row = mysql_fetch_array($result)){
					$_SESSION['user_id'] =  $row['user_id'];
					$sex = mysql_real_escape_string($row['gender']);
					if($sex==NULL)
					{
						?>
                        <meta http-equiv="refresh" content="0;URL=editprofile.php">
						<?php
					}
					else
					{
						?>
                        <meta http-equiv="refresh" content="0;URL=home.php">
						<?php
					}
					
				}
		}else{
			$error_message ='<span class="error"> Email or password is incorrect </span> <br /> <br />' ;
		}
		}else{
		$error_message ='<span class="error">' ;
			foreach($error as $key => $values) {
				$error_message.= "$values";
			}
		$error_message.="</span> <br/><br/>";
	}
}


if(isset($_POST['reset_pwd'])){
	$error= array();
	
	//email		
	if(empty($_POST['email'])){
			$error[]='Please enter a email. ';
	}	else {
			$email = mysql_real_escape_string($_POST['email']);
	} 	
	
	if (empty ($error)){
		$result = mysql_query("SELECT * FROM user WHERE premail_id ='$email'")
		or die (mysql_error());
		if (mysql_num_rows($result)==1){
			$row = mysql_fetch_array($result);
			//assign a random password of length 9
			$new_pwd = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 8)), 0, 9);
			$new_pwd_md5 = md5($new_pwd);
			$updated = mysql_query("UPDATE user SET pswd= '$new_pwd_md5' WHERE premail_id = '$email'");
			if(!$updated){
				die('Could not insert into database: '.mysql_error());
			}else {
						$message = "Here is your new password: ".$new_pwd;
						$message .= "http://acclivia.com".'/active.php?email='.$new_pwd;
						$to = $email;
						$subject = "Change Password";
						$from = "acclivia@google.com";
						$headers = "From:" . $from;
						mail($to,$subject,$message,$headers);
						header('Location: prompt.php?x=11&pswd='.$new_pwd);
			}
		}
		else{
			$error_message ='<span class="error"> Email you entered is not registered !</span> <br /> <br />' ;
		}
		}else{
		$error_message ='<span class="error">' ;
			foreach($error as $key => $values) {
				$error_message.= "$values";
			}
		$error_message.="</span> <br/><br/>";
	}
}

//Forgot Password ends

?>



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Acclivia-Grow with Groups</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="stylesheet/theme.css">
    <link rel="stylesheet" type="text/css" href="stylesheet/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="stylesheet/animate.css">
    <link rel="stylesheet" type="text/css" href="stylesheet/css">
     <link rel="stylesheet" type="text/css" href="assets/css/validation.css">
	<script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/theme.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script>

	function validate_me(form) {
 	 var e = form.elements;
  if(e['password'].value != e['password2'].value) {
    alert('Your passwords do not match. Please type more carefully.');
    return false;
  }
  return true;
}
	

    </script>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <title>Acclivia-Grow with Groups</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="stylesheet/theme.css">
    <link rel="stylesheet" type="text/css" href="stylesheet/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="stylesheet/animate.css">
    <link rel="stylesheet" type="text/css" href="stylesheet/css">
     <link rel="stylesheet" type="text/css" href="assets/css/validation.css">
  <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/theme.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script>

  function validate_me(form) {
   var e = form.elements;
  if(e['password'].value != e['password2'].value) {
    alert('Your passwords do not match. Please type more carefully.');
    return false;
  }
  return true;
}
  

    </script>
</head>
<body>
    <a href="#" class="scrolltop">
        <span>up</span>    </a>
    <!-- begins navbar -->
  <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner" style="padding-left:20px; padding-right:20px">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <a class="brand scroller" data-section="body" href="#">
                <img src="images/acclivia2.png" alt="logo">
            </a>
        <div class="nav-collapse collapse">
                <ul class="nav pull-right">
          <li style="color:#FF6666"><?php echo $error_message;?></li>
          <li style="color:#FF6666"></li>
                    <li><a href="#" class="scroller" data-section="#features">Features</a></li>
                    <li>
        
                        <a href="#signinmodal" role="button" class="btn btn-header" data-toggle="modal">Sign In</a>
          </li>
                    <li>
                        <a href="#signupmodal" role="button" class="btn btn-header" data-toggle="modal">Sign Up</a>
          </li>
                </ul>
          </div>
      </div>
    </div>
    <!-- ends navbar -->

<!--Le signin modal-->
              <div id="signinmodal" class="modal hide fade" aria-hidden="true">
                <div class="modal-header">
                  <h3>Sign In</h3>
                </div>
                <div class="modal-body">
                  <form  method="post" action="" id='loginform' >
                      <label>Email ID:</label>
                      <input type="email" name="email" id="email" placeholder="Email ID" required title="Enter Valid Email!"
                      pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)"> <br>
                      <label>Password</label>
                      <input type="password" name="password"  placeholder="Password" class="input-small" pattern="^[A-Za-z0-9!@#$%^&*()_]{6,30}" required title="Atleast 6 characters!"><br>
                    <input type="submit" name="signin" id="signin" class="btn btn-success"  aria-hidden="true" value="Sign In"/>
          </form>
          <a href="#forgotpwd_modal" role="button" class="big-link" data-toggle="modal">Forgot Password?</a>
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
<!--Le signin modal finishes-->

<!--Le signup modal-->
              <div id="signupmodal" class="modal hide fade" aria-hidden="true">
                <div class="modal-header">
                  <h3>Sign Up</h3>
                </div>
                <div class="modal-body">
                  <form method="post" action="login.php" id='signupForm' onsubmit="return validate_me(this);">
                      <label>Name:</label>
                      <input type="text"  pattern="^[A-Za-z]{2,30}"  name="name" id="name" placeholder="Your name" required title="Only Alphabets allowed!" ><br>
                      Gender:
                      <br>
                      <select name="gender">
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                      </select>
                      
             <label>Email ID:</label>
                      <input type="email" name="email" id="email" placeholder="Email" required title="Enter Valid Email!"
                      pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)"
                      >
                      <br>
             <label>Password:</label>
            <input type="password" name="password" id="password" placeholder="Password"  pattern="^[A-Za-z0-9!@#$%^&*()_]{6,30}" required title="Atleast 6 characters!"><br>
                      <label>Confirm Password:</label>
              <input type="password" name="password2" id="password2" placeholder="Confirm Password" class="required"><br>           
          <input type="submit" name="signup" id="signup" class="btn btn-success"  aria-hidden="true" value="Sign Up" /> 
          </form>
                </div>
                <div class="modal-footer">
        </div>
              </div>
<!--Le signup modal finishes-->

<!--Le forgotpwd_modal -->
              <div id="forgotpwd_modal" class="modal hide fade" aria-hidden="true">
                <div class="modal-header">
                  <h3>Forgot Password? <br/></h3>
          <h4>You new password is just one click away..!</h4>
                </div>
                <div class="modal-body">
          <p>Enter your registered email-id below. <br/>
            Your new password will be mailed to you.<br/>
          Do not forget to personalize your password once you re-login</p>
                  <form  method="post" action="" id='forgotpass' >
                      <label>Email ID:</label>
                      <input type="email" name="email" id="email" placeholder="Email ID" required title="Enter Valid Email!"
                      pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)" ><br>
                    <input type="submit" name="reset_pwd" id="reset_pwd" class="btn btn-success"  aria-hidden="true" value="Reset Password"/>
          </form>
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
<!--Le forgotpwd_modal finishes-->
<br>
<br>
<br>
<br>
<br>
<br>

<!--Le main page starts-->
    <center>
      <h1 style="font:Georgia, 'Times New Roman', Times, serif">Acclivia: Project Manager</h1></center>
    <!--le carousel finishes-->
    <div id="intro">
        <div class="container">

            <h1>Acclivia helps you in managing projects in a timely and cost effective manner</h1>
        </div>
    </div>

    <!-- features -->
    <div id="features">
        <div class="container">
        <!-- header --><!-- feature list --></div>
    </div>

    <!-- starts testimonial -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- starts footer -->
    
    <div class="navbar navbar-inverse fixed-bottom" style="margin-bottom: -40px;"><!--to restrict the bottom navbar to the bottom of the page-->
      <div class="navbar-inner">
          <div class="container">
              <div class="row">
                <div class="span12">
                    <a href="#sitemap">Sitemap</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#terms">Terms and conditions</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#help">Help</a>
                </div>
                <div class="span4">
                    <h4 style="color:#ffffff">Acclivia</h4>                    
                    <p style="color:#ffffff">Web Programming Group-18</p>
                    <p style="color:#ffffff">DAI-ICT</p>
                    <p style="color:#ffffff">Gandhinagar- 382-007</p>
                    <p style="color:#ffffff">Gujarat</p>
                    <p style="color:#ffffff">India</p>
                </div>
            </div>
          </div>    
      </div>
    </div>


</body>
</html>