	<?php 
	if(isset($_GET['user_id']))
	{
		$u_id=$_GET['user_id'];
	}
	
 ?>
<html >
<head>

<title>Acclivia</title>
<link href="assets/css/resumee.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"></link>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"></link>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.css"></link>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.min.css"></link>

<!--<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis|Niconne' rel='stylesheet' type='text/css' />-->
</head>
<body>
	<?php include_once("header.php"); ?>
	<div class="row-fluid" style="padding-left:100px; margin-top:-7.5%;">
		<div class="span8">
			<div class="hero-unit" style="font-size: 13px; line-height:5px; overflow:hidden;">
				<div class="row" style="padding-left:40px;">
					<div class="span12" style=" margin-left:-3.5%;">
						<div class="top">
							<div class="logo pull-left">
								<h2>My Profile</h2>
							</div>
						</div>
						<?php include_once("connect.php"); 
							if(isset($conn))
							{
								$result=mysql_query("select * from user where user_id='$u_id'");
								while($row = mysql_fetch_array($result))
										{
											$name = mysql_real_escape_string ($row['name']);
											$email = mysql_real_escape_string ($row['premail_id']);
											$img = mysql_real_escape_string ($row['image']);
											$org = mysql_real_escape_string ($row['org_name']);
											$contact= mysql_real_escape_string($row['contact']);
											$dob= mysql_real_escape_string($row['dob']);
											$abt=mysql_real_escape_string($row['about_me']);
											$gender= mysql_real_escape_string($row['gender']);
											}
							}
						?>
						<div class="middle active" id="profile" style="display: block;">
							<div class="row-fluid">
								<div class="span6 basic-info">
									<img src="images/prof/<?php
										if($img == '')
										{
											if($gender == 'M')
												echo('default_male.jpg');
											else if($gender == 'F')
												echo('default_female.jpg');
											else
												echo('default_unisex.jpg');
										}
										else
											echo $img;
									  ?>"" class="main-image img-circle pull-left">
									<div class="main-info pull-left">
										<h1><?php echo $name; ?></h1>
										<p>
											 <?php echo $org; ?>
										</p>
									</div>
				<!-- /.main-info -->
									<div class="clearfix">
									</div>
									<div class="secondary-info">
										<p>
											 <?php echo $abt; ?>
										</p>
									</div>
					<!-- /.secondary-info -->
								</div>
				<!-- /.span6 -->
								<div class="span6 personal-info">
									<dl class="dl-horizontal">
										<dt>Name</dt>
										<dd><?php echo $name; ?></dd>
										<dt>Organization</dt>
										<dd><?php echo $org; ?></dd>
										<dt>Postion</dt>
										<dd>Associate Technical</dd>
										<dt>Birth Date</dt>
										<dd><?php echo $dob; ?></dt>
										<dt>Contact</dt>
										<dd><?php echo $contact; ?></dd>
										<dt>Email</dt>
										<dd><?php echo $email; ?></dd>
										<dt>Website</dt>
										<dd>www.dcei.daiict.ac.in</dd>
									</dl>
								</div>
				<!-- /.span6 -->
							</div>
			<!-- /.row-fluid -->
						</div><!--middle active-->
					</div><!--span 12-->
				</div><!-- end of row-->
			</div><!--Le hero unit finishes-->  
		</div> <!--le span 8 finishes-->
      <!--le sidebar starts-->

		<?php include_once("sidebar.php"); ?>
    <!--Le sidebar finishes-->
    </div><!--/ Le row finishes-->
	<?php include_once("footer.php"); ?>

<script src="assets/js/jquery-1.7.1.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="assets/js/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="assets/js/j_slide.js"></script>
    <script src="assets/js/demo.js"></script>
<script src="assets/js/jquery-1.8.3.min.js"></script>
<script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="assets/js/jquery-1.7.1.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
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