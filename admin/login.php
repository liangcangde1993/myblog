<?php 
	session_start();
	if (isset($_SESSION['pwd'])){
	$url="./index.php";
	echo "<script language=\"javascript\">";
	echo "location.href=\"$url\"";
	echo "</script>";
    exit;
    }
	
    if (!isset($_POST['email']) || !isset($_POST['pwd'])) {
        header("Location: ./index.php"); exit;
    }
    
      $_POST['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if (!$_POST['email']) {
        return false;
    } else {
        $email = $_POST['email'];
    }
    $passwd   = md5('yunzhao'.$_POST['pwd']);
    if(strlen($passwd) != 32){
        return false;
    }
    $dbname="root";
    $dbpass="123456";
    $dbhost="127.0.0.1";
    $dbdatabase="blog";
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);
    $db_connect->set_charset('utf8');
    $strsql="SELECT `pwd` FROM `user` WHERE `email` = ? limit 1";
    if (!($stmt = $db_connect->prepare($strsql))) {
    echo "Prepare failed: (" . $db_connect->errno . ") " . $db_connect->error;
    }
    $val = $email;
    if (!$stmt->bind_param("s", $val)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

    $stmt->bind_result($pwd);
    if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
    

     while($stmt->fetch()){
     if($pwd==$passwd){ 
         $_SESSION['pwd'] = $pwd;
            echo "true";
        }
        else{
            echo "false";
        } 
    }
   $stmt->close();
	$db_connect->close();
   
 ?>