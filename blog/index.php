<?php

try {
    $dbname="root";
    $dbpass="123456";
    $dbhost="127.0.0.1";
    $dbdatabase="blog";
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);

    $strsql="SELECT * FROM `article`  ORDER BY `create_time` DESC";
    // $strsql="SELECT * FROM `article` WHERE `type`=".$p." ORDER BY `create_time` DESC";
    $result=$db_connect->query($strsql);
    $data = array();
    $result->data_seek(0); #重置指针到起始
    while($row = $result->fetch_assoc())
    {
        $data[] = $row;
    }

        $result->close();
        $db_connect->close();
     
    }
    catch (Exception $e){}
 
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

<div style="text-align: center;margin-top: 50px">
<table>
   <?php 
        foreach ($data as $k => $v) {     ?>
        <tr>
     <?php  if($v['link'] == '')  {  ?>
               <td height="30px" align="left"><a href="./page.php?id=<?php echo $v['id']; ?>" style="text-decoration:none; "><?php echo $v['title']; ?></a> </td>
     <?php } else {  ?>
        
    <td height="30px" align="left"><a href=" https://<?php echo $v['link']; ?>" style="text-decoration:none; "><?php echo $v['title']; ?></a> 

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
