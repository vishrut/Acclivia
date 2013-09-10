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
				if($role=='2')
				{
				
					 header("location:group_page1.php?id=$grp_id");
					die();            
				}
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
					//$row1 = mysql_fetch_assoc($result2);
					//echo mysql_num_rows($result3);
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
		  $lname = mysql_escape_string($_POST['livefilename']);
		  $random_name = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 8)), 0, 9);
		  $ggid = $_GET['id'];
		  $own_id = $_SESSION['user_id'];
	  $query="INSERT INTO livefiles(livefile_id,filename,random_key,group_id,owner_id) VALUES ('','$lname', '$random_name','$ggid','$own_id')";
	  //$dataa= mysql_query($query); 
		  
	if(!mysql_query($query))
		{
		  echo "came here";
		  die("Error".mysql_error());
		}
		else
		{
			?><meta http-equiv="Refresh" content="0; url=ether.php?f_id=<?php echo $random_name ?>"><?php
		}
	  }
	}
	
	
	if(isset($_POST['done']))
	{
		?><meta http-equiv="Refresh" content="0; url=group_page1.php?id=<?php echo $_GET['id'] ?>"><?php
		
	}
	
	   ?>
		
       
    <div class="row" style="padding-left:40px;">
      <div class="span12">
        <div class="hero-unit" style="font-size: 15px; line-height: 10px;">
         
         <?php 
    		if (isset($conn)) 
				{
				$result = mysql_query("SELECT * FROM groups natural join belongs_to WHERE grp_id = $_GET[id] ");
				
				while($row = mysql_fetch_array($result))
					{
					$grp_name = $row['grp_name'];
					$Gdesc = $row['description'];
					}
				} 
			$result9 = mysql_query("select user_id from belongs_to where grp_id = $_GET[id]");
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
		
          $result91 = mysql_query("select * from user natural join belongs_to where grp_id= $grp_id and role=2 ");
			while($row91 = mysql_fetch_assoc($result91))
			{
				$name10 = $row91['name'];
				$usr_id = $row91['user_id'];
			}	
		?>
          <h3> <?php echo $grp_name; ?> </h3>
			<hr>
         Group Admin :<a href="myprofile.php?id=<?php echo $usr_id; ?>"> <?php echo $name10; ?></a>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

         
<p></p>         
         <p><?php echo $Gdesc ?></p>
         <hr>         
          <form class="form-inline" style="margin-left:-100px">
              <label>
              <a id="tasks" style="color:inherit;"></a>
              </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
              <a href="#joingroup" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Join Group</a>
            
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
                    <input type="text" placeholder="" name="Gname" value=" <?php echo $grp_name; ?>"/><br> 
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
									?><meta http-equiv="Refresh" content="0; url=group_page1.php?id=<?php echo $_GET['id'] ?>"><?php
            						//header("location:group_page1.php?id=$_GET[id]");
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
								?><meta http-equiv="Refresh" content="0; url=my_groups.php"><?php
          						//header("location:my_groups.php");
          					}
          				}
          				else if(isset($_POST['no']))
          				{
          					//header("location:group_page1.php?id=$_GET[id]");
          				?><meta http-equiv="Refresh" content="0; url=groups_page1.php?id=<?php echo $_GET['id'];  ?>"><?php
          						
						}
          			  
			     ?>
            <!--Le delete group end here RIP GROUP -->
            <!-- Le leave group button start-->
            <div id="joingroup" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h3>Join Group</h3>
              </div>
            <div class="modal-body">
              <p>Are you sure you want to Join this group?</p>
              <p>&nbsp;</p>
              <div class="modal-footer">
                <form method="post">
                 <input class="btn btn-danger" type="submit" name="yes2" value="Yes" />
                 <input class="btn" data-dismiss="modal" value="No" style="width:25px"/>
                </form>
              </div>

             </div>
             </div> 
              <?php 
          			  if(isset($_POST['yes2']))
          			  {
						  $gid = $_GET['id'];
          				$query3= mysql_query("select * from belongs_to where role='2' and grp_id= $gid");
						
          					if(!$query3)
          					{
          						die("Error".mysql_error());
						
          					}
          					else
          					{
								if(mysql_num_rows($query3)==1)
								{
								
									$row = mysql_fetch_assoc($query3);
									$query4=mysql_query("select * from user where user_id= $u_id");  
									$row2 = mysql_fetch_assoc($query4);
									if($query4)
									{
									
									$invite = "Hi,I would like to join <a href= group_page1.php?id=".$gid.">This</a> group.
									 My email id is ".$row2['premail_id']." Thank you!";
									$invite= mysql_escape_string($invite);
									$result5 = mysql_query("INSERT INTO message(sender_id,receiver_id,content) values('$u_id','$row[user_id]','$invite')");
									
									if($result5)
									{
										echo "Request sent!";	
									}
									}
									
								}
          						
          					}
          				}
          				
          			  
			     ?>
                 <!-- Le delete group button ends-->
              
            
              
          <hr>
          <!--Le Group Log-->
          <p><a href="#membermodal" id="tooltip_members" data-toggle="modal" title="Group Members"><?php echo sizeof($arr9) ; ?> Members</a></p>
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
      $row10 = mysql_fetch_array($result10);
      $u_name = $row10['name'];
      
      ?>
            <div class="alert alert-info" style="margin-bottom:5px">
            
              <?php echo $u_name;?>
            </div>
	
      <?php 
    }
      ?>
<br>
<hr>            
            
    <button class="btn btn-success" name="save1" data-dismiss="modal">Close</button>

            </div>
          </div>

		  <!-- Le member finished-->          
          <!--Le Tasks-->
         

          
          <!--Le meetings finish-->
        </div><!--Le hero unit finishes-->  
      </div> <!--le span 8 finishes-->
    
      <!--le sidebar starts-->

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
	  	alert(fid+" "+gid);

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
