<?php
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
    <link href="assets/css/bootstrap1.css" rel="stylesheet">
    <link href="assets/css/bootstrap-fileupload.css" rel="stylesheet">
	<script src="assets/js/jquery-latest.js"></script>
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

	<script src="assets/js/jquery-1.7.1.min.js"></script>   
    <link href="assets/css/suggest.css" rel="stylesheet">
   	<script src="assets/js/bootstrap.js"></script>

    <!--Le typeahead ends-->
    <style>
    .input-small {
     width: 230px;
}

    </style>
  
      <script src="assets/js/suggest.js"></script>

  </head>

  <body>
  
	<?php include_once("header.php"); ?> 
	
	<?php 
			include_once("connect.php");
			$result = mysql_query("SELECT * FROM groups natural join belongs_to where user_id='$u_id' ORDER BY grp_id DESC");
			$num_rows = mysql_num_rows($result); 
			$counter=-3;
			$min_grps=6;
			$gid= mysql_query("SELECT grp_id FROM groups natural join belongs_to where user_id='$u_id' ORDER BY grp_id DESC");
	?>
    <div class="row" style="padding-left:40px;">
      <div class="span12">
        <div id="hero" class="hero-unit" style="font-size: 13px; line-height: 10px; overflow:hidden;">
			<div style="padding-bottom:4%;">
				<span style="margin-left:3%; font-weight:bold; font-size:280%;"> Your Groups </span>
				<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="#groupmodal" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Create New Group</a></span>
			</div>
            <!--create new Group-->
          
          
          
          <!--Le add new group modal-->
          <div id="groupmodal" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
               <h3>Create New Group</dh3>
              </div>
            <div class="modal-body">
              <form method="post">
                  <label>Group Name</label>
                  <input type="text" placeholder="Type something…" name="Gname" required /><br> 
                  <label>Group Description</label>
                  <textarea rows="3" placeholder="Enter Group Description" required name="Gdesc"></textarea>
                  <input style="margin-left:45%;" class="btn btn-success" type="submit" name="add_group" value="save changes" />
          		  <a role="button" class="btn btn-medium btn-danger" data-dismiss="modal">Close</a>        
              </form>
            
          </div>
          </div>
          <?php
              if(isset($_POST['add_group']))
                {
                  $gname = mysql_real_escape_string($_POST['Gname']);
				  $gdisc = mysql_real_escape_string($_POST['Gdesc']);
				  $query="INSERT INTO groups (grp_name,description) VALUES ('$gname','$gdisc')";
				  mysql_query($query);
				  $query="select max(grp_id) as mymax from groups";
				  $result = mysql_query($query);
				  $row = mysql_fetch_array($result);
				  
				  $user_id = $_SESSION['user_id'];
				  $query="INSERT INTO belongs_to (user_id,grp_id,role) VALUES ('$user_id',$row[mymax],2)";
                  //$dataa= mysql_query($query); 
                   //
                if(!mysql_query($query,$conn))
                    {
                      die("Error".mysql_error());
                    }
                    else
                    {
                        //header("location:my_groups.php");
                        ?><meta http-equiv="refresh" content="0;URL=group_page1.php?id=<?php echo $_GET['id']; ?>"> <?php

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
    <br>
	<?php include_once("footer.php"); ?>
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