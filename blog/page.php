<?php
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
<title>read blog </title>
<body>
<div style="margin-top:200px;margin-left:400px">
<table>
     <tr>
        <td><p><h1>OurBlog</h1></p></td>
        <td style="width: 50px"></td>
        <td><a href="./index.php" style="text-decoration:none; "><p>HEAD</p></a></td>
        <td style="width: 50px"></td>
        <td><a href="./data.php?p=linux" style="text-decoration:none; "><p>LINUX</p></a></td>
        <td style="width: 50px"></td>
        <td><a href="./data.php?p=apache" style="text-decoration:none; "><p>APACHE</p></a></td>
        <td style="width: 50px"></td>
        <td><a href="./data.php?p=php" style="text-decoration:none; "><p>PHP</p></a></td>
        <td style="width: 50px"></td>
        <td><a href="./data.php?p=mysql" style="text-decoration:none; "><p>MYSQL</p></a></td>
        <td style="width: 50px"></td>
        <td><a href="./data.php?p=js" style="text-decoration:none; "><p>JS</p></a></td>
        <td style="width: 50px"></td>
        <td><a href="./data.php?p=misc" style="text-decoration:none; "><p>MISC</p></a></td>
    </tr>

</table>

<hr>

<div style="text-align: left;margin-top: 50px">

	<?php  foreach ($data as $k => $v) {     ?>



<div style="margin-top: 20px">

<h1><p><?php echo $v['title']; ?></p> </h1> 
</div>

<div style="margin-top: 30px">
<span><?php echo $v['content']; ?></span>
</div>


<?php
}
?>
</div>


</body></html>
