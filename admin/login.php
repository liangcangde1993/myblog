<?php 
	session_start();
	if (!isset($_SESSION['pwd'])){
	$url="./login.html";
	echo "<script language=\"javascript\">";
	echo "location.href=\"$url\"";
	echo "</script>";
}
	$email = $_POST['email'];
	$pwd   = md5('yunzhao'.$_POST['pwd']);

try {
    $dbname="root";
    $dbpass="123456";
    $dbhost="127.0.0.1";
    $dbdatabase="blog";
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);

    $strsql="select `pwd` from `user` where `email` = '$email' limit 1";//var_dump($strsql);die();
    $result=$db_connect->query($strsql);
	$row=mysqli_fetch_assoc($result);
    $result->close();
    $db_connect->close();

    if($row['pwd']==$pwd){ 
    	$_SESSION['pwd'] = $pwd;
        echo "true";
    }
    else{
        echo "false";
    } 

}
catch (Exception $e){}






 ?>