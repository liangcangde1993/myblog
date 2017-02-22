<?php 
 	$dbname="root";
	$dbpass="123456";
	$dbhost="127.0.0.1";
	$dbdatabase="blog";
	$db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);
	$db_connect->set_charset('utf8');

	try{
			if ($db_connect->connect_errno) {
				throw new Exception("Failed to connect to MySQL: (" . $db_connect->connect_errno . ") " . $db_connect->connect_error); 
			}
			
		} catch (Exception $e) {
				exit;
			}

 ?>