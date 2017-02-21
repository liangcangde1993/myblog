<?php

session_start();
if (!isset($_SESSION['pwd'])){
	$url="./login.html";
	echo "<script language=\"javascript\">";
	echo "location.href=\"$url\"";
	echo "</script>";
	exit;
}

	if (!isset($_GET['id'])) {
	        header("Location: ./index.php"); 
	        exit;
	    }
	$id = $_GET['id'];

    $dbname="root";
    $dbpass="123456";
    $dbhost="127.0.0.1";
    $dbdatabase="blog";
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);
    $db_connect->set_charset('utf8');

    $strsql="select `id`,`title`,`link`,`content`,`own` from `article` where id =?";
   if (!($stmt = $db_connect->prepare($strsql))) {
    echo "Prepare failed: (" . $db_connect->errno . ") " . $db_connect->error;
    }
    $val = $id;
    if (!$stmt->bind_param("s", $val)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

    $stmt->bind_result($id,$title,$link,$content,$own);
    if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

    	$data = array();
	    while ($stmt->fetch())
	    {
	    	$data ['id']= $id;
	           $data['title']= $title;
		$data ['link']= $link;
		$data ['content']= $content;
		$data ['own']= $own;
	    }
	    
	    $stmt->close();
	    $db_connect->close();
	 
	
?>


<html>
<title>exchange blog </title>
<body>
<div style="margin-top:200px;margin-left:400px">
<table>
    <tr>
        <td><p><h1>OurBlog</h1></p></td>
        <td style="width: 100px"></td>
        <td><a href="" style="text-decoration:none; "><p>BlogManager</p></a></td>
        <td style="width: 100px"></td>
        <td><a href="" style="text-decoration:none; "><p>WriteBlog</p></a></td>
    </tr>

</table>

<hr>

<div style="text-align: left;margin-top: 50px">


<div>
<select id="select" style="width: 30%;height: 30px"><?php echo $data['own']; ?>
<option value='category' selected="">category</option> 
<option value='life'>life</option> 
<option value='work'>work</option> 
<option value='play'>play</option> 
</select>
</div>

<div style="margin-top: 20px">
<p><label>title:</label></p>

<input id="title"  type="text" name="title" value="<?php echo $data['title']; ?>" style="height: 40px;width: 60%" placeholder="title" >    
</div>
<div  style="margin-top: 20px">
<p><label>link:</label></p>

<input  type="text" id="link" name="link" value="<?php echo $data['link']; ?>" style="height: 40px;width: 60%"  placeholder="link"  onblur="check()" >    

</div>
<div style="margin-top: 20px">
<textarea id="text" style="width: 80%;height: 400px;overflow-y:auto" placeholder="article"  onblur="check_len()"><?php echo $data['content']; ?></textarea>
</div>

<div id="sub" style="margin-top: 30px">
    <button value="" id="btn" style="width: 80px;height: 40px;border-radius: 10px" onclick="edit(<?php echo $data['id']; ?>)">OK</button>
</div>

</div>

<script type="text/javascript">

		            window.onload=function(){ 

			  var link = document.getElementById("link").value;
		            var text = document.getElementById("text");
		            if(link != ''){
		                text.readOnly=true;
		                text.placeholder="deny write";
		            }else{
		                text.readOnly=false;
		                text.placeholder="article";
		            }

			}

			 function check(){
		            var link = document.getElementById("link").value;
		            var text = document.getElementById("text");
		            if(link != ''){
		                text.readOnly=true;
		                text.placeholder="deny write";
		            }else{
		                text.readOnly=false;
		                text.placeholder="article";
		            }

		        }

		         function check_len(){  
		            var text = document.getElementById("text").value;
		            var str = text.length;   
		            if(str>=100){
		              alert("max is 100");
		            }
		            }

        
	

			function edit(id){
			var select = document.getElementById("select").value;
			var title = document.getElementById("title").value;
			var text = document.getElementById("text").value;
			var link = document.getElementById("link").value;
			
			var postData = {"id":id,"title":title,"text":text,"category":select,"link":link}, 
			postData = (function(obj){ 
		    var str = "";
		    for(var prop in obj){
		        str += prop + "=" + obj[prop] + "&"
		    }
		    str=str.substring(0,str.length-1);
		    return str;
			})(postData);
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "./updata.php", true);
			xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhr.onreadystatechange = function(){
			    var XMLHttpReq = xhr;
			    if (XMLHttpReq.readyState == 4 && XMLHttpReq.status == 200) {
			        
			             var text = XMLHttpReq.responseText;
			         	if(text == true){
			         		alert('exchange file success!');
			         		window.location.href="./index.php"; 
			         	}
			         	else{
			         		alert('exchange file error!');
		         			//location.reload();

			         	}
			            
			        
			    }
			};
			xhr.send(postData);

		}

</script>

</body></html>
