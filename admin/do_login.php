<?php 
	session_start();
	if (isset($_SESSION['userid'])){
		  echo "login status ";
		  exit;
	 }

	require_once("./pdo.php");

	try {

		 if (!isset($_POST['email'])) {
		         throw new InvalidArgumentException('unset email ');
		 }
		if ( !isset($_POST['pwd'])) {
			throw new InvalidArgumentException('unset  pwd');
		}
			   
		if(strlen($_POST['email'])  < 3 || strlen($_POST['email'])  > 200){      
			throw new InvalidArgumentException('email格式不正确');
		}
		    
		 $_POST['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

		if (!$_POST['email']) {
			throw new InvalidArgumentException('email格式不正确');
		}

		$email = $_POST['email'];

		if(strlen($_POST['pwd'])  < 8 || strlen($_POST['pwd']) > 50  ){
			throw new InvalidArgumentException('password  length error');
		}

		$passwd   = md5('yunzhao'.$_POST['pwd']);

		} catch (InvalidArgumentException $e) {
			echo ( $e->getMessage());
			exit;
		}

	try{

		$stmt = $pdo->prepare("SELECT `uid`,`password` FROM `user` WHERE `email` = :email ");
    		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
   		$stmt->execute();
		$row = $stmt->fetch();

		if($row['password'] ==$passwd){ 
			$_SESSION['userid'] = $row['uid'];
			echo 'success';
		}else{
			echo "email or 密码错误";
		} 
		$pdo = null;

		} catch (PDOException $e) { 
			exit;
		}
			

