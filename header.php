
        <!-- NAVBAR
    ================================================== -->
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
					$name = $row['name'];
					$email = $row['premail_id'];
					$img_path = $row['image'];
					$gender = $row['gender'];
					}
				} 



  
  if(isset($_POST['submit']))
   {
    if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password']))
    {
      $result = mysql_query("SELECT * FROM user WHERE user_id = '$u_id' ");
      $row = mysql_fetch_array($result);
      $opswd = $row['pswd'];    
      
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
          
                  <input name="search_text" style="height:20px" type="text" placeholder="Search....">
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


    <br><!--to bring the container down-->
    <br><!--to bring the container down-->
    <br><!--to bring the container down-->
    <br><!--to bring the container down-->
    <br><!--to bring the container down-->
    <br><!--to bring the container down-->

    
    <!--Le main row starts here-->
