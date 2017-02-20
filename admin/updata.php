<?php
        session_start();
        if (!isset($_SESSION['pwd'])){
            $url="./login.html";
            echo "<script language=\"javascript\">";
            echo "location.href=\"$url\"";
            echo "</script>";
        }
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['text'];
        $own = $_POST['own'];
        $last_ex_time = $_POST['last_ex_time'];
        try {
            $dbname="root";
            $dbpass="123456";
            $dbhost="127.0.0.1";
            $dbdatabase="blog";
            $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);

            $strsql="UPDATE `article` SET `title` = '$title',`content`='$content',`own`='$own',`last_ex_time`='$last_ex_time' WHERE `id` = ".$id;
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

