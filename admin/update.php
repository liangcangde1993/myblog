<?php

	session_start();
		if (!isset($_SESSION['userid'])){
         			header("Location: ./login.php"); 
			exit;
        		}
   
	require_once("./pdo.php");

	try{
        		$requiredKeys = array('id','title', 'content','category','link','tag');
	         		foreach ($requiredKeys as $key) {
	        			if (!isset($_POST[$key])) {
	            		throw new InvalidArgumentException("missing required key $key");
	        			}
	    		}

            	if (strlen($_POST['id'])  > 10 || strlen($_POST['id']) < 1 ) {
                 		throw new InvalidArgumentException(' argment id  length error ');
        		}

            	if (!filter_var($_POST['id'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)))) {
                		throw new InvalidArgumentException('invalid id');
            	}

                   	if(strlen($_POST['title']) > 200   || strlen($_POST['title']  || strlen($_POST['link']) > 200  || strlen($_POST['tag']) > 200  || strlen($_POST['content']) > 64000 ) < 1 ){
                     		throw new InvalidArgumentException(" title  length  error");
              	}

        		if(!filter_var($_POST['category'], FILTER_VALIDATE_INT,  array("options"=>array("min_range"=>1, "max_range"=>6)))){
                        	throw new InvalidArgumentException(" arguemnt  category  error");
                	}

        		} catch (InvalidArgumentException $e) {
		            	echo  $e->getMessage();
		            	exit;
		        	}

	        	$id 			= $_POST['id'];
	        	$title 		= $_POST['title'];
	        	$content 	= $_POST['content'];
	        	$category 	= $_POST['category'];
	        	$link 		= $_POST['link'];
	        	$tag 		= $_POST['tag'];
	        	$update_time = date('Y-m-d H-i-s',time());

         
     	try {
        		$stmt = $pdo->prepare("UPDATE `article` SET `title` = '$title',`content`='$content',`category`='$category',`update_time`='$update_time' ,`link`='$link' ,`tag`='$tag'  WHERE `id` = :id");
        		$stmt->bindParam(':id', $id);
         		$stmt->execute();
          		if (!$stmt->execute()) {
            		echo false;
    		}  else{
       				 echo  true; 
   		 } 
                
        		$pdo = null;

    		} catch (PDOException $e) {        
	            		die();
	    		}
	   
	 


?>

