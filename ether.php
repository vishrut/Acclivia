<?php

if(isset($_GET['f_id']))
{
	$file_id = $_GET['f_id'];
	$hash = md5($file_id);
	$hash = substr($hash,0,6);
}
else
{
echo "Oops, Something went wrong.";
die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Etherpad jQuery Plugin Example</title>
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="js/etherpad.js"></script>
</head>

<body id="home">


        <div id="examplePadIntense"></div>

	

	<script type="text/javascript">
  
        // A slightly more intense example"
  $('#examplePadIntense').pad({'padId':'acc'+ "<?php echo "$file_id$hash"; ?>",'showChat':'true'}); // sets the pad id and puts the pad in the div
	</script>

</body>
</html>
