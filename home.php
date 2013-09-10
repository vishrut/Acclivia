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
              <link href="assets/css/bootstrap.css" rel="stylesheet">
   
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

 

    <!--Le favicons ends-->
  </head>

  <body>
    <?php include_once("header.php");
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
					
				$result1 = mysql_query("SELECT * FROM pinned_file where user_id = '$u_id' ");
				$result2 = mysql_query("SELECT * FROM pinned_groups where user_id = '$u_id' ");
				$arr1 = array();
				$arr2 = array();
				while($row1 = mysql_fetch_assoc($result1))
				{
					$arr1[] = $row1['pin_id'];
				}
				while($row2 = mysql_fetch_assoc($result2))
				{
					$arr2[] = $row2['pin_id'];
				}
				
				} 
	 ?> 

    <!--Le main row starts here-->

    <div class="row" style="padding-left:40px;">
      <div class="span12">
        <div class="hero-unit" style="font-size: 15px;">
          <!--h3><?php echo $name; ?></h3>
          <hr>
          <h4>Pinned Files</h4><br>
          <div class="row">
          
          	<?php 
			for($i=0;$i<sizeof($arr1);$i++)
			{ 
			if (isset($conn)) 
			{
				
			$result = mysql_query("SELECT * FROM pinned_file WHERE pin_id = ".$arr1[$i]);
			while($row = mysql_fetch_array($result))
				{
				$g_id = $row['grp_id'];
				$usr_id = $row['user_id'];
				$f_id = $row['file_id'];
				}
			}
			
			$result2 = mysql_query("SELECT * FROM livefiles WHERE livefile_id = $f_id");
			while($row2 = mysql_fetch_array($result2))
				{
				$fname = $row2['filename'];
				$rkey = $row2['random_key'];
				}
				
			$result3 = mysql_query("SELECT * FROM groups WHERE grp_id = $g_id");
			while($row3 = mysql_fetch_array($result3))
				{
				$Gname = $row3['grp_name'];
				}
			
			?>
				<div class="span2">
                <a href='<?php echo 'ether.php?f_id='.$rkey; ?>' target="_blank">
                <div class="alert alert-info">
               
                  <button type="button" class="close" data-dismiss="alert" onClick="unpin_file(<?php echo $arr1[$i]?>)">&times;</button>
                  <p><b> <?php echo $fname; ?> </b></p>
                  <p> <?php echo $Gname; ?></p>
                </div>
                </a>
              </div>		
			<?php }
			 ?>
               
          </div-->
          <h4>Pinned Groups</h4>
                    <hr>

          <br>
          <div class="row">
             <?php 
			for($i=0;$i<sizeof($arr2);$i++)
			{ 
			if (isset($conn)) 
			{
				
			$result4 = mysql_query("SELECT * FROM pinned_groups WHERE pin_id = ".$arr2[$i]);
			while($row = mysql_fetch_array($result4))
				{
				$g_idd = $row['grp_id'];
				$usr_idd = $row['user_id'];
				}
			}
							
			$result5 = mysql_query("SELECT * FROM groups WHERE grp_id = $g_idd");
			while($row5 = mysql_fetch_array($result5))
				{
				$Gname = $row5['grp_name'];
				$gd = $row5['description'];
				}
			
			?>
				<div class="span2">
                 <a href="group_page1.php?id=<?php echo $g_idd; ?>" target="_blank">
                <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert" onClick="unpin_group(<?php echo $arr2[$i]?>)">&times;</button>
                  <p><b> <?php echo $Gname; ?> </b></p>
                  <p> <?php echo $gd; ?></p>
                </div>
                </a>
              </div>		
			<?php }
			 ?>  
          </div>
          <br>
                    <br>
                              <br>
                            

          <!--Le meetings finish-->
        </div><!--Le hero unit finishes-->  
      </div> <!--le span 8 finishes-->
      <!--le sidebar starts-->
   <?php include_once("sidebar.php"); ?>
      <!--le sidebar finishes-->
    </div><!--/ Le row finishes-->
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
