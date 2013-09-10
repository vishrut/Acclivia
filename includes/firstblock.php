<?php
$arr1 = array();
while($row = mysql_fetch_assoc($gid))
{
	$arr1[] = $row['grp_id'];
}

for ($i=0; $i < $num_rows and $i<6; $i++ )
{
	if($counter==0)
	{
		?>
		<div class="row"  align="center" style="padding-bottom:20px"></div>
		<?php
		$counter=-3;
	}
	?> <div class="span20" style="width:30.771%; text-align:center;">
	<a href="check.php?id=<?php echo $arr1[$i] ?>"></a> 
	<?php 
	if (isset($conn)) 
	{
	$result = mysql_query("SELECT * FROM groups WHERE grp_id = ".$arr1[$i]);
	
	while($row = mysql_fetch_array($result))
		{
		$grp_name =  ($row['grp_name']);
		$doc = ($row['date_of_creation']);
		$descr = ($row['description']);
		}
	} ?>
	<br><br><br><br><br><br><br>
	<h4> <?php	echo $grp_name; ?> </h4><br>
	<p> Date Created: <br/><br/><?php echo date("g:i a F j, Y ", strtotime($doc)); ?> </p> <br>
	<p> <?php
			if(strlen($descr)>26)
				echo substr($descr,0,25)."..." ;
			else
				echo substr($descr,0,25);
		?> </p>
	<?php $counter++;?>
	</div><?php		
}	?>
