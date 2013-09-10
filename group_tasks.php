<?php include_once("includes/check_session.php"); ?>
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
        <div class="hero-unit" style="font-size: 15px;">
         
         <?php include_once("connect.php"); 
		if (isset($conn)) 
				{
				$result = mysql_query("SELECT * FROM groups natural join belongs_to WHERE grp_id = $_GET[id] ");
				
				while($row = mysql_fetch_array($result))
					{
					$grp_name = mysql_real_escape_string ($row['grp_name']);
					}
				} 
			$result1 = mysql_query("select task_id from group_task where grp_id = $_GET[id] and finish_status=0 order by task_end_date");
			$arr1 = array();
   			while($row1 = mysql_fetch_assoc($result1))
			{
				$arr1[] = $row1['task_id'];
			}
			$result2 = mysql_query("select task_id from group_task where grp_id = $_GET[id] and finish_status=1 order by task_end_date");
			$arr2 = array();
   			while($row2 = mysql_fetch_assoc($result2))
			{
				$arr2[] = $row2['task_id'];
			}
		?>
          <h3> <?php echo $grp_name; ?> </h3>
         
          <hr>
         <h4> Unfinished Tasks </h4> 
         <?php 
		 	
		for($i=0;$i<sizeof($arr1);$i++)
		{	
			$result4 = mysql_query("select * from group_task where task_id = ".$arr1[$i] );
			$arr4 = array();
			$result20 = mysql_query("select user_id from performs where task_id = ".$arr1[$i] );
			$arr20 = array();
			while($row20 = mysql_fetch_array($result20))
			{
				$arr20[] = $row20['user_id'];	
			}
			while($row4 = mysql_fetch_array($result4))
			{
			$ted = $row4['task_end_date'];
			$tname = $row4['task_name'];
			$tsd = $row4['task_start_date'];
			$td = $row4['task_deadline'];
			$tdesc = $row4['task_description'];
			$f_status = $row4['finish_status'];
			}
		  
					?>
					 
					 <form class="form-inline input-append">
					  <label class="inline">
						<b><?php echo $tname; ?> : </b>
					  </label>
					  <label class="inline">
						<?php echo "&nbsp;&nbsp;&nbsp;".date(" F j, Y ", strtotime($tsd)); ?>
					  </label>
					  <label class="inline">
					   <?php echo "&nbsp;&nbsp;&nbsp;".date(" F j, Y ", strtotime($td)); ?>
					   
					   &nbsp;&nbsp;
					  </label>
					  <label>assigned to  
					  <?php
					  for($a=0;$a<sizeof($arr20);$a++)
					  {
							
						  $result21=mysql_query("select name from user where user_id= ".$arr20[$a]);
						  $row21=mysql_fetch_array($result21);
						  $uname=$row21['name'];
						?> <a href="myprofile.php?id=<?php echo $arr20[$a]; ?>"> <?php echo "&nbsp;&nbsp;&nbsp;".$uname; ?> </a>
						<?php } ?>
					  
					  
					  </label> <br>
                      <label>
                      <?php echo $tdesc; ?>
                      </label>
					
						
				  </form>
							<p>&nbsp;</p>
				  <?php
		}
			  ?>
              <h4> Finished Tasks </h4> 
            <?php for($m=0;$m<sizeof($arr2);$m++)
			  {
			$result4 = mysql_query("select * from group_task where task_id = ".$arr2[$m] );
			$arr4 = array();
			$result20 = mysql_query("select user_id from performs where task_id = ".$arr2[$m] );
			$arr20 = array();
			while($row20 = mysql_fetch_array($result20))
			{
				$arr20[] = $row20['user_id'];	
			}
			while($row4 = mysql_fetch_array($result4))
			{
			$ted = $row4['task_end_date'];
			$tname = $row4['task_name'];
			$tsd = $row4['task_start_date'];
			$td = $row4['task_deadline'];
			$tdesc = $row4['task_description'];
			$f_status = $row4['finish_status'];
			}
		  
					?>
			
              
		<form class="form-inline" method="post" action="">
              <label class="inline">
              <b> <?php echo $tname; ?> : </b>
                </label>
              <label class="inline">
                <?php echo "&nbsp;&nbsp;&nbsp;".date(" F j, Y ", strtotime($tsd)); ?>
              </label>
              <label class="inline">
               <?php echo "&nbsp;&nbsp;&nbsp;".date(" F j, Y ", strtotime($td)); ?>
             
              </label>
              <label> &nbsp;&nbsp;&nbsp;assigned to 
              <?php
			  for($a=0;$a<sizeof($arr20);$a++)
			  {
				 	
				  $result21=mysql_query("select name from user where user_id= ".$arr20[$a]);
				  $row21=mysql_fetch_array($result21);
				  $uname=$row21['name'];
				?> <a href="myprofile.php?id=<?php echo $arr20[$a]; ?>"> <?php echo "&nbsp;&nbsp;&nbsp;".$uname; ?> </a>
                 	   
				<?php } ?>
			  
			  
              </label><br>
                      <label>
                      Task Description : <?php echo $tdesc; ?>
                      </label>
      </form>
      <?php } ?>
      </div>
      </div>
      <?php
		  
		
		include_once("sidebar.php");
		
		  ?>
      </div>
<?php      include_once("footer.php"); ?>
      </body>
			  
          
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
