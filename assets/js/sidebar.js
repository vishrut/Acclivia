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

            $( "#tags" ).autocomplete({
           source: availableTags.split(",")
         });
        }
        }
      xmlhttp.open("GET","gethint.php",true);
      xmlhttp.send();
      });
   

       $(get_notification);
    window.setInterval(get_notification,500);
    
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
			  xmlhttp.open("GET","delete_message.php?m_id="+m_id+"&x=0",true);
			  xmlhttp.send();
//			  window.location.href = "sidebar.php#pane2";

			 
			// $("#my_d").load('outbox.php');  
	  }

    function deleteme2(m_id)
    { 
//      alert(m_id);
		
		$('#msgmodal').modal('hide');
    
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
        xmlhttp.open("GET","delete_message.php?m_id="+m_id+"&x=1",true);
        xmlhttp.send();
}
    
    function show_modal(m_id)
    { 

     if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
            
        
        
        xmlhttp.open("GET","show_message.php?m_id="+m_id+"&x=0",false);
        xmlhttp.send();
         var temp= xmlhttp.responseText.split("*#*#");
        document.getElementById('in_name').innerHTML = temp[0];
        document.getElementById('in_content').innerHTML = temp[1];

        $('#msgmodal').modal('show');

    }


    function show_modal2(m_id)
    { 

     if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
            
       
          
        xmlhttp.open("GET","show_message.php?m_id="+m_id+"&x=1",false);
        xmlhttp.send();
        var temp= xmlhttp.responseText.split("*#*#");
      document.getElementById('in_name').innerHTML = temp[0];
      document.getElementById('in_content').innerHTML = temp[1];

      $('#msgmodal').modal('show');

    }


	   function get_notification(m_id)
	    { 
    		 if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
       
			 
        xmlhttp.open("GET","notification.php",false);
        xmlhttp.send();
        document.getElementById('notifications').innerHTML ="Notifications: "+xmlhttp.responseText ;
    }
 
