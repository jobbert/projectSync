<!DOCTYPE html>
<html lang="nl">
	<head>
		<title>ProjectSync</title>
		<?php 
			if(isset($_GET['page'])) {
				$page = $_GET['page'];
			} else {
				$page = "inloggen";
			} 
			echo "<link rel='stylesheet' type='text/css' href='css/" . $page . ".styl' />"
		?>
	</head>
<body>
<?php
	if(isset($_SESSION['ID']) && $_SESSION['STATUS'] === 1) {
?>
		<script>
			function confirm_logout() {
				var logout = confirm('Weet u zeker dat u uit wilt loggen?');
				if(logout) {			  
					location.href='index.php?page=uitloggen';			
				}
			}
		</script>		
		<div id='banner'>
			<div id='logo'>
				<img src='img/logo.png' alt='logo'/>
			</div>
			<div id="user">
<?php
				if(isset($_SESSION['NAAM']) && ($_SESSION['NAAM'] != "")) {
				 echo	'<span>U bent ingelogd als: ' . $_SESSION['NAAM'] . '</span>';
				};
?>
			</div>	
		</div>
<?php  
		include("admin-navigation.php");
	}
?>
