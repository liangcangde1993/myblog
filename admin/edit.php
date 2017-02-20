<?php
        session_start();
        if (!isset($_SESSION['pwd'])){
            $url="./login.html";
            echo "<script language=\"javascript\">";
            echo "location.href=\"$url\"";
            echo "</script>";
        }
        $title = $_POST['title'];
        $content = $_POST['content'];
        $own = $_POST['own'];
        $create_time = $_POST['create_time'];
        try {
            $dbname="root";
            $dbpass="123456";
            $dbhost="127.0.0.1";
            $dbdatabase="blog";
            $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);

            $strsql="INSERT INTO `article` (`title`,`content`,`own`,`create_time`) VALUES ('$title','$content','$own','$create_time')";//var_dump($strsql);die();
            $result=$db_connect->query($strsql);
            $row= mysqli_affected_rows($db_connect);//var_dump($row);die();
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

