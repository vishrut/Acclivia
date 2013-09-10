<?php 
	@session_start();
	if(isset($_SESSION['unameA']))
	{
		$admin=$_SESSION['unameA'];
	}
	else{	
		header("location:index.php");
		die();
	 }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Gallery | Red Flames Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/gallery.css" rel="stylesheet" type="text/css" />
    <link href="css/facebox.css" rel="stylesheet" type="text/css" />
    <link href="css/tabs.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-fileupload.css" rel="stylesheet">

    
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script src="js/popup/jquery.facebox.js" type="text/javascript"></script>
    <script src="js/quick-sand/jquery.quicksand.js" type="text/javascript"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupGallery();
            setupLeftMenu();
			setSidebarHeight();

        });
    </script>
</head>
<body>
    <?php include_once("header.php"); ?>

        <div class="clear">
        </div>

        <div class="grid_2">
            <div class="box sidemenu">
                <div class="block">
                    <ul class="section menu">
                        <li><a class="menuitem" href="add_img_form.php" >Add Images</a>
                            
                        </li>
                        <li><a class="menuitem">Menu 2</a>
                            <ul class="submenu">
                                <li><a>Submenu 1</a> </li>
                                <li><a>Submenu 2</a> </li>
                                <li><a>Submenu 3</a> </li>
                                <li><a>Submenu 4</a> </li>
                                <li><a>Submenu 5</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Menu 3</a>
                            <ul class="submenu">
                                <li><a>Submenu 1</a> </li>
                                <li><a>Submenu 2</a> </li>
                                <li><a>Submenu 3</a> </li>
                                <li><a>Submenu 4</a> </li>
                                <li><a>Submenu 5</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Menu 4</a>
                            <ul class="submenu">
                                <li><a>Submenu 1</a> </li>
                                <li><a>Submenu 2</a> </li>
                                <li><a>Submenu 3</a> </li>
                                <li><a>Submenu 4</a> </li>
                                <li><a>Submenu 5</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first">
                
                    <h2>Gallery</h2>
                    <div class="block">
                    <div class="gallery-sand">
                        <div class="filter-options">
                            <!-- Big Gallery Sorting: Start -->
                            <ul class="sorting">
                                <li><a href="#" data-type="all" class="active">Show All</a></li>
                                <li><a href="#" data-type="healthcare">Health and Care Club</a></li>
                                <li><a href="#" data-type="streets">Streets</a></li>
                                <li><a href="#" data-type="nature">Nature</a></li>
                                <li><a href="#" data-type="clothing">Clothing</a></li>
                                <li> 
           <form class="form-inline">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#addimages" role="button" class="btn btn-small btn-info" data-toggle="modal"><img src="assets/img/to_do.png">&nbsp;&nbsp;Add more Images</a>
          </form>

          <!--Le add new task modal-->
          <div id="addimages" class="modal hide fade" aria-hidden="true">
              <div class="modal-header">
               <h3>Add More Images </h3>
              </div>
            <div class="modal-body">
             <form enctype="multipart/form-data" method="post">
            <h1><p> <font color="#003399"> Add Image  </font></p> </h1>
            <h4><font color="#003399" > File Type : </font> 
            <select name="ptype"> 
            	<option value="health and care" >Health and Care Club </option>
                <option value="Sports">Sports Club</option>
                <option value="nature">Eat Out</option>
                <option value="clothing">Plan and Event</option>
                <option value="food">Discover Andaman</option>
                
            </select> 
            </h4>
			<h4> <font  color="#003399" > File Input: </font> <input type="file" class="span3" name="name" id="f1"></h4>
            <input type="submit" name="add" value="submit" ><br>
		
        </form> 
        
    
    <?php 
					include_once("connect.php");
					if(isset($_POST['add']) )
					{
						$image_Arr = $_FILES['name'];
						
						move_uploaded_file($image_Arr['tmp_name'],'img/gallery/' .$image_Arr['name']);
						$i1 = $image_Arr['name'];
						
						$insert_data = "insert into gallery(name,type) values('$i1','$_POST[ptype]') ";
							
							if(!mysql_query($insert_data,$conn))
							{
								die("Error:".mysql_error());
							}
							else
							{
									header("Location:gallery.php");
							}
					}
		?>
            
            
             <!-- <button class="btn btn-success" name="save1">Save changes</button> -->
             <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
            </div>
          </div></li>
                            </ul>
                        </div>
        
          
                        <?php include_once("connect.php"); 
						
						
					$result1 = mysql_query("select pic_id from gallery ");
					$arr1 = array();
					while($row1 = mysql_fetch_assoc($result1))
					{
						$arr1[] = $row1['pic_id'];
					}
						
					 //echo sizeof($arr1); ?>
                        <!-- Big Gallery Sorting: End -->
                        <!-- Small Gallery Content: Start -->
                        <div class="filter-results">
                            <ul class="gallery small">
                                <?php 
								for($j=0;$j<sizeof($arr1);$j++)
								{
									$query= "select * from gallery where pic_id=".$arr1[$j];
									$result2 = mysql_query($query);	
									if(isset($conn))
									{
											while($row = mysql_fetch_array($result2))
												{
												$id = mysql_real_escape_string ($row['pic_id']);
												$name = mysql_real_escape_string ($row['name']);
												$type = mysql_real_escape_string ($row['type']);
												}	
									}
								?>
                                    <!-- Small Gallery Image: Start -->
                                    <li data-type="<?php echo $type; ?>" data-id="g001">
                                        <div class="actions">
                                            <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/<?php echo $name; ?>"
                                                class="view popup">view</a>
                                        </div>
                                        <a href="img/gallery/<?php echo $name; ?>" class="popup">
                                        <img src="img/gallery/<?php echo $name; ?>" alt="" style="margin-top:-8px; height:120px; width:100px;"/>
                                        </a></li>
                                    <!-- Small Gallery Image: End -->
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- Small Gallery Content: End -->
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <div class="clear">
    </div>
    <?php include_once("footer.php"); ?>
    
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
