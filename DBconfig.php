<?php
	DEFINE("DB_USER", "root");
	DEFINE("DB_PASS", "password");
	try {
		$dsn = "mysql:host=localhost;dbname=projectsync";
		$db = new PDO($dsn, DB_USER, DB_PASS);
		$db->setAttribute(
			PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} 
	catch(PDOException $e) {
		echo $e->getMessage();
	}
?>
