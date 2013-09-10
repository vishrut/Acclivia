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

<html >
<head>


<title>Acclivia</title>
<link href="assets/css/resumee.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"></link>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"></link>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.css"></link>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.min.css"></link>


<!--<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis|Niconne' rel='stylesheet' type='text/css' />-->
</head>
<body>
	 <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container">
       <!-- PHP code for fetching image , name and email id -->
      <?php include_once("connect.php"); 
    if (isset($conn)) 
        {
        $result = mysql_query("SELECT * FROM user WHERE user_id = '$u_id' ");
        
        while($row = mysql_fetch_array($result))
          {
          $name = mysql_real_escape_string ($row['name']);
          $email = mysql_real_escape_string ($row['premail_id']);
          $img_path = mysql_real_escape_string ($row['image']);
          $gender = mysql_real_escape_string ($row['gender']);
          }
        } 



  
  if(isset($_POST['submit']))
   {
    if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password']))
    {
      $result = mysql_query("SELECT * FROM user WHERE user_id = '$u_id' ");
      $row = mysql_fetch_array($result);
      $opswd = mysql_real_escape_string($row['pswd']);    
      
      $oldpassword = mysql_real_escape_string ($_POST['old_password']);
      $oldpassword = md5($oldpassword);
      
      if($oldpassword == $opswd)
      { 
        
          $newpassword = mysql_real_escape_string ($_POST['new_password']);
          $newpassword = md5($newpassword);
          $confirmpassword = mysql_real_escape_string ($_POST['confirm_password']);
          $confirmpassword = md5($confirmpassword);
          if($confirmpassword == $newpassword)
          {
            $result1 = mysql_query("update user set pswd = '$confirmpassword' where user_id='$u_id' ");       
          }
          else
          {
            echo 'Please enter similar password.';
          }
      }
      
      else
      {
        echo 'Old password missmatch.';
      }
    }
  }
  else
  {
    
  }
  
  ?>
    
      
       <!-- PHP code for fetching image , name and email id -->
       <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner" >
            <a class="brand" href="#"><img src="assets/img/acclivia.png" alt="Acclivia" width="170px" height="170px" ></a><!--the padding and margin are done so as to keep the Acclivia icon in its position-->
            <div class="nav-collapse collapse" style="padding-top:13px"><!--To allign the search bar and other options into the middle-->
              <ul class="nav">
                <form action="search.php" method="post" class="form-search">
                  <select name="search_type" style="width:80px; ">
                    <option value="name">Name</option>
                    <option value="group">Group</option>
                  </select>
          
                  <input name="search_text" style="height:30px; width:220px" type="text" placeholder="Search....">
                </form> 
              </ul>
              <ul class="nav pull-right">
                <li><a href="home.php"><i class="icon-home icon-white"></i>Home</a></li>
                <li><a href="my_groups.php">My Groups</a></li>
                <!--Le Dropdown starts-->
                <<li class="dropdown">
                  <a href="my_profile.php" class="dropdown-toggle" data-toggle="dropdown"><img src="images/prof/<?php
            if($img_path == '')
          {
            if($gender == 'M')
              echo('default_male.jpg');
            else if($gender == 'F')
              echo('default_female.jpg');
            else
              echo('default_unisex.jpg');
          }
          else
            echo $img_path;
          ?>"
          class="img-rounded" style="margin-top:-8px; height:35px; width:35px;"/>&nbsp; &nbsp; <?php echo $name; ?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <!--Do not change the whitespaces used(&nbsp;)please-->
                    <li> <a href="myprofile.php?id=<?php echo $u_id; ?>"> <?php echo $name; ?> &nbsp; </a></li><!--Actual name of the user-->
                    <li>&nbsp; <?php echo $email; ?> &nbsp;</li><!--His Email ID-->
                    <li class="divider"></li> 
                    <li><a href="editprofile.php">Edit Profile</a></li>
                    <li><a href="#changepass" data-toggle="modal">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                  </ul>
                </li>
                <!-- Le dropdown ends-->
                





              </ul>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
    </div><!-- /.navbar-wrapper -->

<!--le change pass modal starts-->

                <div id="changepass" class="modal hide fade" aria-hidden="true">
                  
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 id="myModalLabel">Change Password</h3>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="">
                    <br>
                    Old Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="old_password" class="input-medium" placeholder="Old Password">
                    <br>
                    New Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="new_password" class="input-medium" placeholder="New Password">
                    <br>
                    Confirm Password:&nbsp;&nbsp;<input type="password" name="confirm_password" class="input-medium" placeholder="Confirm Password">
                    
                    
                  </div>
                  <div class="modal-footer">
                    <input class="btn btn-success" type="submit" name="submit" value="Save Changes">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    </form>
                  </div>


                </div>
<!--le change pass modal finishes -->
<br>
<br>
<br>
<br>
<br>
<br>
    <?php include_once("connect.php"); 
	if(isset($conn))
	{
		$result=mysql_query("select * from user where user_id='$_GET[id]'");
		while($row = mysql_fetch_array($result))
				{
					$name = mysql_real_escape_string ($row['name']);
					$email = mysql_real_escape_string ($row['premail_id']);
					$img = mysql_real_escape_string ($row['image']);
					$org = mysql_real_escape_string ($row['org_name']);
					$contact= mysql_real_escape_string($row['contact']);
					$dob= mysql_real_escape_string($row['dob']);
					$abt=mysql_real_escape_string($row['about_me']);
					$gender= mysql_real_escape_string($row['gender']);
					$org_desg= mysql_real_escape_string($row['org_desg']);
				}
	}
	?>
	<div class="row" style="padding-left:140px; margin-top:-7.5%;">
		<div class="span16">
		
				<div class="row" style="padding-left:130px;">
					<div class="span12" >
						<div class="top">
							<div class="logo pull-left">
								<h2><?php echo $name; ?></h2>
							</div>
						</div>
						
						<div class="middle active" id="profile" style="display: block;">
							<div class="row-fluid">
								<div class="span6 basic-info">
									<img src="images/prof/<?php
										if($img == '')
										{
											if($gender == 'M')
												echo('default_male.jpg');
											else if($gender == 'F')
												echo('default_female.jpg');
											else
												echo('default_unisex.jpg');
										}
										else
											echo $img;
									  ?>" class="main-image img-circle pull-left">
									<div class="main-info pull-left">
										<h1><?php echo $org; ?></h1>
										<p>
											 <?php echo $org_desg; ?>
										</p>
									</div>
				<!-- /.main-info -->
									<div class="clearfix">
									</div>
									<div class="secondary-info">
										<p>
											 <?php echo $abt; ?>
										</p>
									</div>
					<!-- /.secondary-info -->
								</div>
				<!-- /.span6 -->
		<div class="span6 personal-info">
			<dl class="dl-horizontal">
					<div class="span12">
						<div class="span5">
							<div class="kk">
              &nbsp;
							<span class="label label-inverse">Organisation:</span>
						</div><!-- end of kk-->
						<br>
            <br>
</div><!--end of span 3-->
						<div class="ka">
                           <?php echo "&nbsp;&nbsp;".$org; ?>
						</div>
					</div><!-- end of sapn12-->	
<!--xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->
							
					
		<div class="span12">
						<div class="span5">
							<div class="kk">
							<span class="label label-inverse">Position:</span>
						</div>
						<br>
            <br>
</div><!--end of span 3-->
						<div class="ka">
                   <?php echo $org_desg;  ?>
						</div>
					</div><!-- end of span12-->
<!--xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->	
<div class="span12">
						<div class="span5">
							<div class="kk">
							<span class="label label-inverse">Mobile Number:</span>
						</div>
						<br>
            <br>
</div><!--end of span 3-->
						<div class="ka">
                         <?php echo $contact; ?>
						</div>
					</div><!-- end of span12-->
<!--xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->	
					<div class="span12">
						<div class="span5">
							<div class="kk">
							<span class="label label-inverse">Email:</span>
						</div>
						<br>
            <br>
</div><!--end of span 3-->
						<div class="ka">
                        <?php echo $email; ?>   
                            
						</div>
					</div><!-- end of span12-->
<!--xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->	
<div class="span12">
						<div class="span5">
							<div class="kk">
							<span class="label label-inverse">Date of Birth:</span>
						</div>
						<br>
            <br>
</div><!--end of span 3-->
						<div class="ka">
                           <?php echo $dob; ?>
						</div>
					</div><!-- end of span12-->

									</dl>
								</div>
				<!-- /.span6 -->
							</div>
			<!-- /.row-fluid -->
						</div><!--middle active-->
					</div><!--span 12-->
				</div><!-- end of row-->
	  
		</div> <!--le span 8 finishes-->
      
    </div><!--/ Le row finishes-->
    <br>
    <br>
    <br>
    <br>
    <br>
	<?php include_once("footer.php"); ?>

<script src="assets/js/jquery-1.7.1.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
   
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="assets/js/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="assets/js/j_slide.js"></script>
    <script src="assets/js/demo.js"></script>
<script src="assets/js/jquery-1.8.3.min.js"></script>
<script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="assets/js/jquery-1.7.1.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
	 <script type="text/javascript" src="assets/js/j_slide.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-fileupload.js"></script>
    <script>
      $('.dropdown-toggle').dropdown()
    </script>
    <script>  
      $('#pin').tooltip()
      $('#tooltip_tasks').tooltip()
      $('#tooltip_files').tooltip()
      $('#tooltip_live').tooltip()
      $('#tooltip_meeting').tooltip()
    </script> 

</body>
</html>