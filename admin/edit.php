<?php
        session_start();
        if (!isset($_SESSION['pwd'])){
            $url="./login.html";
            echo "<script language=\"javascript\">";
            echo "location.href=\"$url\"";
            echo "</script>";
            exit;
        }
	$requiredKeys = array('title', 'content','category','link','tag');
	         foreach ($requiredKeys as $key) {
	        if (!isset($_POST[$key])) {
	            throw new InvalidArgumentException("missing required key $key");
	        }
	    }

	        $title = $_POST['title'];
	        $content = $_POST['content'];
	        $category = $_POST['category'];
	        $create_time = time();
	        $link = $_POST['link'];
	        $tag = $_POST['tag'];
	      $subject = trim($_POST['content']);
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
	            $strsql="INSERT INTO `article` (`title`,`content`,`own`,`create_time`,`link`,`tag`) VALUES (?,?,?,?,?,?)";
	            if (!($stmt = $db_connect->prepare($strsql))) {
	    echo "Prepare failed: (" . $db_connect->errno . ") " . $db_connect->error;
	    }
	    $titel = $title;
	    $content = $content;
	    $category =  $category;
	    $create_time = $create_time;
	    $link = $link;
	    $tag = $tag;
	    if (!$stmt->bind_param("ssssss", $title,$content,$category,$create_time,$link,$tag)) {
	    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	    if (!$stmt->execute()) {
	    echo  false;
	}

	       echo true;

?>

