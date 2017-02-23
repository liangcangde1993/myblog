<?php

	session_start();

	if (!isset($_SESSION['userid'])){
		header("Location:./login.php");
		exit;
	}

	require_once("./pdo.php");

	try{

		if(!isset($_POST['id'])) {
			throw new InvalidArgumentException('unset  argument id ');
		}

	} catch (InvalidArgumentException $e) {
		print_r( $e->getMessage());
		exit;
	}	  

	try{
		$stmt = $pdo->prepare("DELETE FROM `article` WHERE `id` = ? ");
    		$stmt->bindParam(1,$_POST['id']);
   		$res = $stmt->execute();
		if (!$res) {
		    	echo "delete  failed";
		}   
		            echo  true; 
		
		$pdo = null;

		} catch (PDOException $e) { 
			exit;
		}

		
	
?>

