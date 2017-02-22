		function login(){
			var email = document.getElementById("email");
			var pwd = document.getElementById("pwd");
			var postData = {"email":email.value,"pwd":pwd.value}, 
			postData = (function(obj){ 
		    		var str = "";
		    		for(var prop in obj){
		        			str += prop + "=" + obj[prop] + "&"
		    		}
		    		str=str.substring(0,str.length-1);
		    		return str;
				})(postData);
				var xhr = new XMLHttpRequest();
				xhr.open("POST", "./do_login.php", true);
				xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xhr.onreadystatechange = function(){
				    	var XMLHttpReq = xhr;
				    	if (XMLHttpReq.readyState == 4 && XMLHttpReq.status == 200) {
				             	var  text = XMLHttpReq.responseText;
				         		if(text == "success" || text=="login status"){
				         				alert(text);
				          				window.location.href="./index.php";  	
				             	}
					           else{
					              		alert(text);
					   	}
				           
				   	 }
				};
				xhr.send(postData);

			}

