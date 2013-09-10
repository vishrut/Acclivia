<?php 
include("includes/connect.php");
$s_type = $_POST['search_type'];
$s_box = $_POST['search_text'];

?>
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
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-fileupload.css" rel="stylesheet">

    <!--Le styles end-->

    <!--Le favicons-->
     <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                       <link rel="shortcut icon" href="assets/ico/favicon.png">
    <!--Le favicons ends-->
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
<br>
<br>
<br>
<br>
<br>
<br>

    <div class="row" style="padding-left:40px;">
      <div class="span12">
        <div class="hero-unit" style="font-size: 15px; line-height: 0px;">
         
         <table class="table">
         <tr>
         <td colspan="2"> <h3><b> Search Results for "<?php echo $s_box; ?>" </b></h3></td>
         </tr> 			
<?php 
if($s_type=='name')
{
$result = mysql_query("SELECT * FROM user ") or die (mysql_error());
       	$ans = "";
          while($row = mysql_fetch_array($result))
		  {
		  	$temp = $row['name'];
			$temp = strtolower($temp);
			$s_box = strtolower($s_box);
			$uid = $row['user_id'];
			if (strpos($temp,$s_box) !== false) {
				$ans =  "<a href=myprofile.php?id=$uid>".$row['name'].'</a>';	
			//	echo "came";	
			?>
            
            <tr>
            	<td rowspan="3" valign="bottom" align="center">
            <?php
			
				
			$result2 = mysql_query("SELECT * FROM user WHERE user_id = '$uid' ");
				
				$row2 = mysql_fetch_array($result2);
					
					$name = $row2['name'];
					$email = $row2['premail_id'];
					$img_path = $row2['image'];
					$gender = $row2['gender'];
					$org = $row2['org_name'];
					
			
			?>
		
			<a style="text-decoration:none" href="myprofile.php?id=<?php echo $uid; ?>" > <img src="images/prof/<?php
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
                      class="img-rounded" style="margin-top:-8px; height:70px; width:70px;"/>&nbsp; &nbsp; 
                    </a>
                  </td>
 				<td><?php echo $ans; ?></td>
                <tr>
                <td><?php echo $email; ?></td>
                </tr>
                <tr>
                <td><?php echo $org; ?></td>
				</tr>
			
			<td>
            <?php
			
			}
            
      }
	  if($ans=="")
	  {
	  	$ans = "No result Found";
	  }
	
}
else
{
	$result = mysql_query("SELECT * FROM groups ") or die (mysql_error());
       	$ans = "";
          while($row = mysql_fetch_array($result)){
		  	$temp = $row['grp_name'];
			$temp = strtolower($temp);
			$s_box = strtolower($s_box);
			if (strpos($temp,$s_box) !== false) {
				$ans =  $row['grp_name'];	
			//	echo "came";	
			?>
			
			<tr>
           
            <?php
			
				
			$result2 = mysql_query("SELECT * FROM groups WHERE grp_id = $row[grp_id] ");
				
				$row2 = mysql_fetch_array($result2);
					
					$row2['grp_name'];
					
			?>
		
 				<td><a href="check.php?id=<?php echo $row['grp_id']; ?>"> <?php echo $ans; ?> </a></td>
                <tr>
            <?php
			
			}
            
      }
	  if($ans=="")
	  {
	  	$ans = "No result Found";
	  }

}
?>
		</td>

 			</tr>                    
		 </table>
        	
      <!--le sidebar starts-->

      
    </div><!--/ Le row finishes-->
   </div></div>
  <?php include_once("footer.php"); ?>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-1.7.1.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="assets/js/j_slide.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-fileupload.js"></script>
    <script>
      $('.dropdown-toggle').dropdown()
    </script>
    <script>  
      $('#pin1').tooltip()
      $('#pin2').tooltip()
      $('#pin3').tooltip()
      $('#livepin1').tooltip()
      $('#livepin2').tooltip()
      $('#livepin3').tooltip()
      $('#tooltip_tasks').tooltip()
      $('#tooltip_files').tooltip()
      $('#tooltip_live').tooltip()
      $('#tooltip_meeting').tooltip()
    </script> 
  </body>
</html>
