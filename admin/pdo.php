<?php 

	try {
		    $pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '123456');
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $pdo->exec("set names gbk");
		    
		} catch (PDOException $e) {
		   
		    exit();
		}




 ?>