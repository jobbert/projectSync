<?php
if(isset($_SESSION) && $_SESSION['STATUS'] === 1){
	if(!isset($_SESSION['ADMIN'])) {
		include ('pages/consultant-overzicht.php');
	}

	if(isset($_SESSION['ADMIN'])) {
		if($_GET['x'] === 'cp'){
			include ('pages/admin-overzicht-cp.php');
		}
		if($_GET['x'] === 'pc'){
			include ('pages/admin-overzicht-pc.php');
		}
	}
}
else {
?>
<h1 style="align-self">U heeft geen toegang tot deze pagina!</h1>
<?php
}
?>