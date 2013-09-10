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
       <?php include_once("header.php") ;?>
       
    <div class="row" style="padding-left:40px;">
      <div class="span12">
        <div class="hero-unit" style="font-size: 15px; line-height: 0px;">
         
         <?php include_once("connect.php"); 
    		if (isset($conn)) 
				{
				$result = mysql_query("SELECT * FROM groups natural join belongs_to WHERE grp_id = $_GET[id] and user_id='$u_id' ");
				
				while($row = mysql_fetch_array($result))
					{
					$grp_name = mysql_real_escape_string ($row['grp_name']);
					$Gdesc = mysql_real_escape_string ($row['grp_name']);
					}
				} 
			$result9 = mysql_query("select user_id from belongs_to where grp_id = $_GET[id]");
			$arr9 = array();
   			while($row9 = mysql_fetch_assoc($result9))
			{
				$arr9[] = $row9['user_id'];
			}

			$result1 = mysql_query("select task_id from group_task where grp_id = $_GET[id] order by task_end_date");
			$arr1 = array();
   			while($row1 = mysql_fetch_assoc($result1))
			{
				$arr1[] = $row1['task_id'];
			}
			
			$result2 = mysql_query("select file_id from files where grp_id = $_GET[id]");
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
		?>
          <h3> <?php echo $grp_name; ?> </h3>
         
          <form class="form-inline">
              <label>
              <a id="tasks" style="color:inherit;"></a>
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#editgroup" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Edit Group</a>
          </form>

          <!--Le add new task modal-->
          <div id="editgroup" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
               <h3>Edit Group</h3>
              </div>
              <div class="modal-body">
                <form method="post">
                    <label>Group Name : </label>
                    <input type="text" placeholder="" name="Gname" value=" <?php echo $grp_name; ?>"/><br> 
                    <label>Group Description : </label>
                    <textarea rows="3" placeholder="" name="Gdesc"> <?php echo $Gdesc; ?></textarea>
                    <input style="margin-left:45%;" class="btn-success" type="submit" name="edit_group" value="save changes" />
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
            <!-- Le delete group vala danger button start-->
            <form class="form-inline">
              <label>
              <a id="tasks" style="color:inherit;"></a>
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#deletegroup" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Delete Group</a>
            </form>

            <div id="deletegroup" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
                 <h3>Are You sure you want to Delete this group ???</h3>
              </div>
            <div class="modal-body">
                <form method="post">
                    <input style="margin-left:45%;" class="btn-success" type="submit" name="yes" value="Yes" />
                	  <input style="margin-left:45%;" class="btn-success" type="submit" name="no" value="NO" />
                </form>
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
           
          <hr>
          <!--Le Group Log-->
          <p><a href="#membermodal" id="tooltip_members" data-toggle="modal" title="Group Members"><?php echo sizeof($arr9) ; ?> Members</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#tasks" id="tooltip_tasks" data-toggle="tooltip" title="Group Tasks"><?php echo sizeof($arr1); ?> Tasks</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#upfiles" id="tooltip_files" data-toggle="tooltip" title="Group Files"><?php echo sizeof($arr2); ?> Files</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#livedocs" id="tooltip_live" data-toggle="tooltip" title="Live Docs for Concurrent Editing">Z Live Files</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#meetings" id="tooltip_meeting" data-toggle="tooltip" title="Group Meetings"><?php echo sizeof($arr3); ?> Meetings</a></p>
          <hr>
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
			while($row10 = mysql_fetch_array($result10))
			{
				$u_name = mysql_real_escape_string($row10['name']);
			}
			?><br><p><?php echo $u_name;?></p><br><br><?php 
		}
			?>
            
            
             <!-- <button class="btn btn-success" name="save1">Save changes</button> -->
             <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
            </div>
          </div>

		  <!-- Le member finished-->          
          <!--Le Tasks-->
          <form class="form-inline">
              <label>
              <h4><a id="tasks" style="color:inherit;">Tasks</a></h4>
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
                  <label>Related Dates</label>
                  <input type="datetime-local" class="input-big" placeholder="start date" name="tsd"/>
                  <input type="datetime-local" class="input-big" placeholder="deadline date" name="td"/><br>
                  <textarea rows="3" placeholder="Enter Task Description" name="tdesc"></textarea>
                  <input style="margin-left:45%;" class="btn-success" type="submit" name="add_task" value="save changes" />
              </form>
            
            
             <!-- <button class="btn btn-success" name="save1">Save changes</button> -->
             <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
            </div>
          </div>
          <?php
              if(isset($_POST['add_task']))
                {
                  
				  $query="INSERT INTO group_task (task_id,grp_id,task_name,task_description, task_start_date,task_end_date,task_deadline) VALUES ('','$_GET[id]','$_POST[tname]','$_POST[tdesc]','$_POST[tsd]','','$_POST[td]')";
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
          <!--Le add new task modal finishes-->

          <!--Le Tasks-->
         <?php 
		  	
		for($i=0;$i<sizeof($arr1);$i++)
		{	
			$result4 = mysql_query("select * from group_task where task_id = ".$arr1[$i]);
			$arr4 = array();
			while($row4 = mysql_fetch_array($result4))
			{
			$ted = mysql_real_escape_string($row4['task_end_date']);
			$tname = mysql_real_escape_string ($row4['task_name']);
			$tsd = mysql_real_escape_string ($row4['task_start_date']);
			$td = mysql_real_escape_string ($row4['task_deadline']);
			$tdesc = mysql_real_escape_string ($row4['task_description']);
			}
		  if($ted=="0000-00-00 00:00:00")
		  {
			?>
			 <form class="form-inline">
              <label class="checkbox inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> <a href="#unfinished"><?php echo $tname; ?></a>
              </label>
              <label class="checkbox inline">
                <?php echo date(" F j, Y ", strtotime($tsd)); ?>
              </label>
              <label class="checkbox inline">
               <?php echo date(" F j, Y ", strtotime($td)); ?>
              </label>
          </form><?php
     	  }
		  else
		  {
			  ?>
			  <form class="form-inline">
              <label class="checkbox inline">
                <a href="#finished"><?php echo $tname; ?></a>
              </label>
              <label class="checkbox inline">
                <?php echo date(" F j, Y ", strtotime($tsd)); ?>
              </label>
              <label class="checkbox inline">
                <?php echo date(" F j, Y ", strtotime($td)); ?>
              </label>
              <label class="checkbox inline">
                <?php echo date(" F j, Y ", strtotime($ted)); ?>
              </label>
          </form><?php
		  }
		}
		  ?>
          <hr>
          <!--Le tasks finished-->
          
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
					$insert_data = " INSERT INTO files(file_id,owner_id,filename,grp_id,created_on) VALUES ('','$u_id','$i1','$_GET[id]','$date')";
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
                <a href="#file1"><img src="assets/img/file.png"/>&nbsp;&nbsp;<?php echo $fname; ?> </a>
              </label>
              <label class="checkbox inline">
                Upload Date: <?php echo date(" F j, Y ", strtotime($upl_date)); ?>
              </label>
              <label class="checkbox inline">
                Owner Name: <?php echo $oname; ?>
              </label>
              &nbsp;&nbsp;
              <a href="#" id="pin1" data-toggle="tooltip" title="Add this to my Pinboard"><img src="assets/img/pin.png"></a>
          </form><?php
			}
			?>
          
          
          <hr>
          <!--Le Uploaded Files Finished-->

          <!--Le Live Files-->
          <form class="form-inline">
              <label>
              <h4><a id="livedocs" style="color:inherit;">Live Files</a></h4>
              </label>
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#" role="button" class="btn btn-small btn-info"><img src="assets/img/file.png">&nbsp;&nbsp;Create new live file</a>
          </form>
          <form class="form-inline">
              <label class="checkbox inline">
                <a href="#livefile1"><img src="assets/img/file.png"/>&nbsp;&nbsp;File Name 1</a>
              </label>
              <label class="checkbox inline">
                Upload Date: upload_date
              </label>
              <label class="checkbox inline">
                Last Modified: last_modified
              </label>
              &nbsp;&nbsp;
              <a href="#" id="livepin1" data-toggle="tooltip" title="Add this to my Pinboard"><img src="assets/img/pin.png"></a>
          </form>
          <form class="form-inline">
              <label class="checkbox inline">
                <a href="#livefile2"><img src="assets/img/file.png"/>&nbsp;&nbsp;File Name 2</a>
              </label>
              <label class="checkbox inline">
                Upload Date: upload_date
              </label>
              <label class="checkbox inline">
                Last Modified: last_modified
              </label>
              &nbsp;&nbsp;
              <a href="#" id="livepin2" data-toggle="tooltip" title="Add this to my Pinboard"><img src="assets/img/pin.png"></a>
          </form>
          <form class="form-inline">
              <label class="checkbox inline">
                <a href="#livefile3"><img src="assets/img/file.png"/>&nbsp;&nbsp;File Name 3</a>
              </label>
              <label class="checkbox inline">
                Upload Date: upload_date
              </label>
              <label class="checkbox inline">
                Last Modified: last_modified
              </label>
              &nbsp;&nbsp;
              <a href="#" id="livepin3" data-toggle="tooltip" title="Add this to my Pinboard"><img src="assets/img/pin.png"></a>
          </form>
          <hr>
          <!--Le live files Finished-->
          
          
          <!--Le meeting start-->
          
              <label>
              <h4><a id="meetings" style="color:inherit;">Meetings</a></h4>
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#meetingmodal" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Add new Meeting</a>

              <!--Le add new meeting modal-->
                <div id="meetingmodal" class="modal hide fade" aria-hidden="true">
                  <div class="modal-header">
                    <h3>Add new meeting...</h3>
                  </div>
                  <div class="modal-body">
                    <form method="post">
                        <label>Meeting Date</label><br>
                        <input type="datetime-local" placeholder="Date" name="mdate"><br>
                    <!--<a href="#meetingdate"><img src="assets/img/calendar.png"></a><br><hr>-->
                    <label>Meeting Agenda</label><br>
                    <textarea rows="3" placeholder="Enter Meeting Agenda" name="magenda"></textarea>
                    <input style="margin-left:45%;" class="btn-success" type="submit" name="add_meeting" value="save changes" />
                    </form>&nbsp;&nbsp;
                  </div>
                </div>
           <?php
              if(isset($_POST['add_meeting']))
                {
                  
				  $query="INSERT INTO meeting(meeting_id,grp_id,caller_id,start_time,end_time,minutes,agenda,log) VALUES ('','$_GET[id]','$u_id','$_POST[mdate]','','','$_POST[magenda]','')";
                  //$dataa= mysql_query($query); 
                      
                if(!mysql_query($query,$conn))
                    {
                      die("Error".mysql_error());
                    }
                    else
                    {
                        header("group_page1.php?id=$_GET[id]");
                    }
                }
        ?>
              <!--Le add new meeting modal finishes-->
            <?php  
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
			  
			?>
             
          <form class="form-inline">
              <label class="checkbox inline">
                <a href="#Meeting<?php ($i)+1?>"><img src="assets/img/meeting.png"/>&nbsp;&nbsp;Meeting <?php echo ($i)+1; ?></a>
              </label>
              <label class="checkbox inline">
                Meeting Date: <?php echo date(" F j, Y ", strtotime($st)); ?>
              </label>
              <label class="checkbox inline">
                Meeting Caller: <?php echo $cname; ?>
              </label>
          </form><?php
        }
        ?>
          <!--Le meetings finish-->
        </div><!--Le hero unit finishes-->  
      </div> <!--le span 8 finishes-->
      <!--le sidebar starts-->

      <div class="span3">
          <div class="well sidebar-nav" data-spy="affix">
            <div class="tabbable">
                <ul class="nav nav-tabs">
                  <!--Le defining of tabs-->
                  <li class="active"><a href="#pane1" data-toggle="tab">Messages</a></li>
                  <li><a href="#pane2" data-toggle="tab">To Do List</a></li>
                  <li><a href="#pane3" data-toggle="tab">Calendar</a></li>
                </ul>
                <div class="tab-content">
                  <!--Le new message Tab-->
                  <div id="pane1" class="tab-pane active">
                    <h5>New Message</h5>
                    <div class="input-append">
                      <input class="input-large" type="text" placeholder="Enter Text here.....">
                      <button class="btn" type="button">Go!</button>
                    </div>
                    <h5>Inbox</h5>
                    <table class="table table-hover">
                    <tr>
                        <td><a href="user.html"><i class="icon-pencil"></i></a></td>
                        <td>Message Content</td>
                        <td><a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a></td>
                    </tr> 
                    <tr>
                        <td><a href="user.html"><i class="icon-pencil"></i></a></td>
                        <td>Message Content</td>
                        <td><a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a></td>
                    </tr> 
                    <tr>
                        <td><a href="user.html"><i class="icon-pencil"></i></a></td>
                        <td>Message Content</td>
                        <td><a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a></td>
                    </tr> 
                    <tr>
                        <td><a href="user.html"><i class="icon-pencil"></i></a></td>
                        <td>Message Content</td>
                        <td><a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a></td>
                    </tr> 
                    <tr>
                        <td><a href="user.html"><i class="icon-pencil"></i></a></td>
                        <td>Message Content</td>
                        <td><a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a></td>
                    </tr> 
                    <tr>
                        <td><a href="user.html"><i class="icon-pencil"></i></a></td>
                        <td>Message Content</td>
                        <td><a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a></td>
                    </tr> 
                    </table>
                  </div>
                  
                  <!--Le To do List Tab Tab-->
                  <div id="pane2" class="tab-pane">
                  <h5>To Do List</h5>
                  <div class="input-append">
                      <input class="input-large" type="text" placeholder="Create new task....">
                      <button class="btn" type="button">Go!</button>
                  </div>
                  <form class="form-inline">
                    <label class="checkbox inline">
                      <input type="checkbox" id="inlineCheckbox1" value="option1"> <a href="#unfinished">Unfinished Task1</a>
                    </label>
                  </form>
                  <form class="form-inline">
                    <label class="checkbox inline">
                      <input type="checkbox" id="inlineCheckbox1" value="option1"> <a href="#unfinished">Unfinished Task1</a>
                    </label>
                  </form>
                  <form class="form-inline">
                    <label class="checkbox inline">
                      <input type="checkbox" id="inlineCheckbox1" value="option1"> <a href="#unfinished">Unfinished Task1</a>
                    </label>
                  </form>
                  </div>
                  
                  <!--Le Calendar Tab-->
                  <div id="pane3" class="tab-pane">
                  <h5>Calendar</h5>
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
                  </div>
                </div><!-- /.tab-content -->
              </div><!-- /.tabbable -->
            </ul>
          </div><!--/.well -->
      </div><!--/span-->
    <!--Le sidebar finishes-->
    </div><!--/ Le row finishes-->
  
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
