window.onload = initForms;

function initForms() {
	console.info("INIT");
	for (var i=0; i< document.forms.length; i++) {
	console.info("VALID 1");
		document.forms[i].onsubmit = function() {
		return validForm();
		}
	}
}

function validForm() {
	var allGood = true;
	var allTags = document.getElementsByTagName("*");

	for (var i=0; i<allTags.length; i++) {
		if (!validTag(allTags[i])) {
			allGood = false;
		}
	}
	return allGood;

	function validTag(thisTag) {
		var outClass = "";
		var allClasses = thisTag.className.split(" ");
	
		for (var j=0; j<allClasses.length; j++) {
			outClass += validBasedOnClass(allClasses[j]) + " ";
		}
	
		thisTag.className = outClass;
	
		if (outClass.indexOf("invalid") > -1) {
			invalidLabel(thisTag.parentNode);
			thisTag.focus();
			if (thisTag.nodeName == "INPUT") {
				thisTag.select();
			}
			return false;
		}
		return true;
		
		function validBasedOnClass(thisClass) {
			var classBack = "";
		
			switch(thisClass) {
				case "":
				case "invalid":
					break;
				case "reqd":
					if (allGood && thisTag.value == "") {
						console.info(thisTag.parentNode.parentNode.childNodes[0].innerHTML);
						var s = thisTag.parentNode.parentNode.childNodes[0].innerHTML;
						if(s.search("(Required Field)") == -1)
						thisTag.parentNode.parentNode.childNodes[0].innerHTML = s +" (Required Field)"; 
						classBack = "invalid ";
					}else{
						thisTag.parentNode.parentNode.childNodes[0].innerHTML = thisTag.parentNode.parentNode.childNodes[0].innerHTML.replace(" (Required Field)","");
					}
					classBack += thisClass;
					break;
				case "name":
					if (allGood && !validName(thisTag)) {
						classBack = "invalid ";
					}
					classBack += thisClass;
					break;
				case "radio":
					if (allGood && !radioPicked(thisTag.name)) {					
						classBack = "invalid ";
					}
					classBack += thisClass;
					break;	
				case "email":
					if (allGood && !validEmail(thisTag.value)) {
						console.info("INVALID EMAIL");
						classBack = "invalid ";
					}
					classBack += thisClass;
					break;
				case "number":

					if ( allGood && !validNumber(thisTag.value) ) {
						var s = thisTag.parentNode.parentNode.childNodes[0].innerHTML;
						if(s.search("(10 Digit Number)")  == -1)
						thisTag.parentNode.parentNode.childNodes[0].innerHTML = s +" (10 Digit Number)"; 
						classBack = "invalid ";
					}else{
					thisTag.parentNode.parentNode.childNodes[0].innerHTML = thisTag.parentNode.parentNode.childNodes[0].innerHTML.replace(" (10 Digit Number)","");
					}
					
					classBack += thisClass;
					break;	
				default:
					classBack += thisClass;
			}
			return classBack;
		}
	
		function validName(tag){
		console.info("CHK NAME");
		var ck_name = /^[A-Za-z ]+$/;
			 if(tag.value.match(ck_name) || tag.value == ""){
thisTag.parentNode.parentNode.childNodes[0].innerHTML = thisTag.parentNode.parentNode.childNodes[0].innerHTML.replace(" (Only Characters)","");
	       		 return true;
	    		}else{
		var s = thisTag.parentNode.parentNode.childNodes[0].innerHTML;
		if(s.search("Only Characters")  == -1)
		thisTag.parentNode.parentNode.childNodes[0].innerHTML = s +" (Only Characters)"; 
		        return false;
		    }		
		}				

		function radioPicked(radioName) {
			var radioSet = "";

			for (var k=0; k<document.forms.length; k++) {
				if (!radioSet) {
					console.info("CHKED");
					radioSet = document.forms[k][radioName];
				}
			}
			if (!radioSet) return false;
			for (k=0; k<radioSet.length; k++) {
			console.info("CASE RADIO CHK");
				if (radioSet[k].checked) {
					console.info("CHKED");
					return true;
				}
			}
			return false;
		}
				
		function validNumber(number) {
			return (!isNaN(number) && number.length == 10);
		}		
		function validEmail(email) {
			var invalidChars = " /:,;";
		
			if (email == "") {
				return false;
			}
			for (var k=0; k<invalidChars.length; k++) {
				var badChar = invalidChars.charAt(k);
				if (email.indexOf(badChar) > -1) {
					return false;
				}
			}
			var atPos = email.indexOf("@",1);
			if (atPos == -1) {
				return false;
			}
			if (email.indexOf("@",atPos+1) != -1) {
				return false;
			}
			var periodPos = email.indexOf(".",atPos);
			if (periodPos == -1) {	
				return false;
			}
			if (periodPos+3 > email.length)	{
				return false;
			}
			return true;
		}
		
		function invalidLabel(parentTag) {
			if (parentTag.parentNode.nodeName == "TR") {
				parentTag.parentNode.className = "invalid";
			}
		}
	}
}

