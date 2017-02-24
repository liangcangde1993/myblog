<?php
	session_start();
		if (!isset($_SESSION['userid'])){
			header("Location: ./login.php"); 
			exit;
		}

	header("Content-Type:text/html;charset=utf-8");
	
	require_once("./pdo.php");

	try {
		$stmt = $pdo->query('SELECT id, title FROM article  WHERE uid = ' . $_SESSION['userid'] );
		$pdo = null;
	} catch (PDOException $e) {		   
		    die();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>OurBlog</title>
</head>
<body>
	<div style="margin-top:200px;margin-left:400px">
		<table>
			<tr>
				<td><p><h1>OurBlog</h1></p></td>
				<td style="width: 100px"></td>
				<td><a href="" style="text-decoration:none; "><p>BlogManager</p></a></td>
				<td style="width: 100px"></td>
				<td><a href="./addblog.php" style="text-decoration:none; "><p>WriteBlog</p></a></td>
			</tr>
		</table>

		<hr>

	<div style="text-align: center;margin-top: 50px">
		<table>
	   		<?php    
	   			foreach ($stmt as $row) {
	   		?>
			<tr>
		       		 <td width="400px" align="left"><?php  echo htmlspecialchars($row['title']); ?></td>
		        		<td width="100px"><a href="./edit.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; ">edit</a></td>
		        		<td width="100px"><a href="javascript:del('<?php echo $row['id']; ?>')" style="text-decoration:none; ">del</a></td>
	    		</tr>
			<?php	}     ?>      
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
							         			alert(text);
							      		}     
								}
							};

							xhr.send(postData);
						}

						else{
							return false;
						}
				}
			</script>
	</div>
	</div>

</body>
</html>