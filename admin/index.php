<?php

session_start();
if (!isset($_SESSION['pwd'])){
	$url="./login.html";
	echo "<script language=\"javascript\">";
	echo "location.href=\"$url\"";
	echo "</script>";
	exit;
}

    $dbname="root";
    $dbpass="123456";
    $dbhost="127.0.0.1";
    $dbdatabase="blog";
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);
    $db_connect->set_charset('utf8');

    $strsql="SELECT `id`, `title`, `link` FROM `article` ORDER BY `create_time` DESC";
   if ($stmt = $db_connect->prepare($strsql))
	{
	    $stmt->execute();
	    $stmt->store_result();
	    $row = $stmt->num_rows;
	    $stmt->bind_result($id, $title, $link);
	    $data = array();
	    while ($stmt->fetch())
	    {
	    	$data ['id'][]= $id;
	           $data['title'][]= $title;
		$data ['link'][]= $link;
	    }
	    	$stmt->close();
	}
 
		$db_connect->close();

?>

<!DOCTYPE html>
<html>
<head>
	<title>OurBlog</title>
</head>
<body><p>
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

<div style="text-align: center;margin-top: 50px">
<table>
   <?php 
		for ($i=0 ;$i<$row;$i++) {   ?>
		<tr>
        <td width="400px" align="left"><?php echo $data['title'][$i]; ?></td>
        <td width="100px"><a href="./exchange.php?id=<?php echo $data['id'][$i]; ?>" style="text-decoration:none; ">edit</a></td>
        <td width="100px"><a href="javascript:del('<?php echo $data['id'][$i]; ?>')" style="text-decoration:none; ">del</a></td>
    </tr>
<?php		}


 ?>
      
</table>
<script type="text/javascript">
	function del(id){ 
			var check = confirm('R U sure to del it?');
			if(check){
			var postData = {"id":id}, 
			postData = (function(obj){ 
		    var str = "";
		    for(var prop in obj){
		        str += prop + "=" + obj[prop] + "&"
		    }
		    str=str.substring(0,str.length-1);
		    return str;
			})(postData);
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "./del.php", true);
			xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhr.onreadystatechange = function(){
		    var XMLHttpReq = xhr;
		    if (XMLHttpReq.readyState == 4 && XMLHttpReq.status == 200) {       
		    var text = XMLHttpReq.responseText;
		     if(text == true){
		         	alert('delete success!');
		         	location.reload();
		      }
		      else{
		         	alert('delete error!');
		      	}     
		    }
			};
		xhr.send(postData);
	}else{
		return false;
	}
	}
</script>
</div>
</div>

</body>
</html>