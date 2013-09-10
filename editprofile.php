<?php include_once("includes/check_session.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Acclivia-Grow with Groups</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"></link>

<link rel="stylesheet" href="assets/css/editprofile.css" />
<link rel="stylesheet" type="text/css" href="assets/css/view.css" media="all">
<script src="assets/js/jquery-latest.js"></script>

<script type="text/javascript" src="assets/js/view.js"></script> 

   <link href="assets/css/suggest.css" rel="stylesheet">
    	<script src="assets/js/jquery-1.7.1.min.js"></script>   
    	<script src="assets/js/bootstrap.js"></script>



    <!--Le typeahead ends-->
    <style>
    .input-small {
     width: 230px;
}

    </style>
  
      <script src="assets/js/suggest.js"></script>

</head>
<body><!-- body Starts-->
  <?php include_once("header.php"); 
	include_once("connect.php");
					if(isset($conn))
					{
						$result=mysql_query("select * from user where user_id='$u_id'");
						while($row = mysql_fetch_array($result))
						{
							$name = $row['name'];
							$pemail = $row['premail_id'];
							$img = $row['image'];
							$org = $row['org_name'];
							$contact= $row['contact'];
							$abt=$row['about_me'];
							$dob= $row['dob'];
							$gender= $row['gender'];
							//$pos= mysql_real_escape_string($row['Position']);
							//$semail= mysql_real_escape_string($row['sremail_id']);
							//$tz =  mysql_real_escape_string($row['timezone']);
							$desg =  $row['org_desg'];
						}
					}
	?>      
  
    <div class="row" style="padding-left:40px;">
      <div class="span12">
        <div class="hero-unit" style="font-size: 13px; line-height:5px; overflow:hidden;">
<div class="container">
<div class="container-fluid">
  <div class="row-fluid">
        <div class="span2">
      <!--Sidebar content-->
      <!--only image-->
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
				  ?>" class="img-polaroid" alt="Profile Picture">
 <div class="dropdown"><br><br>
                  <a href="#profile" class="dropdown-toggle" data-toggle="dropdown">Upload Picture<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#"><section id="file-input">
                
                    <form method="post" enctype="multipart/form-data" ><!-- file input-->
                       <p>File Input: <input type="file" name="name" id="name">
                       <input type="submit" name="add" value="submit" class="btn btn-success" ></p>
                    </form>
              <?php 
				include_once("connect.php");
				if(isset($_POST['add']) )
				{
					$image_Arr = $_FILES['name'];
					move_uploaded_file($image_Arr['tmp_name'],'images/prof/' .$image_Arr['name']);
					$i1 = $image_Arr['name'];
					$insert_data = " update user SET image='$i1' where user_id='$u_id' ";
					if(!mysql_query($insert_data,$conn))
					{
						die("Error:".mysql_error());
					}
					else
					{
						//header("location:editprofile.php");
						?><meta http-equiv="refresh" content="0;URL=editprofile.php"> <?php
							
					}
				}

	?>

            </section></a></li>
                    
                  </ul>
                

   </div><!--end of class drop down-->
    </div><!--end of span 2-->
    <div class="span10" style="text-align:left;">
      <!--Body content-->
      
<!--xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->
<div class="span12">
<form method="post" enctype="multipart/form-data">
<table>
<col width="50%" />
    <col width="250px" />
  <tr><td><h3><u>Personal Details.<u></h3></td></tr>
  <tr><td><h4>Name:<h4></td>
  	<td> <input id="firstname"  type="text" size="30" class="reqd name" Placeholder="Name" value="<?php echo $name;?>" name="name" required/> 
  </td>
</tr>
  <tr>
  <td><h4>Date of Birth </h4></td>
  <td> <input type="date" name="dob" id="dob" value="<?php echo date('m/d/Y',strtotime($dob)) ?> " required /> </td>
  </tr>
  <tr><td><h3><u>Contact Detail</u></h3></td></tr>
  <tr><td><h4>Mobile Number</h4></td><td> <input id="number" name="contact" type="text" size="30" pattern="^[0-9]{10}"
  title="10 digits only" required value="<?php echo $contact;?>" />
  </td></tr>
  
    <tr><td><h3><u>Organization Details</u></h3></td></tr>
  <tr><td><h4>Organization Name:</h4></td><td> <input id="number" name="org" type="text" size="30"  value="<?php echo $org;?>" />
  </td></tr>
  <tr><td><h4>Organization Designation:</h4></td><td> <input id="emailAddr" name="desg" type="text" size="30"  value="<?php echo $desg;?>" />
    </td></tr>
   <tr><td><h4>About Me:</h4></td><td> <textarea name="abt" rows="5"><?php echo $abt;?></textarea></td></tr>
  </table>
  
<br><br><p><input type="submit" name="update" value="Update" class="btn btn-large btn-primary" /></p> 
</form>
	<?php 
					if(isset($_POST['update']))
					{
						$data = "update user SET name ='$_POST[name]', about_me='$_POST[abt]', dob='$_POST[dob]', org_name='$_POST[org]', contact='$_POST[contact]', org_desg='$_POST[desg]' where user_id='$u_id'";	
						
						if(!mysql_query($data,$conn))
						{
							die("Error".mysql_error());
						}
						else
						{
							//header("location:myprofile.php");
							?><meta http-equiv="refresh" content="0;URL=myprofile.php?id=<?php echo $u_id; ?>"> <?php
						
						}
					}
					
	?>
</div><!-- end of span10-->
    </div><!--end of span 12-->
  </div><!--end of row-fluid-->
</div><!-- end of container-fluid-->
</div><!--end of conatiner-->

        </div><!-- end of hero-unit-->
    </div><!--end of span12-->
    <?php include_once("sidebar.php"); ?>

</div><!--end of row-->
<?php include_once("footer.php"); ?>


  <script>  
	$(function()
	{
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
					document.getElementById('dob').value = new Date(xmlhttp.responseText).toJSON().slice(0,10);
				}
				}
			  xmlhttp.open("GET","getdate.php",true);
			  xmlhttp.send();
			  
	});
	
</script>

  <!--Le msg inbox modal-->
                    <div id="msgmodal" class="modal hide fade" aria-hidden="true">
                      
                  
                        
                     
                      <div class="modal-body">
                        <h5>User:</h5>
                        <div id="in_name"></div>
                        <hr>
                        <h5>Message Content:</h5>
                        <div id="in_content"></div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
                      </div>
                    </div>
    <!--Le msg inbox modal finishes-->  

     <!--Le msg outbox modal-->
                    <div id="msgoutboxmodal" class="modal hide fade" aria-hidden="true">
                      
                  
                        <ul class="breadcrumb">
                          <li><a href="#">Outbox</a> <span class="divider">/</span></li>
                          <li class="active">Message</li>
                        </ul>
                     
                      <div class="modal-body">
                        <h5>Message Receiver:</h5>
                        <div id="in_name"></div>
                        <hr>
                        <h5>Message Content:</h5>
                        <div id="in_content"></div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
                      </div>
                    </div>
    <!--Le msg outbox modal finishes--> 

    <script src="assets/js/sidebar.js"></script>

    <script >
    var temp=0;
     $(function() {  
      availableTags=new Array();
      var xmlhttp;

      
        
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
          var myvar = xmlhttp.responseText;
          availableTags = myvar;

            $( "#mytags" ).autocomplete({
           source: availableTags.split(",")
         });
        }
        }
      xmlhttp.open("GET","gethint.php",true);
      xmlhttp.send();
      });
   
    </script>


  </body>
</html>
