<?php
	try {
		$host ='localhost'; 
		$dbname='seabu_db';
		$username = "root";
		$password = "";
		$conn = new mysqli($host, $username, $password, $dbname);
	} catch(PDOException $e) {
		echo "Connection failed:" . $e->getMessage();
	}
?>
