
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Acclivia-Grow with Groups</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="assets/css/bootstrap1.css" rel="stylesheet">
    <link href="assets/css/bootstrap-fileupload.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/scrolltopcontrol.js"></script>
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
  </head>

  <body>
  
	<?php include_once("header.php"); ?> 
	
	<?php 
			include_once("connect.php");
			$result = mysql_query("SELECT * FROM groups natural join belongs_to where user_id='$u_id'");
			$num_rows = mysql_num_rows($result); 
			$counter=-3;
			$min_grps=6;
			$gid= mysql_query("SELECT grp_id FROM groups natural join belongs_to where user_id='$u_id'");
	?>
    <div class="row-fluid" style="padding-left:100px;">
      <div class="span8">
        <div id="hero" class="hero-unit" style="font-size: 13px; line-height: 10px; overflow:hidden;">
			<div style="padding-bottom:4%;">
				<span style="margin-left:3%; font-weight:bold; font-size:280%;"> Your Groups </span>
				<span><input type="text" class="search-query"  style="margin-left:35%; margin-top:-2%;" placeholder="Search a group"></span>
			</div>
            <!--create new Group-->
          
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#taskmodal" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Create New Group</a>
          
          <!--Le add new task modal-->
          <div id="taskmodal" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
               <h3>Create New Group</dh3>
              </div>
            <div class="modal-body">
              <form method="post">
                  <label>Group Name</label>
                  <input type="text" placeholder="Type something…" name="Gname"/><br> 
                  <label>Group Description</label>
                  <textarea rows="3" placeholder="Enter Group Description" name="Gdesc"></textarea>
                  <input style="margin-left:45%;" class="btn-success" type="submit" name="add_group" value="save changes" />
              </form>
            
          </div>
          </div>
          <?php
              if(isset($_POST['add_group']))
                {
                  
				  $query="INSERT INTO group (grp_name,description) VALUES ('$_POST[Gname]','$_POST[Gdesc]')";
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
			<div class="row"  align="center" style="padding-bottom:2px;"></div>
			<?php include 'includes/firstblock.php'; ?>
			<div class="row"  align="center" style="padding-bottom:2px;"></div>
			<?php
			for($k=1;$k<ceil($num_rows/6);$k++)
			{?>
				
				<?php $show_more = "show_more".strval($k);?>
				
				<div class="container_inside" id="<?php echo $show_more;?>" style="display:none;">
					<?php include 'includes/print6.php'; ?>
				</div>
				<div class="row"  align="center" style="padding-bottom:2px;"></div>
				
				<?php
			}					
			?>
					<div class="row"  align="center" style="padding-bottom: 20px;"></div>
					<?php if($num_rows>6)
					{ ?>			
					<button id="mess" style="margin-left:45%; margin-top:5%;" class="btn btn-inverse" type="button">Show more</button><br/>
							<!--<span id="more_button" style="margin-left:41%;">Show more</span><br/>-->
					<?php }
					else
					{ ?>
					<?php } ?>	
						<script type="text/javascript">
							
							var str = '<?php echo $num_rows ;?>';
							var k=1;
							$("#mess").click(function ()
							{	
								var tot_groups = str;
								if(k == Math.ceil(tot_groups/6)-1)
								{
									document.getElementById("mess").innerHTML = "Go up";
									document.getElementById("mess").id = "Goup";
									
								}
								$('#Goup').click(function(){
								$("html, body").animate({ scrollTop: 0 }, 600);
								return false;
								});
								
								
								
							
								var show_more ="#show_more";
								var show_more = show_more.concat(k.toString());
								var show_more_first = show_more.concat(":first");

								if ($(show_more_first).is(":hidden"))
								{
									$(show_more).slideDown("slow");
								}
								k++;
							});
						</script>
				
			
			
				
		    
        </div><!--Le hero unit finishes-->  
      </div> <!--le span 8 finishes-->
      <!--le sidebar starts-->

      <?php include_once("sidebar.php"); ?>
    <!--Le sidebar finishes-->
    </div><!--/ Le row finishes-->
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
      $('#pin').tooltip()
      $('#tooltip_tasks').tooltip()
      $('#tooltip_files').tooltip()
      $('#tooltip_live').tooltip()
      $('#tooltip_meeting').tooltip()
    </script>     
  </body>
</html>