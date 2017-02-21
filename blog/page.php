<?php
	if(!isset($_GET['id'])){
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

       $strsql="SELECT `name` FROM `category` ";
  if ($stmt = $db_connect->prepare($strsql))
	{
	      if (!$stmt->execute()) {
				    	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
				}  
	    $stmt->store_result();
	    $row = $stmt->num_rows;
	    $stmt->bind_result($name);
	    $cate = array();
	    while ($stmt->fetch())
	    {
	    	$cate []= $name;
	       
	    }
	    	$stmt->close();
	}


    $strsql2="SELECT `title`,`content` FROM `article` WHERE id =?";
         if (!($stmt2 = $db_connect->prepare($strsql2))) {
	    echo "Prepare failed: (" . $db_connect->errno . ") " . $db_connect->error;
	    }
	    $val = $id;
	    if (!$stmt2->bind_param("s", $val)) {
	    echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
	}
	    if (!$stmt2->execute()) {
	    	echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
	}   
	        $stmt2->bind_result($title,$content);
	    $data = array();
	    while ($stmt2->fetch())
	    {
	    	$data ['title']= $title;
	    	$data ['content']= $content;
	       
	    }
	   $stmt2->close();

		$db_connect->close();
	 
	
?>


<html>
<title>read blog </title>
<body>
<div style="margin-top:200px;margin-left:400px">
<table>
     <tr>
        <td><p><h1>OurBlog</h1></p></td>
        <td style="width: 50px"></td>
        <?php  for($i=0;$i<$row;$i++) { ?>
        <td><a href="./data.php?cate=<?php echo $cate[$i]; ?>" style="text-decoration:none; "><p><?php   echo  $cate[$i]; ?></p></a></td>
        <td style="width: 50px"></td>
      <?php } ?>
    </tr>

</table>

<hr>

<div style="text-align: left;margin-top: 50px">




<div style="margin-top: 20px">

<h1><p><?php echo $data['title']; ?></p> </h1> 
</div>

<div style="margin-top: 30px">
<span><?php echo $data['content']; ?></span>
</div>



</div>


</body></html>
