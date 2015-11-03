<?php
if($_SESSION['ADMIN'] === 0) {
	$query = 'kosten per project van deze consultant';
}  
if($_SESSION['ADMIN'] === 1) {
	$query1 = 'kosten per project van per consultant';
	$query2 = 'kosten per consultant van per project';
}  
try {
	echo($query);
}
catch(PDOException $e) {
	echo $e->getMessage();
}
?>
<h1 style="text-align:center;"><?php echo($page); ?> pagina</h1>
<p>Welkom <?php echo($_SESSION['NAAM']); ?></p>