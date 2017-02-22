<?php 
	session_start();
	if (isset($_SESSION['uid'])){
	  header("Location: ./index.php"); 
	    exit;
	    }

	try {
  
	    if (!isset($_POST['email'])) {
	         throw new InvalidArgumentException('unset email ');

	       }
	         if ( !isset($_POST['pwd'])) {
	         throw new InvalidArgumentException('unset  pwd');
	       }

	   
	    if(strlen($_POST['email']) <3 || strlen($_POST['email']) >=200){
	       
	        echo "email格式不正确";exit;
	    }
    
	      $_POST['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
	    if (!$_POST['email']) {
	        echo "email格式不正确";exit;
	    } else {
	        $email = $_POST['email'];
	    }

	    if(empty($_POST['pwd'])){
	    	echo  "password is  null ";exit;
	    }
	    $passwd   = md5('yunzhao'.$_POST['pwd']);
  
	    $dbname="root";
	    $dbpass="123456";
	    $dbhost="127.0.0.1";
	    $dbdatabase="blog";
	    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);
	    if ($db_connect->connect_errno) {
		    echo "Failed to connect to MySQL: (" . $db_connect->connect_errno . ") " . $db_connect->connect_error;exit;
		}
	    $db_connect->set_charset('utf8');
	    $sql="SELECT `id`,`pwd` FROM `user` WHERE `email` = ? limit 1";
	    if (!($stmt = $db_connect->prepare($sql))) {
	    echo "Prepare failed: (" . $db_connect->errno . ") " . $db_connect->error;exit;
	    }
	    $val = $email;
	    if (!$stmt->bind_param("s", $val)) {
	    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;exit;
	}

	if (!$stmt->bind_result($id, $pwd)) {
	    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;exit;
	}
	    if (!$stmt->execute()) {
	    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;exit;
	}  
	
	$res = $stmt->fetch();

	    if($res == null){
	        echo "没有这个用户名";exit;
	    }

	     if($pwd ==$passwd){ 
	         $_SESSION['userid'] = $id;
	            echo 'success';
	        }
	        else{
	            echo "密码错误";
	        } 
	    
	  	 $stmt->close();
		$db_connect->close();


 
          } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
       
    }
   
 ?>