	function check(){
 		var link		= document.getElementById("link").value;
 		var content 	= document.getElementById("content");

 		if(link != ''){
			content.readOnly		=true;
 			content.placeholder	="deny write";
            	}else{
                		content.readOnly		=false;
                		content.placeholder	="article";
            	}

   	}
            
 	function writeblog(){
        		var select 	= document.getElementById("select").value;
        		var title 	= document.getElementById("title").value;
        		var content 	= document.getElementById("content").value;
       		var link 		= document.getElementById("link").value;
        		var  tag 		= document.getElementById("tag").value;

        		if(link == ''){
	        		if (title == '' || content == '') {
	        			alert('please write all options!');
	        			return false;		
	            	}
		}else{
			if(title == ''){
				alert('please write titel');
				return false;
			}
		}

	        	var postData = {"title":title,"content":content,"category":select,"link":link,"tag":tag}, 
	        	postData = (function(obj){ 
	        	var str = "";
	        	for(var prop in obj){
	          		str += prop + "=" + obj[prop] + "&"
	        	}
	        	str=str.substring(0,str.length-1);
	        	return str;
        		})(postData);

            	var xhr = new XMLHttpRequest();
            	xhr.open("POST", "./do_add.php", true);
            	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            	xhr.onreadystatechange = function(){
                	var XMLHttpReq = xhr;
                		if (XMLHttpReq.readyState == 4 && XMLHttpReq.status == 200) {
                    
                         		var text = XMLHttpReq.responseText;
                        		if(text == true){
                            			alert('write file success!');
                            			window.location.href="./index.php"; 
                        		}
                        		else{
                            			alert(text);                          
                        		}
                                            
               		 }
           		};
            	xhr.send(postData);

        		
        }