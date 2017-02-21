<?php
session_start();
if (!isset($_SESSION['pwd'])){
	$url="./login.html";
	echo "<script language=\"javascript\">";
	echo "location.href=\"$url\"";
	echo "</script>";
}
$id = $_GET['id'];
try {
    $dbname="root";
    $dbpass="123456";
    $dbhost="127.0.0.1";
    $dbdatabase="blog";
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);

    $strsql="select * from `article` where id =".$id;
    $result=$db_connect->query($strsql);
    $row= mysqli_fetch_assoc($result);//var_dump($row);die();
    $data[] = $row;
	    $db_connect->close();
	 
	}
	catch (Exception $e){}
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

	<?php  foreach ($data as $k => $v) {     ?>

<div>
<select id="select" style="width: 30%;height: 30px"><?php echo $v['own']; ?>
<option value='own' selected="">own</option> 
<option value='life'>life</option> 
<option value='work'>work</option> 
<option value='play'>play</option> 
</select>
</div>

<div style="margin-top: 20px">
<p><label>title:</label></p>

<input id="title"  type="text" name="title" value="<?php echo $v['title']; ?>" style="height: 40px;width: 60%" placeholder="title" >    
</div>
<div  style="margin-top: 20px">
<p><label>link:</label></p>

<input  type="text" id="link" name="link" value="<?php echo $v['link']; ?>" style="height: 40px;width: 60%"  placeholder="link"  onblur="check()" >    

</div>
<div style="margin-top: 20px">
<textarea id="text" style="width: 80%;height: 400px;overflow-y:auto" placeholder="article"><?php echo $v['content']; ?></textarea>
</div>

<div id="sub" style="margin-top: 30px">
    <button value="" id="btn" style="width: 80px;height: 40px;border-radius: 10px" onclick="edit('<?php echo $v['id']; ?>')">OK</button>
</div>
<?php
}
?>
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
	

			function edit(id){
			var select = document.getElementById("select").value;
			var title = document.getElementById("title").value;
			var text = document.getElementById("text").value;
			var link = document.getElementById("link").value;
			var timestamp=new Date().getTime();
			var postData = {"id":id,"title":title,"text":text,"own":select,"last_ex_time":timestamp,"link":$link}, 
			postData = (function(obj){ 
		    var str = "";
		    for(var prop in obj){
		        str += prop + "=" + obj[prop] + "&"
		    }
		    str=str.substring(0,str.length-1);
		    return str;
			})(postData);//alert(postData);return false;
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "./updata.php", true);
			xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhr.onreadystatechange = function(){
			    var XMLHttpReq = xhr;
			    if (XMLHttpReq.readyState == 4 && XMLHttpReq.status == 200) {
			        
			             var text = XMLHttpReq.responseText;//console.log(text);return false;
			    // alert(text);
			         	if(text == true){
			         		alert('exchange file success!');
			         		window.location.href="./index.php"; 
			         	}
			         	else{
			         		alert('exchange file error!');
		         			location.reload();

			         	}
			            
			        
			    }
			};
			xhr.send(postData);

		}

</script>

</body></html>
