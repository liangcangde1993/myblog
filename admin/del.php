<?php

	session_start();

	if (!isset($_SESSION['userid'])){
		echo "please login first";
		exit;
	}

	require_once("./pdo.php");

	try{

		if(!isset($_POST['id'])) {
			throw new InvalidArgumentException('unset  argument id ');
		}

		if (! filter_var($_POST['id'], FILTER_VALIDATE_INT, array( 'options' => array('min_range' => 1) ))) {
		        throw new InvalidArgumentException('invalid id');
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

