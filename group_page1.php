<?php
include_once("connect.php"); 
include_once("includes/check_session.php");

if(!isset($_GET['id']))
	{
		header("location:my_groups.php");
    	die();
	}
	else if(!empty($_GET['id']) && $_GET['id']!=NULL && $_GET['id']!='')
	{

		$cur_id = $_SESSION['user_id'];
	    $grp_id = mysql_real_escape_string($_GET['id']);
		
		$result3 = mysql_query("select * from groups where grp_id = '$grp_id' ");
		
		if(mysql_num_rows($result3)==1)
		{	   
		   $result2 = mysql_query("select * from belongs_to where grp_id= '$grp_id' and user_id= '$cur_id' ");
		   if(mysql_num_rows($result2)==1)
		   {
			    $row1 = mysql_fetch_assoc($result2);
				$role = $row1['role'];
				//		echo "$role";
				if($role=='0')
				{
				
					 header("location:member_page.php?id=$grp_id");
					die();            
				}
	  		}
	  		else
	   		{
		   		header("location:view_group.php?id=$grp_id");
				die();
			}	
	     }
		 
		else
		{
			header("location:my_groups.php");
			die();
		}
	}
	else
	{
		header("location:my_groups.php");
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
    
     <!--Le typeahead starts-->
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


    <!--Le favicons-->
     <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                       <link rel="shortcut icon" href="assets/ico/favicon.png">
    <!--Le favicons ends-->
  </head>

  <body>
       
	   <?php 
	   include_once("header.php") ;
	   
		if(isset($_POST['assign_t']))
		{
			?>

            <?php
			$task_id = $_POST['assign_t2'];
			$email_id = $_POST['assign_task'];
			$grp_id = $_GET['id'];
			$result2 = mysql_query("select * from user where premail_id= '$email_id' ");
			if(mysql_num_rows($result2)==1)
			{
				//echo mysql_num_rows($result2);
				$row1 = mysql_fetch_assoc($result2);
				$result3 = mysql_query("select * from belongs_to where grp_id = '$grp_id' and user_id= $row1[user_id]");
				if($result3)
				{	
				if(mysql_num_rows($result3)==1)
				{
					
					$result4 = mysql_query("INSERT INTO performs (user_id,task_id) values($row1[user_id],$task_id)");
					
					if($result4)
					{
						$invite = 'Hi,You have been assigned a task. Please find details <a href=group_page1.php?id='.$grp_id.'>Here</a>';
						$result5 = mysql_query("INSERT INTO message(sender_id,receiver_id,content) values('$u_id','$row1[user_id]','$invite')");
						if($result5)
						{ ?>
							<script>alert('Done!')</script>							
							<?php

						}
						
					}
					else
					{
						?>
                        <script>alert('Already Assigned this task!')</script>
                        <?php
					}	
				}
				else
				{?>
               		 <script>alert('User Is not in your Group!')</script>
                     <?php
					 
					//echo "User Already Exists!";
				}
				}
				else
				{?>
                	 <script>alert('Query error')</script>
                     <?php
					//echo "query errors";	
				}
			}
	else
	{?>
    
    	 <script>alert('Invalid Email')</script>
         <?php
		//echo "Invalid EmailID!";	
	}
	
}








	   if(isset($_POST['live_yes']))
		{
	  if(isset($_POST['livefilename']))
	  {
		  $lname = $_POST['livefilename'];
		  $random_name = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 8)), 0, 9);
		  $ggid = $_GET['id'];
		  $own_id = $_SESSION['user_id'];
	  $query="INSERT INTO livefiles(filename,random_key,group_id,owner_id) VALUES ('$lname', '$random_name','$ggid','$own_id')";
	  //$dataa= mysql_query($query); 
		  
	if(!mysql_query($query))
		{
		  echo "came here";
		  die("Error".mysql_error());
		}
		else
		{
			header("location:ether.php?f_id=$random_name");
		}
	  }
	}
	
	
	if(isset($_POST['done']))
	{
		header("location:group_page1.php?id=$_GET[id]");  
	}
	
	   ?>
		
       
    <div class="row" style="padding-left:40px;">
      <div class="span12">
        <div class="hero-unit" style="font-size: 15px;">
         
         <?php 
    		if (isset($conn)) 
				{
					$gid = $_GET['id'];
				$result = mysql_query("SELECT * FROM groups natural join belongs_to WHERE grp_id = $gid ");
				
				while($row = mysql_fetch_array($result))
					{
					$grp_name2 =  $row['grp_name'];
					$Gdesc =  $row['description'];
					}
				} 
			$result9 = mysql_query("select user_id from belongs_to where grp_id = $_GET[id] and role!=2");
			$arr9 = array();
   			while($row9 = mysql_fetch_assoc($result9))
			{
				$arr9[] = $row9['user_id'];
			}

			$result1 = mysql_query("select task_id from group_task where grp_id = $_GET[id] order by task_id DESC");
			$arr1 = array();
   			while($row1 = mysql_fetch_assoc($result1))
			{
				$arr1[] = $row1['task_id'];
			}
			
			$result2 = mysql_query("select file_id from files where grp_id = $_GET[id] order by file_id desc");
			$arr2 = array();
   			while($row2 = mysql_fetch_assoc($result2))
			{
				$arr2[] = $row2['file_id'];
			}
			
			$result3 = mysql_query("select meeting_id from meeting where grp_id = $_GET[id]");
			$arr3 = array();
   			while($row3 = mysql_fetch_assoc($result3))
			{
				$arr3[] = $row3['meeting_id'];
			}
			
			$result14 = mysql_query("select livefile_id from livefiles where group_id = $_GET[id] order by livefile_id desc ");
			$arr14 = array();
   			while($row14 = mysql_fetch_assoc($result14))
			{
				$arr14[] = $row14['livefile_id'];
			}
		?>
          <h3> <?php echo $grp_name2; ?> </h3>
           <a onClick="pin_group(<?php echo $_GET['id']?>)" href="#" id="pin1" data-toggle="tooltip" title="Add this to my Pinboard"><img src="assets/img/pin.png"></a>
          
		  <?php
          $result91 = mysql_query("select * from user natural join belongs_to where grp_id= $_GET[id] and role=2 ");
			while($row91 = mysql_fetch_assoc($result91))
			{
				$name10 = $row91['name'];
				$usr_id = $row91['user_id'];
			}	
		?>
         <hr>
         Group Admin :<a href="myprofile.php?id=<?php echo $usr_id; ?>"> <?php echo $name10; ?></a>
		
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

         
         <!--a href="timeline.php?gid=<?php /*echo $_GET['id'];*/ ?>" role="button" class="btn btn-small btn-info">Timeline</a-->
         <p></p>
        <p><?php echo $Gdesc ?></p>
         <hr>
          <form class="form-inline" style="margin-left:-100px">
              <label>
              <a id="tasks" style="color:inherit;"></a>
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#editgroup" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Edit Group</a>
              <a href="#deletegroup" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Delete Group</a>
           
              <a href="#addgroupmember" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Add new member</a>
                <a href="#massmessage" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Mass Message</a>
              <!--<a href="#deletegroupmember" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Delete member</a>-->
          </form>
          
          
            <!--Le edit group modal-->
          <div id="editgroup" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3>Edit Group</h3>
              </div>
              <div class="modal-body">
                <form method="post">
                    <label>Group Name : </label>
                    <input type="text" placeholder="" name="Gname" value=" <?php echo $grp_name2; ?>"/><br> 
                    <label>Group Description : </label>
                    <textarea rows="3" placeholder="" name="Gdesc"> <?php echo $Gdesc; ?></textarea>
              <div class="modal-footer">
                  <input class="btn btn-success" type="submit" name="edit_group" value="Save" />
                  <input class="btn" data-dismiss="modal" value="Close" style="width:50px"/>
              </div>
                    
                </form>
              </div>
          </div>
          
          

          <!--Le add group member modal-->
          <div id="addgroupmember" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3>Add New Member</h3>
              </div>
              <div class="modal-body">
                <form method="post">
                
                    <label>Email ID : </label>
                    <div class="form-inline">
                      <input type="text" placeholder="E-mail" name="e_id" id="invite_email"/>
                      <p class="btn btn-success"  name="add_group" onClick="addmember(<?php echo "$_GET[id]"?>)">Add</p>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                    </div>
              	<div class="modal-footer">
                  <input class="btn btn-success" type="submit" name="done" value="Done" />
              </div>
                    
                </form>
              </div>
          </div>
             
               <!--Le add group member modal-->
          <div id="massmessage" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3>Mass Message</h3>
              </div>
              <div class="modal-body">
                <form method="post">
                
                    <label>Message: </label>
                    <div class="form-inline">
                      <textarea placeholder="Message Text" name="message_text" id="message_text"></textarea>
                      <p class="btn btn-success"  name="mass_message" onClick="massmessage(<?php echo "$_GET[id]"?>)">Send</p>
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                    </div>
              	<div class="modal-footer">

              </div>
                    
                </form>
              </div>
          </div>
             
             
              <?php 
            			  if(isset($_POST['edit_group']))
            			  {
            				$query1="update groups set grp_name='$_POST[Gname]', description= '$_POST[Gdesc]' where grp_id='$_GET[id]' ";  
            				if(!mysql_query($query1,$conn))
            					{
            						die("Error".mysql_error());
            					}
            					else
            					{
            						header("location:group_page1.php?id=$_GET[id]");
            					}
            				}
            			  
			         ?>
            <!-- Le add group member button ends-->
           
            <!-- Le delete group vala danger button start-->
            

            <div id="deletegroup" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h3>Delete Group</h3>
              </div>
            <div class="modal-body">
              <p>Are you sure you want to delete the group?</p>
              <p>&nbsp;</p>
              <div class="modal-footer">
                <form method="post">
                 <input class="btn btn-danger" type="submit" name="yes" value="Yes" />
                 <input class="btn" data-dismiss="modal" value="No" style="width:25px"/>
                </form>
              </div>

             </div>
             </div> 
              <?php 
          			  if(isset($_POST['yes']))
          			  {
          				$query2="delete from groups where grp_id='$_GET[id]' ";  
          					if(!mysql_query($query2,$conn))
          					{
          						die("Error".mysql_error());
          					}
          					else
          					{
          						header("location:my_groups.php");
          					}
          				}
          				else if(isset($_POST['no']))
          				{
          					header("location:group_page1.php?id=$_GET[id]");
          				}
          			  
			     ?>
            <!--Le delete group end here RIP GROUP -->
            <!-- Le leave group button start-->
            <div id=" group" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h3>Leave Group</h3>
              </div>
            <div class="modal-body">
              <p>Are you sure you want to leave the group?</p>
              <p>&nbsp;</p>
              <div class="modal-footer">
                <form method="post">
                 <input class="btn btn-danger" type="submit" name="yes1" value="Yes" />
                 <input class="btn" data-dismiss="modal" value="No" style="width:25px"/>
                </form>
              </div>

             </div>
             </div> 
              <?php 
          			  if(isset($_POST['yes1']))
          			  {
          				$query3="delete from belongs_to where user_id = '$u_id' and grp_id= '$_GET[id]' ";  
          					if(!mysql_query($query3,$conn))
          					{
          						die("Error".mysql_error());
          					}
          					else
          					{
          						header("location:my_groups.php");
          					}
          				}
          				else if(isset($_POST['no']))
          				{
          					header("location:group_page1.php?id=$_GET[id]");
          				}
          			  
			     ?>
                 <!-- Le delete group button ends-->
              
            
              
          <hr>
          <!--Le Group Log-->
          <p><a href="#membermodal" id="tooltip_members" data-toggle="modal" title="Group Members"><?php echo sizeof($arr9) ; ?> Members</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#tasks" id="tooltip_tasks" data-toggle="tooltip" title="Group Tasks"><?php echo sizeof($arr1); ?> Tasks</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#upfiles" id="tooltip_files" data-toggle="tooltip" title="Group Files"><?php echo sizeof($arr2); ?> Files</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!--a href="#livedocs" id="tooltip_live" data-toggle="tooltip" title="Live Docs for Concurrent Editing"><?php /*echo sizeof($arr14); */?> Live Files</a-->    <hr>
          <!--Le Group Log Finishes-->
		  
          <!--Le member modal-->
          <div id="membermodal" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
               <h3>Members</h3>
              </div>
            <div class="modal-body">
           
			<?php 
        
    for($i=0;$i<sizeof($arr9);$i++)
    { 
      $result10 = mysql_query("select * from user natural join belongs_to where user_id = ".$arr9[$i]);
      $arr10 = array();
      $row10 = mysql_fetch_array($result10);
        $u_name = mysql_real_escape_string($row10['name']);
      
      ?>
            <div class="alert alert-info" style="margin-bottom:5px">
              <button type="button" class="close" data-dismiss="alert" onClick="kickmember(<?php echo $row10['user_id'].','.$_GET['id']?>)">&times;</button>
              <?php echo $u_name;?>
            </div>
	
      <?php 
    }
      ?>
<br>
<hr>            
            
    <button class="btn btn-success" name="save1" onClick="document.location.reload(true)">Done</button>

            </div>
          </div>

		  <!-- Le member finished-->          
          <!--Le Tasks-->
          <form class="form-inline">
              <label>
              <h4><a href="group_tasks.php?id=<?php echo $grp_id; ?>"  id="tasks" style="color:inherit;">Tasks</a></h4>
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#taskmodal" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Add new Tasks</a>
          </form>

          <!--Le add new task modal-->
          <div id="taskmodal" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
               <h3>Add new task...</h3>
              </div>
            <div class="modal-body">
              <form method="post">
                  <label>Task Name</label>
                  <input type="text" placeholder="Type something…" name="tname"/><br> 
                  <label>Start Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  Deadline Date</label>

                  <input type="datetime-local" class="input-big" placeholder="start date" name="tsd"/>
                  <input type="datetime-local" class="input-big" placeholder="deadline date" name="td"/><br>

                  <textarea rows="3" placeholder="Enter Task Description" name="tdesc"></textarea>
                  <input style="margin-left:45%;" class="btn btn-success" type="submit" name="add_task" value="Save Changes" />
                  <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
              </form>
            
            
             <!-- <button class="btn btn-success" name="save1">Save changes</button> -->
             <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
            </div>
          </div>
          <?php
              if(isset($_POST['add_task']))
                {
                  
				  $query="INSERT INTO group_task (grp_id,task_name,task_description, task_start_date,task_deadline) VALUES ('$_GET[id]','$_POST[tname]','$_POST[tdesc]','$_POST[tsd]','$_POST[td]')";
                  //$dataa= mysql_query($query); 
                      
                if(!mysql_query($query,$conn))
                    {
                      die("Error".mysql_error());
                    }
                    else
                    {
                        header("location:group_page1.php?id=$_GET[id]");
                    }
                }
        ?>
        
         <?php 
		  	
		for($i=0;$i<sizeof($arr1);$i++)
		{	
			$result4 = mysql_query("select * from group_task where task_id = ".$arr1[$i] );
			$arr4 = array();
			while($row4 = mysql_fetch_array($result4))
			{
			$ted = mysql_real_escape_string($row4['task_end_date']);
			$tname = mysql_real_escape_string ($row4['task_name']);
			$tsd = mysql_real_escape_string ($row4['task_start_date']);
			$td = mysql_real_escape_string ($row4['task_deadline']);
			$tdesc = mysql_real_escape_string ($row4['task_description']);
			$f_status = mysql_real_escape_string ($row4['finish_status']);
			}
		  if($f_status==1)
		  {
			?>
			 <form class="form-inline input-append">
              <label class="checkbox inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1" checked onClick="change_status(0, <?php echo $arr1[$i];?>)"> <a href="#unfinished"><?php echo $tname; ?></a>
              </label>
              <label class="checkbox inline">
                <?php echo date(" F j, Y ", strtotime($tsd)); ?>
              </label>
              <label class="checkbox inline">
               <?php echo date(" F j, Y ", strtotime($td)); ?>
               
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              </label>

            	
          </form>
		  			<p>&nbsp;</p>
		  <?php
     	  }
		  else
		  {
			  ?>
              
		<form class="form-inline" method="post" action="">
              <label class="checkbox inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1" onClick="change_status(1,<?php echo $arr1[$i];?>)"> <a href="#unfinished"><?php echo $tname; ?></a>
              </label>
              <label class="checkbox inline">
                <?php echo date(" F j, Y ", strtotime($tsd)); ?>
              </label>
              <label class="checkbox inline">
               <?php echo date(" F j, Y ", strtotime($td)); ?>
              </label>
			   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				
	           <input class="span3" name='assign_task' id="appendedInput" type="text">
			   <input type="hidden" class="btn btn-medium" name='assign_t2'   value="<?php echo $arr1[$i];?>">
            	<input type="submit" class="btn btn-medium" name='assign_t'  value="Add">
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               
      </form>
			  <?php
		  }
		}
		  ?>
          <hr>
          <!--Le tasks finished-->
                    <!--Le task member modal-->
          <div id="taskmembermodal" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
               <h3>Members</h3>
              </div>
            <div class="modal-body">
           
			<?php 
        
    for($i=0;$i<sizeof($arr9);$i++)
    { 
      $result10 = mysql_query("select * from user natural join belongs_to where user_id = ".$arr9[$i]);
      $arr10 = array();
      $row10 = mysql_fetch_array($result10);
        $u_name = mysql_real_escape_string($row10['name']);
      
      ?>
            <div class="alert alert-info" style="margin-bottom:5px">
              <button type="button" class="close" data-dismiss="alert" onClick="kickmember(<?php echo $row10['user_id'].','.$_GET['id']?>)">&times;</button>
              <?php echo $u_name;?>
            </div>
	
      <?php 
    }
      ?>
<br>
<hr>            
            
    <button class="btn btn-success" name="save1" onClick="document.location.reload(true)">Done</button>

            </div>
          </div>

		  <!-- Le task member modal finished-->          
          <!--Le Uploaded files-->
          <form class="form-inline" method="post" enctype="multipart/form-data">
              <label>
              <h4><a id="upfiles" style="color:inherit;">Uploaded Files</a></h4>
              </label>
              <!--Le file upload option-->
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="input-append">
                  <div class="uneditable-input span2">
                    <span class="fileupload-preview"></span>
                  </div>
                  <span class="btn btn-file">
                    <span class="fileupload-new">Upload new file</span>
                    <span class="fileupload-exists">Change</span>
                    <input type="file" name="name" id="f1"/>
                    </span>
                    <input style="margin-left:10%;" class="btn fileupload-exists" type="submit" name="upload_file" value="Upload" />
                  <!--<a href="#" class="btn fileupload-exists">Upload</a> -->
                </div>
              </div>
              <!--Le file upload option finishes-->
          </form>
          <?php 
				include_once("connect.php");
				if(isset($_POST['upload_file']) )
				{
					$image_Arr = $_FILES['name'];
					move_uploaded_file($image_Arr['tmp_name'],'uploaded_files/' .$image_Arr['name']);
					$i1 = $image_Arr['name'];
					$date = getdate();
					$insert_data = " INSERT INTO files(owner_id,filename,grp_id) VALUES ('$u_id','$i1','$_GET[id]')";
					if(!mysql_query($insert_data,$conn))
					{
						die("Error:".mysql_error());
					}
					else
				{
						header("Location:group_page1.php?id=$_GET[id]");
					}
				}
			?>

          <hr>
          
         
          <?php
		  
          //<!--Le Uploaded files-->
          	for($i=0;$i<sizeof($arr2);$i++)
			{	
				$result5 = mysql_query("select * from files where file_id = ".$arr2[$i]);
				$arr5 = array();
				while($row5 = mysql_fetch_array($result5))
				{
					$fname = mysql_real_escape_string($row5['filename']);
					$upl_date = mysql_real_escape_string ($row5['created_on']);
					$oid = mysql_real_escape_string ($row5['owner_id']);
				}
				$result7 = mysql_query("select name from user join files on user.user_id = files.owner_id where grp_id = $_GET[id] && file_id = ".$arr2[$i]);
				while($row7 = mysql_fetch_array($result7))
				{
					$oname = mysql_real_escape_string($row7['name']);
				}
				
			?>
			 <form class="form-inline">
              <label class="checkbox inline">
                <a href="uploaded_files/<?php echo $fname; ?>"><img src="assets/img/file.png"/>&nbsp;&nbsp;<?php echo $fname; ?> </a>add
              </label>
              <label class="checkbox inline">
                Upload Date: <?php echo date(" F j, Y ", strtotime($upl_date)); ?>
              </label>
              <label class="checkbox inline">
                Owner Name: <?php echo $oname; ?>
              </label>
              &nbsp;&nbsp;
              <hr>
          </form><?php
			}
			?>
          
          
          <!--Le Uploaded Files Finished-->

          <!--Le Live Files-->
          <!--form class="form-inline">
              <label>
              <h4><a id="livedocs" style="color:inherit;">Live Files</a></h4>
              </label>
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#taskmodal2" role="button" data-toggle="modal" class="btn btn-small btn-info"><img src="assets/img/file.png">&nbsp;&nbsp;Create new live file</a>
          </form-->

          <!--div id="taskmodal2" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h3>Add new live file.</h3>
              </div>
            <div class="modal-body">
              <form method="post">
                  <label>File Name</label>
                  <input type="text" placeholder="Type something…" name="livefilename"/><br> 
              
            </div>
            <div class="modal-footer">
                 <input class="btn" type="submit" name="live_yes" value="Create" />
                 <input class="btn" data-dismiss="modal" value="Cancel" style="width:50px"/>
                </form>
            </div>
         </div-->
          <!-- ////////////////////////////////////////////////////////////////////////////////////////////////-->          
                    <!--Le Uploaded files-->
			<?php
      /*
          	for($i=0;$i<sizeof($arr14);$i++)
			{	
				$result15 = mysql_query("select * from livefiles where livefile_id = ".$arr14[$i]);
				$arr15 = array();
				while($row15 = mysql_fetch_array($result15))
				{
					$fname = mysql_real_escape_string($row15['filename']);
					$upl_date = mysql_real_escape_string ($row15['create_date']);
					//$oid = mysql_real_escape_string ($row15['owner_id']);
				}
				
				$result16 = mysql_query("select * from user join livefiles on user.user_id = livefiles.owner_id where group_id = $_GET[id] && livefile_id = ".$arr14[$i]);
				
				
				$row16 = mysql_fetch_array($result16);
				$oname = mysql_real_escape_string($row16['name']);
				
				*/
			?>
			 <!--form class="form-inline">
              <label class="checkbox inline">
                <a href="<?php echo "ether.php?f_id=$row16[random_key]" ?>"> <img src="assets/img/file.png"/>&nbsp;&nbsp;<?php echo $fname; ?> </a>
              </label>
              <label class="checkbox inline">
                Create Date: <?php echo date(" F j, Y ", strtotime($upl_date)); ?>
              </label>
              <label class="checkbox inline">
                Owner Name: <?php echo $oname; ?>
              </label>
              &nbsp;&nbsp;
              <a onClick="pin_file(<?php echo $arr14[$i].','.$_GET['id']?>)" href="#" id="pin1" data-toggle="tooltip" title="Add this to my Pinboard"><img src="assets/img/pin.png"></a>
          </form--><?php
			
			?>

          <!--Le meeting start-->
                    
              <!--form class="form-inline">
              <label>
              <h4><a id="meetings" style="color:inherit;">Meetings</a></h4>
              </label>
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#meetingmodal" role="button" data-toggle="modal" class="btn btn-small btn-info"><img src="assets/img/meeting.png">&nbsp;&nbsp;Add new Meeting</a>
              </form>
              

                <div id="meetingmodal" class="modal hide fade" aria-hidden="true">
                  <div class="modal-header">
                    <h3>Add new meeting...</h3>
                  </div>
                  <div class="modal-body">
                    <form method="post">
                        <label>Meeting Date</label><br>
                        <input type="datetime-local" placeholder="Date" name="mdate"><br>
                    <label>Meeting Agenda</label><br>
                    <textarea rows="3" placeholder="Enter Meeting Agenda" name="magenda"></textarea>
                    <input style="margin-left:45%;" class="btn btn-success" type="submit" name="add_meeting" value="save changes" />
                    </form>&nbsp;&nbsp;
                  </div>
                </div>
           <?php
           /*
              if(isset($_POST['add_meeting']))
                {
                  
				  $query="INSERT INTO meeting(grp_id,caller_id,start_time,agenda) VALUES ('$_GET[id]','$u_id','$_POST[mdate]','$_POST[magenda]')";
                  //$dataa= mysql_query($query); 
                      
                if(!mysql_query($query,$conn))
                    {
                      die("Error".mysql_error());
                    }
                    else
                    {
                        //header("group_page1.php?id=$_GET[id]");
						?><meta http-equiv="Refresh" content="0; url=group_page1.php?id=<?php echo $_GET['id'] ?>"><?php
                    }
                }
                */
        ?>
            <?php 
            /* 
              for($i=0;$i<sizeof($arr3);$i++)
			  {	
					$result6 = mysql_query("select * from meeting where meeting_id = ".$arr3[$i]);
					$arr6 = array();
					while($row6 = mysql_fetch_array($result6))
					{
						$cid = mysql_real_escape_string($row6['caller_id']);
						$st = mysql_real_escape_string ($row6['start_time']);
						$et = mysql_real_escape_string ($row6['end_time']);
					}
					$result8 = mysql_query("select name from user join meeting on user.user_id = meeting.caller_id where grp_id = $_GET[id] && meeting_id = ".$arr3[$i]);
					while($row8 = mysql_fetch_array($result8))
					{
						$cname = mysql_real_escape_string($row8['name']);
					}
				  */
			?>
             
				  <form class="form-inline">
					  <label class="checkbox inline">
						<a href="chatbox.php?gid=<?php echo $_GET['id'];?>&mid=<?php echo $arr3[$i];?>"><img src="assets/img/meeting.png"/>&nbsp;&nbsp;Meeting <?php echo ($i)+1; ?></a>
					  </label>
					  <label class="checkbox inline">
						Meeting Date: <?php echo date(" F j, Y ", strtotime($st)); ?>
					  </label>
					  <label class="checkbox inline">
						Meeting Caller: <?php echo $cname; ?>
					  </label>
				  </form><?php
        	
        ?>
          <!--Le meetings finish-->
        </div><!--Le hero unit finishes-->  
      </div> <!--le span 8 finishes-->
    
      <!--le sidebar starts-->
		 <?php include_once("sidebar.php"); ?>
    <!--Le sidebar finishes-->
    </div><!--/ Le row finishes-->

  
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    
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

    
<script>

       function addmember(gid)
    	{ 
		
		//alert('came');		
		e_id = document.getElementById('invite_email').value;
		//alert('came');
    
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
        	alert(xmlhttp.responseText);
			document.getElementById('invite_email').value="";     
		}
        }
        xmlhttp.open("GET","add_member.php?gid="+gid+"&e_id="+e_id,true);
        xmlhttp.send();	
	}

  function massmessage(gid)
    	{ 
		//alert('came');
				
		e_id = document.getElementById('message_text').value;
		
    
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
        	alert(xmlhttp.responseText);
			document.getElementById('invite_email').value="";     
		}
        }
       xmlhttp.open("GET","massmessage.php?gid="+gid+"&eid="+e_id,true);
        xmlhttp.send();
}



	  function kickmember(u_id,g_id)
	  {	
	  	//alert(u_id+" "+g_id);

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
				}
				}
			  xmlhttp.open("GET","delete_member.php?uid="+u_id+"&gid="+g_id,true);
			  xmlhttp.send();
//			  window.location.href = "sidebar.php#pane2";

			 
			// $("#my_d").load('outbox.php');  
	  }


		
	 function pin_file(fid,gid)
	  {	
	  	//alert(fid+" "+gid);

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
					//document.location.reload(true);
				}
				}
			  xmlhttp.open("GET","pin_file.php?fid="+fid+"&gid="+gid,true);
			  xmlhttp.send();
		}


	 function pin_group(gid)
	  {	
	  	//alert(" "+gid);

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
					//document.location.reload(true);
				}
				}
			  xmlhttp.open("GET","pin_group.php?gid="+gid,true);
			  xmlhttp.send();
		}


	 function change_status(c_s,t_id)
	  {	
	  //	alert(c_s+" "+t_id);

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
					document.location.reload(true);
				}
				}
			  xmlhttp.open("GET","change_status.php?c_s="+c_s+"&tid="+t_id,true);
			  xmlhttp.send();
		}
		



	   </script>







   
   
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
