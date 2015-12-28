<!DOCTYPE html>
<html lang="nl">
	<head>
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1" /> -->
		<title>ProjectSync</title>
		<link rel='stylesheet' type='text/css' href='css/index.styl'/>
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
			<div id="user">
				<?php
				if(isset($_SESSION['NAAM']) && ($_SESSION['NAAM'] != "")) {
					$naam = $_SESSION['NAAM'];
				 echo	'<span>U bent ingelogd als: ' . $naam . '</span>';
				};
				?>
			</div>	
			<?php 
			if(!($_SESSION['ADMIN'] === 1)) {
				include("consultant-navigation.php");
			} 
			else {
				include("admin-navigation.php");
			}
			?>
		</div>
<?php
	}
?>
