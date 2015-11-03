<?php
	DEFINE("DB_USER", "root");
	DEFINE("DB_PASS", "password");
	try {
		$db = new PDO(
			"mysql:host=localhost;dbname=projectsync",
			DB_USER,DB_PASS);
		$db->setAttribute(
			PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	} 
	catch(PDOException $e) {
		echo $e->getMessage();
	}
?>
