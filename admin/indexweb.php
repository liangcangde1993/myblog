<?php
try {
    $dbname="root";
    $dbpass="123456";
    $dbhost="127.0.0.1";
    $dbdatabase="blog";
    $db_connect= new mysqli($dbhost,$dbname,$dbpass,$dbdatabase);

    $strsql="select * from `article` ORDER BY `create_time` DESC";
    $result=$db_connect->query($strsql);
    $data = array();

	$result->data_seek(0); #重置指针到起始
	while($row = $result->fetch_assoc())
	{
	    $data[] = $row;
	}

	    $result->close();
	    $db_connect->close();
	 
	}
	catch (Exception $e){}
?>


</div>
</div>

</body>
</html>