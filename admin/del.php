<?php
session_start();
if (!isset($_SESSION['pwd'])){
	$url="./login.html";
	echo "<script language=\"javascript\">";
	echo "location.href=\"$url\"";
	echo "</script>";
}
$id = $_POST['id'];
try {
    $dbname="root";
    $dbpass="123456";
    $dbhost="127.0.0.1";
    $dbdatabase="blog";
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);

    $strsql="delete from `article` where `id` = ".$id;
    $result=$db_connect->query($strsql);
    $row= mysqli_affected_rows($db_connect);
    // $result->close();
    $db_connect->close();

    if($row){
        echo true;
    }
    else{
       echo false;
    } 

	}
	catch (Exception $e){}
?>

