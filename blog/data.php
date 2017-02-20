<?php
    $p=$_GET['p'];
   
    switch ($p)
    {
    case 'linux':
      $p=1;
      break;
    case 'apache':
      $p=2;
      break;
    case 'php':
      $p=3;
      break;
    case 'mysql':
      $p=4;
      break;
    case 'js':
      $p=5;
      break;
    case 'misc':
      $p=6;
      break;
    default:
      $p='';
    }//var_dump($p);die();
try {
    $dbname="root";
    $dbpass="123456";
    $dbhost="127.0.0.1";
    $dbdatabase="blog";
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);

    $strsql="SELECT * FROM `article` WHERE `type`=".$p." ORDER BY `create_time` DESC";
    $result=$db_connect->query($strsql);
    $data = array();                       //var_dump($result);die();

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
        <td><a href="./index.php?p=" style="text-decoration:none; "><p>HEAD</p></a></td>
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
        foreach ($data as $k => $v) {   ?>
        <tr>
        <td height="30px" align="left"><a href="./page.php?id=<?php echo $v['id']; ?>" style="text-decoration:none; "><?php echo $v['title']; ?></a></td>
       
    </tr>
<?php       }


 ?>
      
</table>

</div>
</div>

</body>
</html>
