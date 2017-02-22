<?php 
	session_start();
	if (isset($_SESSION['userid'])){
	 	header("Location: ./index.php"); 	
	    	exit;
	 }
 ?>
<html>
	<title>login</title>
	<script language='JavaScript' src='./login.js' chaset='utf8'></script>
	<body>
			<div style="margin-top:200px;margin-left:400px">
			<h1><p>OurBlog</p></h1>
			<hr></hr>
			</div>

			<div style="text-align: center;margin-top: 100px">
				<div style="margin-left: 20px ;height: 40px">
				<span style="height: 30px">E-mail:</span><input type="text" name="email" id="email" style="height: 30px"></br>
				</div>
				</br>
				<div style="margin-left: 20px;height: 40px">
				<span style="height: 30px">password:</span><input type="password" name="pwd" id="pwd" style="height: 30px"></br>
				</div>					
				<input style="border-radius: 3px;height: 35px;width: 50px" type="button" name="" id="btn" value="login" onclick="login()">
			</div>
	</body>
</html>