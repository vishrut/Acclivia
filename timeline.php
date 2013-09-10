<?php
include_once("connect.php"); 
include_once("includes/check_session.php");
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
    <link rel="stylesheet" type="text/css" href="assets/theme.css">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/animate.css">
    <link href="assets/css" rel="stylesheet" type="text/css">

    <!--Le styles end-->

    <!--Le favicons-->
     <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                       <link rel="shortcut icon" href="assets/ico/favicon.png">
    <!--Le favicons ends-->
	
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

    
	<!-- datepicker-->
		<link rel="stylesheet" type="text/css" media="all" href="assets/css/bootstrap.css" />
   
      <script type="text/javascript" src="assets/js/date.js"></script>
 
	<!-- datepicker ends-->
  </head>

  <body>
    <?php include 'header.php' ?> 
	
	<!-- data fetch -->
	<?php
			$data = array();
			
			$file_result = mysql_query("SELECT * FROM files JOIN user ON owner_id=user_id WHERE grp_id	=$_GET[gid]");
			while($row = mysql_fetch_assoc($file_result))
			{
				$data[$row['created_on']] = $row['name'] . " added " . $row['filename'];
			}
			
			$task_result = mysql_query("SELECT * FROM group_task WHERE grp_id=$_GET[gid]");
			while($row = mysql_fetch_assoc($task_result))
			{
				$data[$row['task_start_date']] = $row['task_name']. " was created.";
			}
			
			$meeting_result = mysql_query("SELECT * FROM meeting WHERE grp_id=$_GET[gid]");
			while($row = mysql_fetch_assoc($meeting_result))
			{
				$data[$row['start_time']] = "Group Meeting.";
			}
			
			$file_result = mysql_query("SELECT * FROM belongs_to NATURAL JOIN user WHERE grp_id=$_GET[gid]");
			while($row = mysql_fetch_assoc($file_result))
			{
				$data[$row['date_added']] = $row['name'] . " was added to the group.";
			}
			ksort($data);
			$data=array_reverse($data, true);
			
			$months= array("January","February","March","April","May","June","July","August","September","October","November","December");
	?>
	<!-- data fetch ends-->
	
    <a href="#" class="scrolltop">
        <span>up</span>
    </a>
	 
    <!--Le main row starts here-->
	
    <div class="row" style="padding-left:40px">
      <div class="span12">
        <div class="hero-unit" style="font-size: 15px; line-height: 0px;">
          <h3>
		  	<?php
				$group_name = mysql_fetch_array(mysql_query("SELECT grp_name FROM groups WHERE grp_id = $_GET[gid]"));
				echo $group_name['grp_name'];
			?>: Timeline</h3>
          <hr>
		  <select id="selected_year" name="selected_year" style="width:70px" >
			 <?php
			 	reset($data);
				$date = date_parse(key($data));
			 	while($i=$date['year'])
				{	
					if($i!=$prev)
					{
						?><option <?php 
						if(isset($_GET['year_selected']))
						{
							if($_GET['year_selected']==$i)
								echo("selected='x'");
						}	
						?>value="<?php echo $i; ?>"><?php echo $i; ?></option><?php
						
						$prev=$i;
					}
					next($data);
					$date = date_parse(key($data));
				}
			?>
			</select>
			<script>
			$('#selected_year').change(function() {
				var test1 = document.getElementById('selected_year');
				var test2 = test1.options[test1.selectedIndex].value;
				//window.location = "http://www.google.com/";
				var current_page = document.URL;
				var actual_file = current_page.split('?');
				var current = actual_file[0];
				window.location = current + "?gid=" + <?php echo $_GET['gid']; ?> +"&"+ "year_selected="+test2;
				});
			
			  </script>
          <!--Le months labels start-->
		  <a href="#January, <?php echo getyear();?>"><span class="label label-info">January</span></a>
		  <a href="#February, <?php echo getyear();?>"><span class="label label-info">February</span></a>
		  <a href="#March, <?php echo getyear();?>"><span class="label label-info">March</span></a>
		  <a href="#April, <?php echo getyear();?>"><span class="label label-info">April</span></a>
		  <a href="#May, <?php echo getyear();?>"><span class="label label-info">May</span></a>
          <a href="#June, <?php echo getyear();?>"><span class="label label-info">June</span></a>
          <a href="#July, <?php echo getyear();?>"><span class="label label-info">July</span></a>
          <a href="#August, <?php echo getyear();?>"><span class="label label-info">August</span></a>
          <a href="#September, <?php echo getyear();?>"><span class="label label-info">September</span></a>
          <a href="#October, <?php echo getyear();?>"><span class="label label-info">October</span></a>
          <a href="#November, <?php echo getyear();?>"><span class="label label-info">November</span></a>
          <a href="#December, <?php echo getyear();?>"><span class="label label-info">December</span></a>
          <hr>
          <!--Le months labels finishes-->
		
		 <!-- date selector -->
		<!-- <form class="form-horizontal">
			 <fieldset>
			  <div class="control-group">
				<label class="control-label" for="reservation">Pick Graph Range:</label>
				<div class="controls">
				 <div class="input">
				   <input type="text" name="reservation" id="reservation" value="01/18/2013 - 03/23/2013" />
				 </div>
				</div>
			  </div>
			 </fieldset>
		   </form>
      
      	<script>
               
                  $('#reservation').daterangepicker();
               
      	</script>
		<hr>
        <!-- date ends selector -->
		
		  <!--Le Task row starts-->
          <h4>Tasks:</h4>
          <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
          <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
          <div class="row-fluid">
            <!--Le graph for tasks-->
            <div class="span6">  
              <canvas id="canvas" height="200" width="450"></canvas>
            </div>
            <!--Le details of tasks-->
			<?php
			$year=getyear();
			$task_start = mysql_query("SELECT COUNT(*) AS count FROM groups NATURAL JOIN group_task WHERE YEAR(task_end_date)=$year AND grp_id = $_GET[gid]");
			$started_tasks = mysql_fetch_assoc($task_start);
			$task_end = mysql_query("SELECT COUNT(*) AS count FROM groups NATURAL JOIN group_task WHERE YEAR(task_end_date)=$year AND task_end_date<=task_deadline AND grp_id = $_GET[gid]");
			$ended_tasks = mysql_fetch_assoc($task_end);
			?>
            <div class="span6" style="padding-left:60px">
              <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
              <p>Total Tasks alloted: <?php echo $started_tasks['count']; ?></p>
              <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
              <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
              <p>Total Tasks finished successfully: <?php echo $ended_tasks['count']; ?></p>
              <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
              <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
              <p>Total Tasks finished after the deadline: <?php echo $started_tasks['count']-$ended_tasks['count']; ?></p>

            </div>     
          </div>
          <hr>
          <!--Le Task row finishes-->

          <!--Le Files row starts-->
		  <?php
			$year=getyear();
			$file_start = mysql_query("SELECT COUNT(*) AS count FROM groups NATURAL JOIN files WHERE YEAR(created_on)=$year AND grp_id = $_GET[gid]");
			$started_files = mysql_fetch_assoc($file_start);
			$livefiles = mysql_query("SELECT COUNT(*) AS count FROM groups JOIN livefiles ON grp_id=group_id WHERE YEAR(create_date)=$year AND grp_id = $_GET[gid]");
			$started_livefiles = mysql_fetch_assoc($livefiles);
			?>
          <div class="row-fluid">
            <h4>Files:</h4>
            <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
            <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
            <!--Le details of files-->
            <div class="span5">
              <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
              <p>Total Files Uploaded: <?php echo $started_files['count']?></p>
              <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
              <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
              <p>Total Live files Uploaded: <?php echo $started_livefiles['count']?></p>
            </div>    
            <!--Le graph for filess-->
            <div class="span6">  
              <canvas id="line" height="200" width="450"></canvas>
            </div>
          </div>
          <hr>
          <!--Le files row finishes-->

          <!--Le Meetings row starts-->
		  <?php
			$year=getyear();
			$meeting_start = mysql_query("SELECT COUNT(*) AS count FROM groups NATURAL JOIN meeting
										WHERE YEAR(start_time)=$year AND grp_id = $_GET[gid]");
			$started_meeting = mysql_fetch_assoc($meeting_start);
			?>
          <h4>Meetings:</h4>
          <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
          <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
          <div class="row-fluid">
            <!--Le graph for tasks-->
            <div class="span6">  
              <canvas id="canvas2" height="200" width="450"></canvas>
            </div>
            <!--Le details of tasks-->
            <div class="span6" style="padding-left:60px">
              <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
              <p>Total Meetings: <?php echo $started_meeting['count']?></p>
            </div>    
          </div>
          <!--Le Meetings row finishes-->
		  
		 <!--CUT -->
		  
		<?php	
			$year=0;
			$month=0;
			reset($data);
			for($i = 0; $i < sizeof($data); $i++)
			{
				$date = date_parse(key($data));
				if($year != $date['year'])
				{
					$year = $date['year'];
					//echo '<br/>'.$year.'<br/>';
				}
				
				if($month != $date['month'])
				{	
					if($month != 0)
					{
						?>
						</table>
						</div>
						<?php  
					}
					$month = $date['month'];
					?>
					<hr id="<?php echo $months[$month-1].', '.$year?>">
					<p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
					<p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
					<p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
					<p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
					 <h4 ><?php echo $months[$month-1].', '.$year.' :';?></h4>
					  <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
					  <p>&nbsp;</p><!--Not to be removed.. is intentionaly used to leave a blank line-->
					  <div class="row-fluid">
						<table class="table table-hover table-condensed">
					<?php
				}?>
				<tr>
				  <td><a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a></td>
				  <td> <?php echo key($data).' : '.current($data)?></td>
				</tr>
				<?php
			
				next($data);
			}
		?>
		
			</table>
		  </div>
		  <hr>
                  
        </div><!--Le hero unit finishes-->  
      </div> <!--le span 8 finishes-->
      <!--le sidebar starts-->
<?php include_once("sidebar.php"); ?>
</div>
    </div>
    <!--/ Le row finishes-->
  
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-1.7.1.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="assets/js/j_slide.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-fileupload.js"></script>
    <script src="assets/js/Chart.js"></script>
    <script>
	
		<?php
			$months= array("January","February","March","April","May","June","July","August","September","October","November","December");
		?>
		
		//tasks graph
		<?php
			$year = getyear();
				
	  		$month_result = mysql_query("SELECT MONTH(task_end_date) AS month, COUNT(*) AS count FROM groups NATURAL JOIN group_task 
								WHERE YEAR(task_end_date)=$year AND grp_id = $_GET[gid] GROUP BY MONTH(task_end_date)");
			
			$month = array();
			$counts = array();
			
			while($row = mysql_fetch_assoc($month_result))
			{
				$month[] = $row['month'];
				$counts[] = $row['count'];
			}
		?>
	
        var barChartData = {
          labels : ["January","February","March","April","May","June","July","August","September","October","November","December"],
          datasets : [
            {
              fillColor : "rgba(151,187,205,0.5)",
              strokeColor : "rgba(151,187,205,1)",
              data : [
			  <?php
			  	for($i=1,$j=0;$i<=12;$i++) {
					if(sizeof($month)!=0)
					{
						if($i==$month[$j])
						{
							echo("\"".$counts[$j]."\", ");	
							if($j<sizeof($month)-1)
							{
								$j++;
							}
						}
						else
							echo("\"0\", ");
					}
					else
							echo("\"0\", ");
				}
			?>
		  	]
            
			}
          ]
          
        }
		
		//files graph
		<?php
			$year=getyear();
				
	  		$month_result = mysql_query("SELECT MONTH(created_on) AS month, COUNT(*) AS count FROM groups NATURAL JOIN files 
								WHERE YEAR(created_on)=$year AND grp_id = $_GET[gid] GROUP BY MONTH(created_on)");
			
			$month = array();
			$counts = array();
			
			while($row = mysql_fetch_assoc($month_result))
			{
				$month[] = $row['month'];
				$counts[] = $row['count'];
			}
		?>
		
        var lineChartData = {
          labels : ["January","February","March","April","May","June","July","August","September","October","November","December"],
          datasets : [
            {
              fillColor : "rgba(215,215,215,1)",
              strokeColor : "rgba(200,200,200,1)",
              pointColor : "rgba(185,185,185,1)",
              pointStrokeColor : "#fff",
               data : [ <?php
			  	for($i=1,$j=0;$i<=12;$i++) {
					if(sizeof($month)!=0)
					{
						if($i==$month[$j])
						{
							echo("\"".$counts[$j]."\", ");	
							if($j<sizeof($month)-1)
							{
								$j++;
							}
						}
						else
							echo("\"0\", ");
					}
					else
							echo("\"0\", ");
				}
			?>]
            },
			<?php
			$year=getyear();
				
	  		$month_result = mysql_query("SELECT MONTH(create_date) AS month, COUNT(*) AS count FROM groups JOIN livefiles ON grp_id=group_id 
								WHERE YEAR(create_date)=$year AND grp_id = $_GET[gid] GROUP BY MONTH(create_date)");
			
			$month = array();
			$counts = array();
			
			while($row = mysql_fetch_assoc($month_result))
			{
				$month[] = $row['month'];
				$counts[] = $row['count'];
			}
			?>
            {
              fillColor : "rgba(151,187,205,0.35)",
              strokeColor : "rgba(151,187,205,1)",
              pointColor : "rgba(151,187,205,1)",
              pointStrokeColor : "#fff",
              data : [<?php
			  	for($i=1,$j=0;$i<=12;$i++) {
					if(sizeof($month)!=0)
					{
						if($i==$month[$j])
						{
							echo("\"".$counts[$j]."\", ");	
							if($j<sizeof($month)-1)
							{
								$j++;
							}
						}
						else
							echo("\"0\", ");
					}
					else
							echo("\"0\", ");
				}
			?>]
            }
          ]
          
        };
		
		<?php
			$year=getyear();	
				
	  		$month_result = mysql_query("SELECT MONTH(start_time) AS month, COUNT(*) AS count FROM groups NATURAL JOIN meeting
								WHERE YEAR(start_time)=$year AND grp_id = $_GET[gid] GROUP BY MONTH(start_time)");
			
			$month = array();
			$counts = array();
			
			while($row = mysql_fetch_assoc($month_result))
			{
				$month[] = $row['month'];
				$counts[] = $row['count'];
			}
		?>
		
		// meetings data
        var nbarChartData = {
          labels : ["January","February","March","April","May","June","July","August","September","October","November","December"],
          datasets : [
            {
              fillColor : "rgba(151,187,205,0.5)",
              strokeColor : "rgba(151,187,205,1)",
              data : [<?php
			  	for($i=1,$j=0;$i<=12;$i++) {
					if(sizeof($month)!=0)
					{
						if($i==$month[$j])
						{
							echo("\"".$counts[$j]."\", ");	
							if($j<sizeof($month)-1)
							{
								$j++;
							}
						}
						else
							echo("\"0\", ");
					}
					else
							echo("\"0\", ");
				}
			?>]
            }
          ]
          
        }

      new Chart(document.getElementById("canvas").getContext("2d")).Bar(barChartData);
      new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData);
      new Chart(document.getElementById("canvas2").getContext("2d")).Bar(nbarChartData);
    </script>
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
    <script src="assets/js/home.js"></script>

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


<?php
function getyear()
{
	if(isset($_GET['year_selected']))
	{
		return $_GET['year_selected'];
	}
	else
		return 2013;
}
?>
    <script src="assets/jquery-latest.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <script src="assets/theme.js"></script>