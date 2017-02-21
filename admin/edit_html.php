<?php 
   $dbname="root";
    $dbpass="123456";
    $dbhost="127.0.0.1";
    $dbdatabase="blog";
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);
    $db_connect->set_charset('utf8');

    $strsql="SELECT `name` FROM `category` ";
  if ($stmt = $db_connect->prepare($strsql))
	{
	    $stmt->execute();
	    $stmt->store_result();
	    $row = $stmt->num_rows;
	    $stmt->bind_result($name);
	    $data = array();
	    while ($stmt->fetch())
	    {
	    	$data []= $name;
	       
	    }
	    	$stmt->close();
	}
		$db_connect->close();


 ?>
<html>
<title>edit blog </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<body>
<div style="margin-top:200px;margin-left:400px">
<table>
    <tr>
        <td><p><h1>OurBlog</h1></p></td>
        <td style="width: 100px"></td>
        <td><a href="" style="text-decoration:none; "><p>BlogManager</p></a></td>
        <td style="width: 100px"></td>
        <td><a href="./edit.html" style="text-decoration:none; "><p>WriteBlog</p></a></td>
    </tr>

</table>

<hr>

<div style="text-align: left;margin-top: 50px">
<div>
<select id="select" style="width: 30%;height: 30px">
<option value='category' selected="true">category</option> 
<?php for ($i=0; $i < $row; $i++) {     ?>
	

<option value='<?php  echo $data[$i]; ?>'><?php  echo $data[$i]; ?></option> 
<?php    }  ?>
</select>
</div>

<div  style="margin-top: 20px">
<p><label>title:</label></p>

<input  type="text" id="title" name="title" value="" style="height: 40px;width: 60%" placeholder="title" >    

</div>
<div  style="margin-top: 20px">
<p><label>link:</label></p>

<input  type="text" id="link" name="link" value="" style="height: 40px;width: 60%" placeholder="link" onblur="check()" >    

</div>

<div style="margin-top: 20px">
<p><label>content:</label></p>
<textarea id="content" style="width: 80%;height: 400px;overflow-y:auto" placeholder="article" ></textarea>
</div>

<div id="sub" style="margin-top: 30px">
    <button value="" id="btn" style="width: 80px;height: 40px;border-radius: 5px" onclick="writeblog()">OK</button>
</div>
</div>
<script type="text/javascript">
        function check(){
            var link = document.getElementById("link").value;
            var content = document.getElementById("content");
            if(link != ''){
                content.readOnly=true;
                content.placeholder="deny write";
            }else{
                content.readOnly=false;
                content.placeholder="article";
            }

        }
            
       function writeblog(){
            var select = document.getElementById("select").value;
            var title = document.getElementById("title").value;
            var content = document.getElementById("content").value;
            var link = document.getElementById("link").value;
            if(link == ''){
            if (title == '' || content == '') {alert('please write all options!');return false;}

            }

            var postData = {"title":title,"content":content,"category":select,"link":link}, 
            postData = (function(obj){ 
            var str = "";
            for(var prop in obj){
                str += prop + "=" + obj[prop] + "&"
            }
            str=str.substring(0,str.length-1);
            return str;
            })(postData);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./edit.php", true);
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
                            alert('write file error!');
                            location.reload();

                        }
                        
                    
                }
            };
            xhr.send(postData);

        }

</script>


</body></html>
