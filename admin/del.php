<?php

	session_start();
	if (!isset($_SESSION['pwd'])){
		$url="./login.html";
		echo "<script language=\"javascript\">";
		echo "location.href=\"$url\"";
		echo "</script>";
		exit;
	}
	if(!isset($_POST['id'])){
	        header("Location: ./index.php"); 
	        exit;
	}

	    $id = $_POST['id'];
	    $dbname="root";
	    $dbpass="123456";
	    $dbhost="127.0.0.1";
	    $dbdatabase="blog";
	    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);
	    $db_connect->set_charset('utf8');

	    $strsql="delete from `article` where `id` = ?";
	     if (!($stmt = $db_connect->prepare($strsql))) {
	    echo "Prepare failed: (" . $db_connect->errno . ") " . $db_connect->error;
	    }
	    $val = $id;
	    if (!$stmt->bind_param("s", $val)) {
	    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	    if (!$stmt->execute()) {
	    	echo false;
	}   
	            echo  true; 
	   $stmt->close();
		$db_connect->close();
?>

