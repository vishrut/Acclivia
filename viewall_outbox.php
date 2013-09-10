<?php
session_start();
include("includes/connect.php");
$user_id  = $_SESSION['user_id'];
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
        <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container">

        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner" style="max-height:60px;">
            <a class="brand" href="#" style=" margin-top: -50px;"><img src="assets/img/Logo_Final.png" alt="Acclivia" width="170px" height="170px" ></a><!--the padding and margin are done so as to keep the Acclivia icon in its position-->
            <div class="nav-collapse collapse" style="padding-top:13px"><!--To allign the search bar and other options into the middle-->
              <ul class="nav">
                <form class="form-search pull-left">
                <input type="text" class="search-query" placeholder="Search">
                </form>
              </ul>
              <ul class="nav pull-right">
                <li><a href="#home"><i class="icon-home icon-white"></i>Home</a></li>
                <li><a href="#mygroups">My Groups</a></li>
                <!--Le Dropdown starts-->
                <li class="dropdown">
                  <a href="#profile" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/dp.jpg" class="img-rounded" style="margin-top:-8px; height:35px; width:35px;"/>&nbsp; &nbsp;User_Name<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <!--Do not change the whitespaces used(&nbsp;)please-->
                    <li>&nbsp;User_Name&nbsp;</li><!--Actual name of the user-->
                    <li>&nbsp;someone@example.com&nbsp;</li><!--His Email ID-->
                    <li class="divider"></li> 
                    <li><a href="#editprofile">Edit Profile</a></li>
                    <li><a href="#Logout">Logout</a></li>
                  </ul>
                </li>
                <!-- Le dropdown ends-->
              </ul>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
    </div><!-- /.navbar-wrapper -->

    <br><!--to bring the container down-->
    <br><!--to bring the container down-->
    <br><!--to bring the container down-->
    <br><!--to bring the container down-->
    <br><!--to bring the container down-->
    <br><!--to bring the container down-->
    
    <!--Le main row starts here-->

    <div class="row" style="padding-left:40px;">
      <div class="span12">
        <div class="hero-unit" style="font-size: 15px; line-height: 0px;">
          <h3>USer_Name</h3>
          <hr>
          <!--Le view all Outbox-->
          <form class="form-inline">
              <label>
              <h4><a id="livedocs" style="color:inherit;">Outbox:</a></h4>
              </label>
          </form>
          <table class="table table-hover">
                   

                      <?php
					
                     $result = mysql_query("SELECT * FROM message WHERE sender_id = '$user_id' and sender_delete=0 ORDER BY time DESC" ) or die (mysql_error());
                     if (mysql_num_rows($result)>0){
                        $temp_var =0;
                        while($row = mysql_fetch_array($result)){
                           
                          ?>
                    <tr>
                      <div class="alert" style="margin-bottom: 5px;">
                         <button type="button" class="close" data-dismiss="alert" onClick="deleteme(<?php echo $row['message_id']?>)" >&times;</button>
                         <?php echo $row['receiver_id']?>
                         <?php echo $row['content']?>
                      </div>
                      
                    </tr>
                          <?php
                        }
                    }
                    ?>                           
          </table>
       
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
	
	 <script>

		
	  function deleteme(m_id)
	  {	
//	  	alert(m_id);
		
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
			  xmlhttp.open("GET","delete_message.php?m_id="+m_id,true);
			  xmlhttp.send();
			 
			// $("#my_d").load('outbox.php');  
	  }
	  

    </script>
	 
  </body>
</html>
