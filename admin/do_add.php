<?php
 	session_start();

	if (!isset($_SESSION['userid'])){
		header("Location:./login.php");
		exit;
	}
	require_once("./pdo.php");

	try{
		$requiredKeys = array('title', 'content','category','link','tag');
			foreach ($requiredKeys as $key) {
				if (!isset($_POST[$key])) {
	            		throw new InvalidArgumentException("missing required key $key");
	        			}
	    		}

	    		if(strlen($_POST['title']) > 200   || strlen($_POST['link']) > 200 || strlen($_POST['tag']) > 200 || strlen($_POST['content']) > 64000){
	            		throw new InvalidArgumentException(" arguemnt  length  error");
	    		}
	    		$arr = array(1,2,3,4,5,6);
	    		if(!in_array($_POST['category'], $arr) ){
	            		throw new InvalidArgumentException(" arguemnt  category  error");
	    		}

		} catch (InvalidArgumentException $e) {
			print_r( $e->getMessage());
			exit;
		}

		$title 		= 	htmlspecialchars($_POST['title']);
		$content 	=	htmlspecialchars( $_POST['content']);
		$link 		= 	htmlspecialchars($_POST['link']);
		$tag 		= 	htmlspecialchars($_POST['tag']);
		$category 	= 	$_POST['category'];
		$create_time = 	time();
   	try {
		$stmt = $pdo->prepare("INSERT  `article` (`uid`,`title`,`content`,`category`,`create_time`,`link`,`tag`) VALUES (?,?,?,?,?,?,?)    ");
		$arg = array($_SESSION['userid'],$title,$content,$category,$create_time,$link,$tag);

		for($i = 1 ;$i<=7;$i++){
			$stmt->bindParam($i,$arg[$i-1]);
		}

   		if (!$stmt->execute()) {
			echo  false;
		}

		 echo true;

		$pdo = null;
		} catch (PDOException $e) {		   
			die();
		}
	 

?>

