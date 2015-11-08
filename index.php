<?php
	session_start();
	include("DBconfig.php");
	include("header.php");
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	}else {
		$page = "inloggen";
	}
	if(isset($_SESSION['ADMIN'])){
		echo "<h1>ADMIN?</h1>";
	}
	if($page) {
		echo("<div id='".$page."-page page'>");
		include("pages/".$page.".php");
		echo("</div>");
	}
	include("footer.php");
?>
