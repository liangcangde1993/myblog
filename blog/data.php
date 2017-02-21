<?php
			if(!isset($_GET['cate'])){
			        header("Location: ./index.php"); 
			        exit;
			}
			    $p=$_GET['cate'];
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

			   $strsql2="SELECT `id`,`title`,`link` FROM `article` WHERE  `own` = ? ORDER BY `create_time` DESC";
			  if ($stmt2 = $db_connect->prepare($strsql2))
			{	
			     $val = $p;
				    if (!$stmt2->bind_param("s", $val)) {
				    echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
				}
			      if (!$stmt2->execute()) {
				    	echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
				}   
			    $stmt2->store_result();
			    $row2= $stmt2->num_rows;
			    $stmt2->bind_result($id,$title,$link);
			    $article = array();
			    while ($stmt2->fetch())
			    {
			    	$article ['id'][]= $id;
			    	$article ['title'][]= $title;
			    	$article ['link'][]= $link;
			       
			    }
			    $stmt2->close();
			}
				$db_connect->close();
			
			?>

			<html>
			<title>blog </title>
			    
			</script>
			<body>

			<div style="margin-top:200px;margin-left:400px">
			<table>
			    <tr>
			        <td><p><h1>OurBlog</h1></p></td>
			       <td style="width: 50px"></td>
				        <?php  for($i=0;$i<$row;$i++) { ?>
				        <td><a href="./data.php?cate=<?php echo $data[$i]; ?>" style="text-decoration:none; "><p><?php   echo  $data[$i]; ?></p></a></td>
				        <td style="width: 50px"></td>
				      <?php } ?>
				    </tr>

			</table>

			<hr>

			<div style="text-align: center;margin-top: 50px">
			<table>
			 <?php 
				        for($j=0;$j<$row2;$j++) {     ?>
				        <tr>
				     <?php  if($article['link'][$j] == '')  {  ?>
				               <td height="30px" align="left"><a href="./page.php?id=<?php echo $article['id'][$j]; ?>" style="text-decoration:none; "><?php echo $article['title'][$j]; ?></a> </td>
				     <?php } else {  ?>
				        
				    <td height="30px" align="left"><a href=" https://<?php echo $article['link'][$j]; ?>" style="text-decoration:none; "><?php echo $article['title'][$j]; ?></a> 

				        </td>    
				        <?php  }  ?>
				    </tr>
				  
				<?php       }


				 ?>
			</table>

			</div>
			</div>

			</body>
			</html>
