<?php

        session_start();
        if (!isset($_SESSION['pwd'])){
            $url="./login.html";
            echo "<script language=\"javascript\">";
            echo "location.href=\"$url\"";
            echo "</script>";
            exit;
        }
   

        	$requiredKeys = array('id','title', 'text','category','link');
	         foreach ($requiredKeys as $key) {
	        if (!isset($_POST[$key])) {
	            throw new InvalidArgumentException("missing required key $key");
	        }
	    }
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['text'];
        $category = $_POST['category'];
        $link = $_POST['link'];
        $last_ex_time = time();
           $subject = trim($_POST['text']);
	      $len     = mb_strlen($subject, 'UTF-8');
	    if ( $len > 100) {
	        throw new InvalidArgumentException('subject required and maxlength is 100');
	    }
               $dbname="root";
            $dbpass="123456";
            $dbhost="127.0.0.1";
            $dbdatabase="blog";
            $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);
	   $db_connect->set_charset('utf8');

            $strsql="UPDATE `article` SET `title` = '$title',`content`='$content',`own`='$category',`last_ex_time`='$last_ex_time' ,`link`='$link'  WHERE `id` = ?";
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

