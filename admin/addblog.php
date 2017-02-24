<?php 
	session_start();
		if (!isset($_SESSION['userid'])){
			header("Location: ./login.php"); 
			exit;
		}
		
	header("Content-Type:text/html;charset=utf-8");

	require_once("./pdo.php");
   	try {
		$stmt = $pdo->query("SELECT `id`,`name` FROM `category` ");
		$pdo = null;
	} catch (PDOException $e) {		   
		    die();
	}

 ?>

<html>
<title>write blog </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script language='JavaScript' src='./do_add.js' charset='utf8'></script>
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

	<div style="text-align: left;margin-top: 50px">

		<div>	
			<select id="select" style="width: 30%;height: 30px">
				<?php foreach ($stmt as $cate) {     ?>
				<option value='<?php  echo $cate['id']; ?>'><?php  echo htmlspecialchars($cate['name']); ?></option> 
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

		<div  style="margin-top: 20px">
			<p><label>tag:</label></p>
			<input  type="text" id="tag" name="tag" value="" style="height: 40px;width: 60%"  placeholder=""  > <p>cut with ','</p>    
		</div>

		<div id="sub" style="margin-top: 30px">
			<button value="" id="btn" style="width: 80px;height: 40px;border-radius: 5px" onclick="writeblog()">OK</button>
		</div>

	</div>

</body>
</html>