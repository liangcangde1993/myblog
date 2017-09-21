<?php

	 session_start();

		if (!isset($_SESSION['userid'])){
			header("Location: ./login.php"); 
			exit;
	 	}
	header("Content-Type:text/html;charset=utf-8");
	
	require_once("./pdo.php");

	try{

		if (!isset($_GET['id']) ) {
		         throw new InvalidArgumentException('unset argment id ');
		}

    		if (strlen($_GET['id'])  > 10 || strlen($_GET['id']) < 1 ) {
		         throw new InvalidArgumentException(' argment id  length error ');
		}
		
		if (! filter_var($_GET['id'], FILTER_VALIDATE_INT, array( 'options' => array('min_range' => 1) ))) {
		        throw new InvalidArgumentException('invalid id');
		    }

		} catch (InvalidArgumentException $e) {
			echo  $e->getMessage();
			exit;
		}


 	try {
		$stmt = $pdo->prepare(" SELECT `id`, `title`, `link`, `content`, `category` , `tag` FROM `article` WHERE id = :id ");
		$stmt->bindParam(':id' , $_GET['id']);
		$stmt->execute();
		$res = $stmt->fetch();
		} catch (PDOException $e) {		   
			die();
		}

   	try {
		$stmt = $pdo->query("SELECT `id`,`name` FROM `category` ");
			$pdo = null;
		} catch (PDOException $e) {		   
			die();
		}
	
?>


<html>
<title>edit blog </title>
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

				<?php foreach ($stmt as $cate) {   
					if($res['category']  ==  $cate['id']){    ?>
						<option value='<?php  echo $cate['id']; ?>' selected="selected"><?php  echo htmlspecialchars($cate['name']); ?></option> 
				<?php   continue; }  ?>								
				<option value='<?php  echo $cate['id']; ?>'><?php  echo htmlspecialchars($cate['name']); ?></option> 
				<?php    }  ?>
				</select>
			</div>

			<div style="margin-top: 20px">
				<p><label>title:</label></p>	
				<input id="title"  type="text" name="title" value="<?php echo htmlspecialchars($res['title']); ?>" style="height: 40px;width: 60%" placeholder="title" >    
			</div>

			<div  style="margin-top: 20px">
				<p><label>link:</label></p>
				<input  type="text" id="link" name="link" value="<?php echo htmlspecialchars($res['link']); ?>" style="height: 40px;width: 60%"  placeholder="link"  onblur="check()" >    
			</div>

			<div style="margin-top: 20px">
				<textarea id="text" style="width: 80%;height: 400px;overflow-y:auto" placeholder="article"  onblur="check_len()"><?php echo htmlspecialchars($res['content']); ?></textarea>
			</div>

			<div  style="margin-top: 20px">
				<p><label>tag:</label></p>
				<input  type="text" id="tag" name="tag" value="<?php echo htmlspecialchars($res['tag']); ?>" style="height: 40px;width: 60%"    >    
			</div>

			<div id="sub" style="margin-top: 30px">
				 <button value="" id="btn" style="width: 80px;height: 40px;border-radius: 10px"  onclick="edit(<?php echo $res['id']; ?>)">OK</button>
			</div>

		</div>
	</div>

	<script type="text/javascript">

		            window.onload=function(){ 
				var link  = document.getElementById("link").value;
				var text   = document.getElementById("text");
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
				if(str>=64000){
					alert("max is 64000");
				}
		            }

		     
			function edit(id){  
				var select 	= document.getElementById("select").value;
				var title 	= document.getElementById("title").value;
				var text 		= document.getElementById("text").value;
				var link 		= document.getElementById("link").value;
				var tag 		= document.getElementById("tag").value;
				var postData 	= {"id":id,"title":title,"content":text,"category":select,"link":link,"tag":tag};

				postData = (function(obj){ 
					var str = "";
					for(var prop in obj){
						str += prop + "=" + obj[prop] + "&"
					}
					str=str.substring(0,str.length-1);
					return str;
				})(postData);

				var xhr = new XMLHttpRequest();
				xhr.open("POST", "./update.php", true);
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
				         		}			        
					}
				};

				xhr.send(postData);

			}

	</script>
<!--分支-->
</body></html>
