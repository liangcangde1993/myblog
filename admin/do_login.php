<?php 
	session_start();
	if (isset($_SESSION['userid'])){
		  echo "login status ";
		  exit;
	 }
	 require_once("./db.php");
	try {
  
			 if (!isset($_POST['email'])) {
			         throw new InvalidArgumentException('unset email ');
			       }

			 if ( !isset($_POST['pwd'])) {
			         throw new InvalidArgumentException('unset  pwd');
			       }
			   
			 if(strlen($_POST['email'])  < 3 || strlen($_POST['email'])  > 200){      
			        echo "email格式不正确";exit;
			     }
		    
			 $_POST['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
			 	if (!$_POST['email']) {
			 		echo "email格式不正确";
			 		exit;
			   	 } 
			 $email = $_POST['email'];

			 if(strlen($_POST['pwd'])  > 8 ){
			    	echo "password  max is  8  bit";
			    	exit;
			    }

			 if(empty($_POST['pwd'])){
			    	echo  "password is  null ";
			    	exit;
			    }

			 $passwd   = md5('yunzhao'.$_POST['pwd']);

		} catch (InvalidArgumentException $e) {
			echo "InvalidArgument";
			exit;
		}


			 if ($db_connect->connect_errno) {
				   	throw new Exception("Failed to connect to MySQL: (" . $db_connect->connect_errno . ") " . $db_connect->connect_error); 
				}
			 $db_connect->set_charset('utf8');
			 $sql="SELECT `id`,`pwd` FROM `user` WHERE `email` = ? ";
			 if (!($stmt = $db_connect->prepare($sql))) {
				   	throw new  Exception("Prepare failed: (" . $db_connect->errno . ") " . $db_connect->error);
			  }
			 if (!$stmt->bind_param("s", $email)) {
			    		throw new Exception("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error); 
			}			
			 if (!$stmt->execute()) {
			    		throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error); 
			}  

			if (!$stmt->bind_result($id, $pwd)) {
			    		throw new Exception("Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error); exit;	    	    
			}

		} catch (Exception $e) {
			exit;
		}
			
			$res = $stmt->fetch();

			    if(!$res){
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


 
          	
   
 ?>