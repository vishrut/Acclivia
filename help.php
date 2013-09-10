<?php 
	session_start();
	if(isset($_SESSION['user_id']))
	{
	$u_id=$_SESSION['user_id'];
	}
	else{
		
		header("location:login.php");
		die();
	 }
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Acclivia-Grow with Groups</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" media="screen" />
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--This padding is to ensure that the responsiveness is maintained when the window size is changed-->
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
     <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                       <link rel="shortcut icon" href="assets/ico/favicon.png">
									   
	 <script type="text/javascript" src="assets/js/jquery-1.4.2.min.js">
        </script>
        <script type="text/javascript" src="assets/js/scripts.js">
        </script>
        </script>
    
  </head>

  <body>
        <!-- NAVBAR
    ================================================== -->
    <?php include_once("header.php");?>
    <div class="container">

      <!-- Example row of columns -->
      <div class="row">
        <div class="span10">
          <h2>Site Map</h2>
          <br>
		  <div id="listContainer">
				<div class="listControl">
					<a id="expandList">Expand All</a>
					<a id="collapseList">Collapse All</a>
				</div>
				<ul id="expList">
				<li>
					Login
					<ul>
					<li> <span> 1)	Type the URL of the website. </span> </li>
					<li> <span> 2)	Enter the email id and password. </span> </li>
					<li> <span> 3)	Click the login button.</span> </li>
					</ul>
				</li>
				<li>
					Forgot Password
					<ul>
					<li> <span> 1)	Type the URL of the website. </span> </li>
					<li> <span> 2)	Click on the link of forget password. </span> </li>
					<li> <span> 3)	Type the email id. </span> </li>
					<li> <span> 4)	Click on the send password button. </span> </li>
					</ul>
				</li>
				<li>
					Create/Mange groups
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	Click on create group link. </span> </li>
					<li> <span> 3)	After filling out the necessary details, click on the manage button to manage the group. </span> </li>
					</ul>
				</li>
				<li>
					Search a group
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	Type the name of the group you want to search in the search bar. </span> </li>
					<li> <span> 3)	Click on the search button. </span> </li>
					</ul>
				</li>
				<li>
					Create/Edit user account
					<ul>
					<li> <span> 1)	Type the URL of the website. </span> </li>
					<li> <span> 2)	Click on sign up button. </span> </li>
					<li> <span> 3)	Fill out the necessary details. </span> </li>
					</ul>
				</li>
				<li>
					Add/update Task/Event/Activity
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	Click on the calendar icon. </span> </li>
					<li> <span> 3)	Go to the date on which user wants to add an event/task/activity. </span> </li>
					<li> <span> 4)	Fill up the details about new event in which alarm will be an optional function. User can also add notes. </span> </li>
					</ul>
				</li>
				<li>
					Create a reminder
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	Clicks on an option to create a reminder. </span> </li>
					<li> <span> 3)	Fill up the necessary data. </span> </li>
					</ul>
				</li>
				<li>
					Create a Group Meeting/Group chat
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	You must be the group administrator of the group. </span> </li>
					<li> <span> 3)	Group Administrator clicks on an option to call a meeting. </span> </li>
					<li> <span> 4)	Group admin fills the data. </span> </li>
					</ul>
				</li>
				<li>
					Sitemap/ Help
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	Click on the Sitemap link or the help link. </span> </li>
					</ul>
				</li>
				<li>
					File Storage
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	Click the upload file button. </span> </li>
					<li> <span> 3)	Upload a file through browse button. </span> </li>
					</ul>
				</li>
				<li>
					Search a User
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	Click on the search user button. </span> </li>
					<li> <span> 3)	Fill up the necessary data and click the search button. </span> </li>
					</ul>
				</li>
				<li>
					Send Message to a User
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	Click on send a message feature. </span> </li>
					<li> <span> 3)	Fill up the recipient email id and the message body. </span> </li>
					<li> <span> 4)	Click on the send message button.</span> </li>
					</ul>
				</li>
				<li>
					Logout
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	Click on the logout button. </span> </li>
					</ul>
				</li>
				<li>
					Profile Approval (For Administrators)
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	The user should be the group admin. </span> </li>
					<li> <span> 3)	Go to the request area of the group page. </span> </li>
					<li> <span> 4)	Select the appropriate option for a particular user�s request. </span> </li>
					</ul>
				</li>
				<li>
					Edit/ Delete Group (For Administrators)
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	The user should be the group admin. </span> </li>
					<li> <span> 3)	Go to an option where the user can edit the group details. </span> </li>
					<li> <span> 4)	The user can also delete the group. </span> </li>
					</ul>
				</li>
				<li>
					Assigning a job (For Administrators)
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	The user should be the group admin. </span> </li>
					<li> <span> 3)	Go to the section where the group admin can assign a job to a user in his/her group. </span> </li>
					<li> <span> 4)	Enter the necessary fields for that particular task. </span> </li>
					</ul>
				</li>
				<li>
					Pass the privileges (For Administrators)
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	The user should be the group admin. </span> </li>
					<li> <span> 3)	Go to the section where the group admin can pass the privileges to a general user in that group circle. </span> </li>
					</ul>
				</li>
				<li>
					Add/Remove user in Group (For Administrators)
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	The user should be the group admin. </span> </li>
					<li> <span> 3)	Go to the section where the group admin can add users to the group or remove users from the group. </span> </li>
					<li> <span> 4)	Enter the name of the user and the appropriate option for that user. </span> </li>
					</ul>
				</li>
				<li>
					Backup the Data (For Administrators)
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	The user should be the group admin. </span> </li>
					<li> <span> 3)	Click the backup data link. </span> </li>
					</ul>
				</li>
				<li>
					Restore (For Administrators)
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	The user should be the group admin. </span> </li>
					<li> <span> 3)	Click the restore data link </span> </li>
					</ul>
				</li>
				<li>
					Live Text Editor (For Administrators)
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	The user should be the group admin. </span> </li>
					<li> <span> 3)	Start a meeting. </span> </li>
					<li> <span> 4)	Click the live text editor option. </span> </li>
					</ul>
				</li>
				<li>
					Sending a mass Message (For Administrators)
					<ul>
					<li> <span> 1)	Login to the website with the email id and password. </span> </li>
					<li> <span> 2)	The user should be the group admin. </span> </li>
					<li> <span> 3)	Click on the send mass message link. </span> </li>
					<li> <span> 4)	Enter the message content. </span> </li>
					<li> <span> 5)	Click on the send button. </span> </li>
					</ul>
				</li>
				</ul>
			</div>
        </div>
        
        
      </div>

      <hr>
</div>
    <?php include_once("footer.php"); ?>
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="assets/js/jquery-1.7.1.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="assets/js/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="assets/js/j_slide.js"></script>
    
  </body>
</html>
