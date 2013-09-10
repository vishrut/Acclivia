<?php
// Fill up array with names
/*$a[]="shikhar";
$a[]="dhaval";
$a[]="Anna2";
$a[]="Anna3";
$a[]="Brittany";
$a[]="Cinderella";
$a[]="Diana";
$a[]="Eva";

$a2[]="gshikhri@gmail.com";
$a2[]="dhaval6244@gmail.com";
$a2[]="zoli@gmail.com";
$a2[]="lolu@gmail.com";
$a2[]="polu@gmail.com";
$a2[]="annalolap@gmail.com";
$a2[]="asdsad@gmail.com";
$a2[]="asdsadsad@gmail.com";
*/
//get the q parameter from URL
session_start();
include("includes/connect.php");
$u_id = $_SESSION['user_id'];
$gid = $_GET['gid'];
$result2 = mysql_query("select * from user c,(select distinct user_id from belongs_to where grp_id = '$gid' ) as b  where c.user_id=b.user_id;");

      $a = array();
      $a2 = array();

  if($result2)
  {
        while($row = mysql_fetch_array($result2))
          {
            $a2[] = $row['premail_id'];
          }


  }
    
  else
  {

    //echo "came";
    die("Error".mysql_error());
  }

  $hint="";
  for($i=0; $i<count($a2); $i++)
    {
      if ($hint=="")
        {
		
        $hint=$a2[$i].",";
	
        }
      else
        {
        $hint=$hint.",".$a2[$i];
        }
      }
   
// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint == "")
  {
  $response="no suggestion";
  }
else
  {
  $response=$hint;
  }

//output the response
echo $response;
?>