<?php
//session_start();
include("includes/connect.php");
$user_id  = $_SESSION['user_id'];
if(isset($_POST['sendmsg']))
{

$var1 = $_POST['txt1'];
$var2 = $_POST['txt2'];
$var3 = date("Y-m-d H:i:s");




$text = $var1;


if (strpos($text,']') !== false && strpos($text,'[') !== false) {
    

$l1= strrpos($text,"[");
$l2= strrpos($text,"]");

//echo "$l1";
//echo "$l2";
$l3 = $l2 - $l1 -1 ;
//echo "$l3";

$l4 = substr("$text",$l1+1,$l3);
//echo "$l4";

$result = mysql_query("SELECT * FROM user WHERE premail_id ='$l4' ") or die (mysql_error());
        if (mysql_num_rows($result)==1){
          while($row = mysql_fetch_array($result)){
            $sender =  $row['user_id'];
          }
      }else{
          
      }

$result = mysql_query("INSERT INTO message(sender_id,receiver_id,time,content) VALUES('$user_id','$sender','$var3','$var2')") or die (mysql_error());
}
}
else
{

  
}
?>

    <!-- Le styles -->
   

    
      <div class="span3">
          <div class="well sidebar-nav" data-spy="affix">
            <div class="tabbable">
                <ul class="nav nav-tabs" >
                  <!--Le defining of tabs-->
                  <li class="active"><a href="#pane1" data-toggle="tab">Inbox</a></li>
                  <li><a href="#pane3" data-toggle="tab">Outbox</a></li>
                  <li><a onClick="document.location.reload(true)" data-toggle="tab"><div id='notifications'></div></a></li-->
                </ul>
                <div class="tab-content">
                  <!--Le new message Tab-->
                  <div id="pane1" class="tab-pane active">
                    <h4>Compose</h4>

                    <!--Le php action starts-->
                    <form action="" method="post">
                    <div class="input-prepend">
                      <span class="add-on">@</span>
                      <input class="input-large" id="mytags" type="text" placeholder="Username" name="txt1" >
                    </div>
                    <br>
                    <div class="input-append">
                      <input class="input-large" type="text" placeholder="Enter Text here....." name="txt2" style="width: 190px;">
                      <input type="submit" name="sendmsg" id="signup" value="Send" class="btn"/>
                    </div>
                    </form>
                    <!--Le php action ends-->

                    <h4>Inbox</h4>
                    <th><strong>&nbsp;&nbsp;Sender</strong></th>
                    <th><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Message</strong></th>
                    <div class="tab-pane" style="height:200px; overflow-x:hidden; overflow-y:scroll;">
                  <table class="table table-hover">
                    

                    <?php
          
                     $result = mysql_query("SELECT * FROM message WHERE receiver_id = '$user_id' and receiver_delete=0 ORDER BY message_id
                      DESC" ) or die (mysql_error());
                     if (mysql_num_rows($result)>0){
                        $temp_var =0;
                        while($row = mysql_fetch_array($result)){
                            $temp_var++;
                          ?>

                    <?php
					$m_id = $row['message_id'];
                     $result2 = mysql_query("SELECT * FROM user FULL JOIN message on (user_id=sender_id) WHERE message_id = '$m_id' and sender_delete=0 ORDER BY message_id DESC" ) or die (mysql_error());
                     $row2 = mysql_fetch_array($result2);
                     $my_var2 = $row2['name'];
                     $my_var3 = $row2['content'];
                    ?>

                    <tr>
                      <div class="alert alert-danger" style="margin-bottom: 5px;">
                         <button type="button" class="close" data-dismiss="alert" onClick="deleteme2(<?php echo $row['message_id']?>);" >&times;</button>
                         <?php $l5 = substr("$my_var2",0,6);?>
                         <?php echo $l5."...."?>
                         <?php $l5 = substr("$my_var3",0,20);?>
                         <a onClick="show_modal(<?php echo $row['message_id'];?>)" data-toggle="modal"><?php echo $l5."...."?></a>
                      </div>
                      
                    </tr>
                          <?php
                        }
                    }
                    ?>      

                  </table>
                  </div>
                  </div>
                  <!--Le To do List Tab-->
                  <div id="pane2" class="tab-pane">
                  <h5>New Message</h5>
				  
                  <div class="input-append">
                      <input class="input-large" type="text" placeholder="Create new task....">
                      <button class="btn" type="button">Add</button>
                  </div>
                  <form class="form-inline">
                    <label class="checkbox inline">
                      <input type="checkbox" id="inlineCheckbox1" value="option1"> <a href="#unfinished">Unfinished Task1</a>
                    </label>
                  </form>
                  
				  
                  </div>
                  
                  <!--Le Outbox Tab-->
                  <div id="pane3" class="tab-pane">
                  
                  <h4>Outbox</h4>
                  <th><strong>&nbsp;&nbsp;Receiver</strong></th>
                  <th><strong>&nbsp;&nbsp;&nbsp;&nbsp;Message</strong></th>

                <div class="tab-pane" style="height:200px; overflow-x:hidden; overflow-y:scroll;">
                  <table class="table table-hover">
                    

                    <?php
					
                     $result = mysql_query("SELECT * FROM message WHERE sender_id = '$user_id' and sender_delete=0 ORDER BY message_id DESC" ) or die (mysql_error());
                     if (mysql_num_rows($result)>0){
                        $temp_var =0;
                        while($row = mysql_fetch_array($result)){
                            $temp_var++;
                          ?>
                    <?php
                     $result2 = mysql_query("SELECT * FROM user FULL JOIN message on (user_id=receiver_id) WHERE message_id = $row[message_id] and sender_delete=0 ORDER BY message_id DESC" ) or die (mysql_error());
                     $row2 = mysql_fetch_array($result2);
                     $my_var2 = $row2['name'];
                     $my_var3 = $row2['content'];
                    ?>
                    <tr>
                      <div class="alert alert-info" style="margin-bottom: 5px;">
                         <button type="button" class="close" data-dismiss="alert" onClick="deleteme(<?php echo $row['message_id']?>)" >&times;</button>
                         
                         <?php $l5 = substr("$my_var2",0,6);?>
                         <?php echo $l5."...."?>
                         <?php $l5 = substr("$my_var3",0,20);?>
                          <a onClick="show_modal2(<?php echo $row['message_id'];?>)" data-toggle="modal"><?php echo $l5."...."?></a>
                      </div>
                      
                    </tr>
                          <?php
                        }
                    }
                    ?>                  
                  </table>
                </div>
                  
                  </div>
                </div><!-- /.tab-content -->
              </div><!-- /.tabbable -->
            </ul>
          </div><!--/.well -->
      </div><!--/span-->
    <!--Le sidebar finishes-->
  
    <!-- Le javascript
    ================================================== -->
   
