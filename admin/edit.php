<?php
        session_start();
        if (!isset($_SESSION['pwd'])){
            $url="./login.html";
            echo "<script language=\"javascript\">";
            echo "location.href=\"$url\"";
            echo "</script>";
            exit;
        }
	$requiredKeys = array('title', 'content','category','link');
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

	            $dbname="root";
	            $dbpass="123456";
	            $dbhost="127.0.0.1";
	            $dbdatabase="blog";
	            $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);
	    	 $db_connect->set_charset('utf8');

	            $strsql="INSERT INTO `article` (`title`,`content`,`own`,`create_time`,`link`) VALUES (?,?,?,?,?)";
	            if (!($stmt = $db_connect->prepare($strsql))) {
	    echo "Prepare failed: (" . $db_connect->errno . ") " . $db_connect->error;
	    }
	    $titel = $title;
	    $content = $content;
	    $category =  $category;
	    $create_time = $create_time;
	    $link = $link;
	    if (!$stmt->bind_param("sssss", $title,$content,$category,$create_time,$link)) {
	    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	    if (!$stmt->execute()) {
	    echo  false;
	}

	       echo true;

?>

