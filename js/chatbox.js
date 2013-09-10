lastReceived=0;


// Update messages view
function showMessages(res){
//serverRes.innerHTML=""
msgTmArr=res.split("<SRVTM>")
lastReceived=msgTmArr[1]
messages=document.createElement("span")
messages.innerHTML=msgTmArr[0]
chatBox.appendChild(messages)
chatBox.scrollTop=chatBox.scrollHeight
}

// Send message
function sendMessage(gid,mid){
	data="message="+messageForm.message.value;
	messageForm.message.value=""
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
			//alert(gid);
			//messageForm.message.value=""
			messageForm.message.focus()
		//	serverRes.innerHTML="Sent"
        }
        }
        xmlhttp.open("GET","send.php?"+data+"&gid="+gid+"&mid="+mid,true);
        xmlhttp.send();

}

// Sent Ok
function sentOk(res){
if(res=="sentok"){
messageForm.message.value=""
messageForm.message.focus()
serverRes.innerHTML="Sent"
}
else{
serverRes.innerHTML="Not sent"
}
}