<?php
  	session_start();

	 if (!isset($_SESSION['userid'])){
		header("Location: ./login.php");
	 	exit;
	 }

	require_once("./pdo.php");

	try{
		$requiredKeys = array('title',  'content', 'category', 'link', 'tag');
			foreach ($requiredKeys as $key) {
				if (!isset($_POST[$key])) {
	            		throw new InvalidArgumentException("missing required key $key");
	        			}
	    		}

	    		if(strlen($_POST['title']) > 200   || strlen($_POST['title']) <1  ||
	    			strlen($_POST['link']) > 200  || strlen($_POST['tag']) > 200  ||
	    			 strlen($_POST['content']) > 64000  ){
	            		throw new InvalidArgumentException(" arguemnt  length  error");
	    		}
	    	

			if( ! filter_var($_POST['category'], FILTER_VALIDATE_INT,  array("options"=>array("min_range"=>1, "max_range"=>6)))){
	            		throw new InvalidArgumentException(" arguemnt  category  error");
				
			}
			if($_POST['link'] != ''){
			if( ! filter_var($_POST['link'], FILTER_VALIDATE_URL)){
	            		throw new InvalidArgumentException(" arguemnt  link  error");				
			}
	    		}
		} catch (InvalidArgumentException $e) {
			echo  $e->getMessage();
			exit;
		}

		$title 		= 	$_POST['title'];
		$content 	=	$_POST['content'];
		$link 		= 	$_POST['link'];
		$tag 		= 	$_POST['tag'];
		$category 	= 	$_POST['category'];
		$create_time = 	date('Y-m-d H-i-s',time());
   	try {
			 function PDOBindArray($poStatement, $paArray){

					foreach ($paArray as $k=>$v){

							$poStatement->bindValue(':'.$k,$v);

					}
			} 

			$stmt = $pdo->prepare("INSERT  `article` (`uid`,`title`,`content`,`category`,`create_time`,`link`,`tag`) 
			 					VALUES (:uid, :title, :content, :category, :create_time, :link, :tag)  ");
			$arg = array(
						'uid' 		=> $_SESSION['userid'], 
						'title' 		=> $title,
					 	'content' 	=> $content,
					  	'category' 	=> $category,
					  	'create_time' => $create_time,
					  	'link' 		=> $link,
					  	'tag' 		=> $tag
			  );

			PDOBindArray($stmt,$arg);
   			if (!$stmt->execute()) {
				echo  false;
			}else{
				echo true;
			}

			$pdo = null;
			
			} catch (PDOException $e) {		   
			die();
		}
	 

?>

