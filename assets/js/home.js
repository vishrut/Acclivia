function unpin_file(pin_id)
	  {	
	  	//alert(pin_id);

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
					document.location.reload(true);
				}
				}
			  xmlhttp.open("GET","unpin_file.php?fid="+pin_id,true);
			  xmlhttp.send();
		}

function unpin_group(pin_id)
	  {	
	  	//alert(pin_id);

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
					document.location.reload(true);
				}
				}
			  xmlhttp.open("GET","unpin_file.php?fid="+pin_id,true);
			  xmlhttp.send();
		}
		
		
		
	 function unpin_group(pin_id)
	  {	
	  	//alert(pin_id);

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
					document.location.reload(true);
				}
				}
			  xmlhttp.open("GET","unpin_group.php?fid="+pin_id,true);
			  xmlhttp.send();
		}
		
